<?php

namespace backend\controllers;

use frontend\models\investigador\Investigador;
use Yii;
use backend\models\user\User;
use backend\models\user\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $foto = UploadedFile::getInstance($model,'use_foto');

            if ($foto == ''){
                $model->use_foto = 'usuario_anonimo.jpg';
            }else{

                $modelFoto = User::find()->count();

                $foto->saveAs('img/user/'. $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension);
                $model->use_foto = $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension;
            }

           /*
            * 1. usuario Administrador
            * 2. usuario Investigador
            * 3. usuario Registrado
            */

          /*  if($model->rol_id != 2){
                $model ->use_estado = 1;
                //Aqui va codigo borrar el perfil del investigador
            }*/

            $model -> use_estadoAudit = 'N';
            $model -> use_fechaCreacion = date('y-m-d H:i:s');
            $model -> use_fechaAudit = date('y-m-d H:i:s');
            $model -> use_accion = 'N';


            if($model->signup()){
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro agregado!</h4>
                        El registro se agregó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelFoto = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $foto = UploadedFile::getInstance($model,'use_foto');

            if ($foto == ''){
                $model->use_foto = $modelFoto->use_foto;
            }else{

                if($modelFoto->use_foto != 'usuario_anonimo.jpg'){
                    unlink('img/user/'.$modelFoto->use_foto);
                }

                $modelFoto = User::find()->count();
                $foto->saveAs('img/user/'. $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension);
                $model->use_foto = $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension;

            }

            if($model->rol_id != 2){
                $model ->use_estado = 1;
                //Aqui va codigo borrar el perfil del investigador
                $investigador = new Investigador();
                if($investigador->find()->where(['usu_id'=>$model->id])->count() != 0 ){
                    $investigador->find()->where(['usu_id'=>$model->id])->one()->delete();
                }

            }

            $model -> use_fechaAudit = date('y-m-d H:i:s');
            $model -> use_accion = 'M';

            if($model->signup()){
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro modificado!</h4>
                        El registro se modificó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //tambien falta de coleccion_persona
        $cont = Investigador::find()->where(['usu_id'=>$id])->count();
        if($cont != 0){
            Yii::$app->session->setFlash('msg', '
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-error"></i>No se pudo eliminar!</h4>
                    No se puede eliminar el registro porque está siendo ocupado.
                </div>
            ');
        }else{
            $modelFoto = $this->findModel($id);
            if($modelFoto->use_foto != 'usuario_anonimo.jpg'){
                unlink('img/user/'.$modelFoto->use_foto);
            }

            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('msg', '
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-check"></i>Registro eliminado!</h4>
                    El registro se eliminó correctamente.
                </div>
            ');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
