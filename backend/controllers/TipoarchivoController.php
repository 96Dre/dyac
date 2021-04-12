<?php

namespace backend\controllers;

use backend\models\archivoatributoex\Archivoatributoex;
use backend\models\archivoatributoex\ArchivoatributoexSearch;
use backend\models\atributoextra\Atributoextra;
use backend\models\atributoextra\AtributoextraSearch;
use backend\models\tipoarchivo\Tipoarchivo;
use backend\models\tipoarchivo\TipoarchivoSearch;
use backend\models\tipoarchivoextension\Tipoarchivoextension;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * TipoarchivoController implements the CRUD actions for Tipoarchivo model.
 */
class TipoarchivoController extends Controller {

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
     * Lists all Tipoarchivo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TipoarchivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipoarchivo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        //$atributosExtra = ArchivoatributoexSearch::getAtributosExtra($id);
//       $atributosExtra = ArchivoatributoexSearch::find()->all();
//
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $atributosExtra,
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//            'sort' => [
//                'attributes' => ['aex_nombre', 'aex_descripcion'],
//            ],
//        ]);

        $query = new Query();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->from('atributo_extra')->leftJoin('archivo_atributoex', $on="atributo_extra.aex_id=archivo_atributoex.aex_id")->where(['tar_id'=>$id]),
            'sort' => [
                'attributes' => ['aex_nombre', 'aex_descripcion'],
                // Set the default sort by name ASC and created_at DESC.
                'defaultOrder' => [
                    'aex_nombre' => SORT_ASC,
                   // 'created_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider,
                        //'Ext' => $Ext,
        ]);
    }

    /**
     * Creates a new Tipoarchivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tipoarchivo();

        $searchModel = new AtributoextraSearch();
        $modelAtributos = $searchModel->getAllAtributosextra();





        if ($model->load(Yii::$app->request->post())) {

            //Recogen los valores del widget para la tabla Palabra clave
            $atributoSelec = Yii::$app->request->post('selection');


            $model->tar_estado = 'N';
            $model->tar_fechaCreacion = date('y-m-d H:i:s');
            $model->tar_fechaAudit = date('y-m-d H:i:s');
            $model->tar_accion = 'N';

            if ($model->save()) {

                if ($atributoSelec != null) {
                    foreach ($atributoSelec as $item) {

                        $modelArchivo_atributoex = new Archivoatributoex();
                        $modelArchivo_atributoex->tar_id = $model->tar_id;
                        $modelArchivo_atributoex->aex_id = $item;
                        $modelArchivo_atributoex->aae_estado = 'N';
                        $modelArchivo_atributoex->aae_fechaCreacion = date('y-m-d H:i:s');
                        $modelArchivo_atributoex->aae_fechaAudit = date('y-m-d H:i:s');
                        $modelArchivo_atributoex->aae_accion = 'N';
                        $modelArchivo_atributoex->save();
                    }
                }


                Yii::$app->session->setFlash('msg', '
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                            <h4><i class="bx bx-check"></i>Registro agregado!</h4>
                            El registro se agregó correctamente.
                        </div>
                ');

                return $this->redirect(['view', 'id' => $model->tar_id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'modelAtributos' => $modelAtributos,
                        //'tipoExt' => $tipoExt,
        ]);
    }

    /**
     * Updates an existing Tipoarchivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $searchModel = new AtributoextraSearch();
        $modelAtributos = $searchModel->getAllAtributosextra();        
       $atributosExtra =  ArchivoatributoexSearch::getAtributosExtra($id);  // getAtributosExtra($id); //objeto
        
         $query = new Query();
          $query->from('atributo_extra')->leftJoin('archivo_atributoex', $on="atributo_extra.aex_id=archivo_atributoex.aex_id")->where(['tar_id'=>$id]);
         
//        $qry = "SELECT * FROM `atributo_extra` INNER JOIN `archivo_atributoex` WHERE `tar_id`='".$id."' GROUP BY aex_nombre";
//          $atributosExtra = Archivoatributoex::findBySql($qry);



        if ($model->load(Yii::$app->request->post())) {

            //Recogen los valores del widget para la tabla Palabra clave
            $atributoSelec = Yii::$app->request->post('selection');
            // $dataExt = Yii::$app->request->post('Tipoarchivoextension', []);
            $model->tar_fechaAudit = date('y-m-d H:i:s');
            $model->tar_accion = 'M';

            if ($model->save()) {



                //Eliminar registros viejos
                foreach ($atributosExtra as $item) {
                    $modelArchivo_atributoex = new Archivoatributoex();
                    $modelArchivo_atributoex->find()->where(['aae_id' => $item->aae_id])->one()->delete();
                }

                //Agregan registros nuevos
                foreach ($atributoSelec as $item) {

                    $modelArchivo_atributoex = new Archivoatributoex();
                    $modelArchivo_atributoex->tar_id = $model->tar_id;
                    $modelArchivo_atributoex->aex_id = $item;
                    $modelArchivo_atributoex->aae_estado = 'N';
                    $modelArchivo_atributoex->aae_fechaCreacion = date('y-m-d H:i:s');
                    $modelArchivo_atributoex->aae_fechaAudit = date('y-m-d H:i:s');
                    $modelArchivo_atributoex->aae_accion = 'M';
                    $modelArchivo_atributoex->save();
                }

                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Registro modificado!</h4>
                        El registro se modificó correctamente.
                    </div>
                ');

                return $this->redirect(['view', 'id' => $model->tar_id]);
            }
        }


        return $this->render('update', [
                    'model' => $model,
                    'modelAtributos' => $modelAtributos,
                    'atributosExtra' => $atributosExtra,
                        //'tipoExt' => $tipoExt,
        ]);
    }

    /**
     * Deletes an existing Tipoarchivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $cont = 0;
        //$cont = Archivo::find()->where(['tar_id' => $id])->count();
        if ($cont != 0) {
            Yii::$app->session->setFlash('msg', '
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-error"></i>No se pudo eliminar!</h4>
                    No se puede eliminar el registro porque está siendo ocupado.
                </div>
            ');
        } else {




            $modelArchivo_atributoex = new Archivoatributoex();
            $eliminar = new Archivoatributoex();

            foreach ($modelArchivo_atributoex->find()->where(['tar_id' => $id])->all() as $item) {
                $eliminar->find()->where(['aae_id' => $item->aae_id])->one()->delete();
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
     * Finds the Tipoarchivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipoarchivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tipoarchivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
