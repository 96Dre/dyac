<?php

namespace backend\controllers;

use Yii;
use backend\models\preguntafrecuente\PreguntaFrecuente;
use backend\models\preguntafrecuente\PreguntaFrecuenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PreguntaFrecuenteController implements the CRUD actions for PreguntaFrecuente model.
 */
class PreguntaFrecuenteController extends Controller {

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
     * Lists all PreguntaFrecuente models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PreguntaFrecuenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreguntaFrecuente model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PreguntaFrecuente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PreguntaFrecuente();

        $model->pfr_estado = 'N';
        $model->pfr_fechaCreacion = date('y-m-d H:i:s');
        $model->pfr_fechaAudit = date('y-m-d H:i:s');
        $model->pfr_accion = 'N';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pfr_id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing PreguntaFrecuente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->pfr_fechaAudit = date('y-m-d H:i:s');
        $model->pfr_accion = 'M';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pfr_id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PreguntaFrecuente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PreguntaFrecuente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PreguntaFrecuente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PreguntaFrecuente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
