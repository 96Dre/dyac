<?php

namespace backend\controllers;

use backend\models\coleccion\Coleccion;
use Yii;
use backend\models\disciplina\Disciplina;
use backend\models\disciplina\DisciplinaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplinaController implements the CRUD actions for Disciplina model.
 */
class DisciplinaController extends Controller
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
     * Lists all Disciplina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisciplinaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disciplina model.
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
     * Creates a new Disciplina model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disciplina();

        if ($model->load(Yii::$app->request->post())){

            $model -> dis_estado = 'N';
            $model -> dis_fechaCreacion = date('y-m-d H:i:s');
            $model -> dis_fechaAudit = date('y-m-d H:i:s');
            $model -> dis_accion = 'N';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro agregado!</h4>
                        El registro se agregó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->dis_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Disciplina model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model -> dis_fechaAudit = date('y-m-d H:i:s');
            $model -> dis_accion = 'M';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro modificado!</h4>
                        El registro se modificó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->dis_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Disciplina model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $cont = Coleccion::find()->where(['dis_id' => $id])->count();
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
     * Finds the Disciplina model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disciplina the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disciplina::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
