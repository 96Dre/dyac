<?php

namespace backend\controllers;

use backend\models\user\User;
use Yii;
use backend\models\pais\Pais;
use backend\models\pais\PaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

/**
 * PaisController implements the CRUD actions for Pais model.
 */
class PaisController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    
     public function behaviors() {
        // var_dump($rol_mayor); exit();
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow' => true, // Esta propiedad establece que tiene permisos
                        'actions' => [
                            'index',
                            'view',
                            'create',
                            'update',
                            'delete',
                        ], // El administrador tiene permisos sobre las siguientes acciones
                        // Este método nos permite crear un filtro sobre la identidad del usuario
                        // y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            return (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id == 1); // Es administrador
                        }
                    ],                       
                            
                ]
            ],
            // Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
            // sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => [
                        'post'
                    ]
                ]
            ]
        ];
    }
    
    /**
     * Lists all Pais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pais model.
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
     * Creates a new Pais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pais();

        if ($model->load(Yii::$app->request->post())){

            $model -> pai_estado = 'N';
            $model -> pai_fechaCreacion = date('y-m-d H:i:s');
            $model -> pai_fechaAudit = date('y-m-d H:i:s');
            $model -> pai_accion = 'N';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro agregado!</h4>
                        El registro se agregó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->pai_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){

            $model -> pai_fechaAudit = date('y-m-d H:i:s');
            $model -> pai_accion = 'M';

            if($model->save()) {
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro modificado!</h4>
                        El registro se modificó correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->pai_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //vincula con la tabla User
        //coleccion - pais
        //archivo

       $cont = User::find()->where(['pai_id' => $id])->count();
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
     * Finds the Pais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pais::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
