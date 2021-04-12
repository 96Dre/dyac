<?php

namespace backend\controllers;

use backend\models\user\User;
use Yii;
use backend\models\usergenero\Usergenero;
use backend\models\usergenero\UsergeneroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsergeneroController implements the CRUD actions for Usergenero model.
 */
class UsergeneroController extends Controller
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
     * Lists all Usergenero models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsergeneroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usergenero model.
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
     * Creates a new Usergenero model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usergenero();

        if ($model->load(Yii::$app->request->post())){

            $model -> uge_estado = 'N';
            $model -> uge_fechaCreacion = date('y-m-d H:i:s');
            $model -> uge_fechaAudit = date('y-m-d H:i:s');
            $model -> uge_accion = 'N';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro agregado!</h4>
                        El registro se agregó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->uge_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usergenero model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model -> uge_fechaAudit = date('y-m-d H:i:s');
            $model -> uge_accion = 'M';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro modificado!</h4>
                        El registro se modificó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->uge_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usergenero model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $cont = User::find()->where(['uge_id' => $id])->count();
        if($cont != 0){
            Yii::$app->session->setFlash('msg', '
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-error"></i>No se pudo eliminar!</h4>
                    No se puede eliminar el registro porque está siendo ocupado.
                </div>
            ');
        }else{
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
     * Finds the Usergenero model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usergenero the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usergenero::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
