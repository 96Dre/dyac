<?php

namespace frontend\controllers;

use Yii;
use frontend\models\preguntafrecuente\PreguntaFrecuente;
use frontend\models\preguntafrecuente\PreguntaFrecuenteSearch;
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
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

//    public function behaviors() {
//        // var_dump($rol_mayor); exit();
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                        [
//                        'allow' => true, // Esta propiedad establece que tiene permisos
//                        'actions' => [
//                            'index',
//                            'view',                          
//                        ], // El administrador tiene permisos sobre las siguientes acciones
//                        // Este método nos permite crear un filtro sobre la identidad del usuario
//                        // y así establecer si tiene permisos o no
//                        'matchCallback' => function ($rule, $action) {
//                            return (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id == 2); // Es investigador
//                        }
//                    ],
//                ]
//            ],
//            // Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
//            // sólo se puede acceder a través del método post
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => [
//                        'post'
//                    ]
//                ]
//            ]
//        ];
//    }

    /**
     * Lists all PreguntaFrecuente models.
     * @return mixed
     */
    public function actionIndex() {
//        $searchModel = new PreguntaFrecuenteSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = PreguntaFrecuente::find()->all();
        return $this->render('index', [
                    'model' => $model,
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
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
