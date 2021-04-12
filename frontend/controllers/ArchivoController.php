<?php

namespace frontend\controllers;

use backend\models\archivoatributoex\Archivoatributoex;
use backend\models\atributoextra\Atributoextra;
use backend\models\derecho\Derecho;
use backend\models\genero\Genero;
use backend\models\idioma\Idioma;
use backend\models\pais\Pais;
use backend\models\tipoarchivo\Tipoarchivo;
use frontend\models\coleccion\Coleccion;
use frontend\models\detallearchivoatributoex\Detallearchivoatributoex;
use frontend\models\investigador\Investigador;
use frontend\models\temporalae\Temporalae;
use backend\models\user\User;
use Yii;
use frontend\models\archivo\Archivo;
use frontend\models\archivo\ArchivoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\validators\FileValidator;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\filters\AccessControl;

/**
 * ArchivoController implements the CRUD actions for Archivo model.
 */
class ArchivoController extends Controller {

    public $enableCsrfValidation = false;

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
                            'download',
                            'guardar_tipo_archivo',
                            'guardar',
                            'update_enlace'
                           
                        ], // El administrador tiene permisos sobre las siguientes acciones
                        // Este método nos permite crear un filtro sobre la identidad del usuario
                        // y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            return (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id == 2); // Es investigador
                        }
                    ],
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
                            return (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id == 3); // Usuario normal
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

    

    public function actionGuardar_tipo_archivo() {
        $session = Yii::$app->session;
        $session['tipo_archivo_seleccionado'] = $_POST['tipo_archivo'];
        // return json_encode($bandera);
    }

    /**
     * Lists all Archivo models.
     * @return mixed
     */
    public function actionIndex() {
        if (isset(Yii::$app->session['c_titulo'])) {
            $c_titulo = Yii::$app->session['c_titulo'];
        } else {
            $c_titulo = 'null';
        }
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Archivo();
        $tipoArchivo = ArrayHelper::map(Tipoarchivo::find()->orderBy('tar_tipo')->all(), 'tar_id', 'tar_tipo');

        if ($model->load(Yii::$app->request->post())) {
          //  return $this->redirect(['create', 'tar_id' => $model->tar_id]);
              return $this->redirect(['create']);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'c_titulo' => $c_titulo,
                    'model' => $model,
                    'tipoArchivo' => $tipoArchivo,
        ]);
    }

    /**
     * Displays a single Archivo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (isset(Yii::$app->session['c_titulo'])) {
            $c_titulo = Yii::$app->session['c_titulo'];
        } else {
            $c_titulo = 'null';
        }

        if (Detallearchivoatributoex::find()->where(['arc_id' => $id])->count() != 0) {
            //Se crea un array para el modelo de coleccion-pais
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id' => $id])->all();
        } else {
            //Se crea un array para el modelo de coleccion-pais
            $detalleAE = 0;
        }



        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'c_titulo' => $c_titulo,
                    'detalleAE' => $detalleAE,
        ]);
    }

    /**
     * Creates a new Archivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        
        $session = Yii::$app->session;
        $tar_id = $session['tipo_archivo_seleccionado'];
        
        $tipo = 1;

        if (isset(Yii::$app->session['c_id'])) {
            $c_id = Yii::$app->session['c_id'];
        } else {
            $c_id = 'null';
        }

        //Se cargan los valores iniciales de las siguinetes variables
        $model = new Archivo();
        $atributoExtra = [new Atributoextra()];
        //$inv = Investigador::find()->select(['inv_id'])->where(['usu_id'=>Yii::$app->user->identity->id])->one();
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $genero = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(), 'gen_id', 'gen_nombre');
        $idioma = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(), 'idi_id', 'idi_nombre');
        $derecho = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(), 'der_id', 'der_nombre');


        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id' => $tar_id])->all();
        $ae = ArrayHelper::map(Atributoextra::findAll($ta), 'aex_id', 'aex_nombre');



        if ($model->load(Yii::$app->request->post())) {
            // Es un archivo con tipo enlace
            $model->arc_enlace = 0;

            //Recogen los valores del widget para la tabla Coleccion-País
            $dataAE = Yii::$app->request->post('Atributoextra', []);

            //Se instancia la foto de portada subida por el investigador
            $archivo = UploadedFile::getInstance($model, 'arc_archivo');

            //Se verifica que exista el archivo existe, sino se le asigna un nombre provisional
            if ($archivo == '') {
                //Nombre provisional
                $model->arc_archivo = 'temporal';
            } else {
                //Se asigna el nombre a la foto y se sube el archivo al servidor
                $contArchivo = Archivo::find()->count();
                $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension);
                $model->arc_archivo = $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension;

                if ($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png') {
                    $model->arc_tipo = 'Imagen';
                } else {
                    if ($archivo->extension == 'mp3') {
                        $model->arc_tipo = 'Audio';
                    } else {
                        if ($archivo->extension == 'mp4') {
                            $model->arc_tipo = 'Video';
                        } else {
                            if ($archivo->extension == 'pdf') {
                                $model->arc_tipo = 'PDF';
                            } else {
                                $model->arc_tipo = 'Otro';
                            }
                        }
                    }
                }
            }

            $model->tar_id = $tar_id;
            $model->col_id = $c_id;
            $model->arc_estado = 'N';
            $model->arc_fechaCreacion = date('y-m-d H:i:s');
            $model->arc_fechaAudit = date('y-m-d H:i:s');
            $model->arc_accion = 'N';
            if ($model->save()) {
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $c_id])->one();                
                $users = User::find()->where(['rol_id'=>1])->all();
                foreach ($users as $user) {
                $this->sendEmailCreacion($user,$col->col_titulo,$model->arc_estadoarc,"");
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                
                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');


                    if ($tempAtributoExtra != null) {

                        $temp = new Detallearchivoatributoex();
                        $temp->arc_id = $model->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                                        ->where(['aex_id' => $tempAtributoExtra])
                                        ->andWhere(['tar_id' => $tar_id])->one();
                        $temp->aae_id = $consulta->aae_id;
                        $temp->dae_descripcion = ArrayHelper::getValue($index, 'aex_descripcion');
                        $temp->dae_estado = 'N';
                        $temp->dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp->dae_fechaAudit = date('y-m-d H:i:s');
                        $temp->dae_accion = 'N';
                        $temp->aex_id = $tempAtributoExtra;

                        if ($temp->dae_descripcion != null && $temp->dae_descripcion != '') {
                            $temp->save();
                        }
                    }
                };

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Archivo agregado!</h4>
                        El archivo fue agregado correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->arc_id]);
            }
        }

        return $this->render('create', [
                    'tipo' => $tipo,
                    'model' => $model,
                    'pais' => $pais,
                    'genero' => $genero,
                    'idioma' => $idioma,
                    'derecho' => $derecho,
                    'ae' => $ae,
                    'atributoExtra' => $atributoExtra,
        ]);
    }

    public function actionGuardar() {
        $session = Yii::$app->session;
        $tar_id = $session['tipo_archivo_seleccionado'];
        $tipo = 1;

        if (isset(Yii::$app->session['c_id'])) {
            $c_id = Yii::$app->session['c_id'];
        } else {
            $c_id = 'null';
        }

        //Se cargan los valores iniciales de las siguinetes variables
        $model = new Archivo();
        $atributoExtra = [new Atributoextra()];
        //$inv = Investigador::find()->select(['inv_id'])->where(['usu_id'=>Yii::$app->user->identity->id])->one();
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $genero = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(), 'gen_id', 'gen_nombre');
        $idioma = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(), 'idi_id', 'idi_nombre');
        $derecho = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(), 'der_id', 'der_nombre');


        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id' => $tar_id])->all();
        $ae = ArrayHelper::map(Atributoextra::findAll($ta), 'aex_id', 'aex_nombre');



        if ($model->load(Yii::$app->request->post())) {
            //Guardar 
            $model->arc_enlace = 1;

            //Recogen los valores del widget para la tabla Coleccion-País
            $dataAE = Yii::$app->request->post('Atributoextra', []);

            //Se instancia la foto de portada subida por el investigador
//            $archivo = UploadedFile::getInstance($model, 'arc_archivo');
            //Se verifica que exista el archivo existe, sino se le asigna un nombre provisional
//            if ($archivo == '') {
//                //Nombre provisional
//                $model->arc_archivo = 'temporal';
//            } else {
//                //Se asigna el nombre a la foto y se sube el archivo al servidor
//                $contArchivo = Archivo::find()->count();
//                $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension);
//                $model->arc_archivo = $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension;
//
//                if ($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png') {
//                    $model->arc_tipo = 'Imagen';
//                } else {
//                    if ($archivo->extension == 'mp3') {
//                        $model->arc_tipo = 'Audio';
//                    } else {
//                        if ($archivo->extension == 'mp4') {
//                            $model->arc_tipo = 'Video';
//                        } else {
//                            if ($archivo->extension == 'pdf') {
//                                $model->arc_tipo = 'PDF';
//                            } else {
//                                $model->arc_tipo = 'Otro';
//                            }
//                        }
//                    }
//                }
            $model->arc_tipo = 'Url';
//            }

            $model->tar_id = $tar_id;
            $model->col_id = $c_id;
            $model->arc_estado = 'N';
            $model->arc_fechaCreacion = date('y-m-d H:i:s');
            $model->arc_fechaAudit = date('y-m-d H:i:s');
            $model->arc_accion = 'N';
            if ($model->save()) {
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $c_id])->one();                
                $users = User::find()->where(['rol_id'=>1])->all();
                foreach ($users as $user) {
                $this->sendEmailCreacion($user,$col->col_titulo,$model->arc_estadoarc,"");
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                 
                 
                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');


                    if ($tempAtributoExtra != null) {

                        $temp = new Detallearchivoatributoex();
                        $temp->arc_id = $model->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                                        ->where(['aex_id' => $tempAtributoExtra])
                                        ->andWhere(['tar_id' => $tar_id])->one();
                        $temp->aae_id = $consulta->aae_id;
                        $temp->dae_descripcion = ArrayHelper::getValue($index, 'aex_descripcion');
                        $temp->dae_estado = 'N';
                        $temp->dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp->dae_fechaAudit = date('y-m-d H:i:s');
                        $temp->dae_accion = 'N';
                        $temp->aex_id = $tempAtributoExtra;

                        if ($temp->dae_descripcion != null && $temp->dae_descripcion != '') {
                            $temp->save();
                        }
                    }
                };

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Archivo agregado!</h4>
                        El archivo fue agregado correctamente.
                    </div>
                ');
                return $this->redirect(['view', 'id' => $model->arc_id]);
            }
        }

        return $this->render('guardar', [
                    'tipo' => $tipo,
                    'model' => $model,
                    'pais' => $pais,
                    'genero' => $genero,
                    'idioma' => $idioma,
                    'derecho' => $derecho,
                    'ae' => $ae,
                    'atributoExtra' => $atributoExtra,
        ]);
    }

    /**
     * Updates an existing Archivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $tipo = 2;
        //Se busca el modelo a editar dos veces, una para que el usuario modifique
        //Y la otra para comparar las modiciaciones que se realizarón
        $model = $this->findModel($id);
        $modelAnt = $this->findModel($id);

        //Se crea las listas de las tablas que tienen relación con archivos
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $genero = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(), 'gen_id', 'gen_nombre');
        $idioma = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(), 'idi_id', 'idi_nombre');
        $derecho = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(), 'der_id', 'der_nombre');

        //Se buscan los atributos extra para el tipo de archivo de la colección.
        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id' => $model->tar_id])->all();
        $ae = ArrayHelper::map(Atributoextra::findAll($ta), 'aex_id', 'aex_nombre');


        if (Detallearchivoatributoex::find()->where(['arc_id' => $id])->count() != 0) {
            $borrarDAAE = Detallearchivoatributoex::find()->where(['arc_id' => $model->arc_id])->all();
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id' => $id])->all();
        } else {
            $borrarDAAE = 0;
            $detalleAE = [new Detallearchivoatributoex];
        }

            
        //Si existen valores por el metodo POST (cuando el usuario de clic en guardar en el form)
        if ($model->load(Yii::$app->request->post())) {
             //Debe subir el archivo
                // ****************************************************************
                // ****************************************************************
                //*** MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************
                //Se instancia el archivo de portada subida por el investigador
                $archivo = UploadedFile::getInstance($model, 'arc_archivo');
                //Se verifica que exista el archivo, sino se le asigna el nombre anterior
                if ($archivo == '') {
                    //Nombre anterior
                    $model->arc_archivo = $modelAnt->arc_archivo;
                } else {
                    //Elimna el archivo antiguo
                    if (is_file($modelAnt->arc_archivo) && $modelAnt->arc_archivo != 'temporal') {
                        unlink('@frontend/web/img/archivo/' . $modelAnt->arc_archivo);
                    }
                    //Se asigna sube el nuevo archivo
                    $contArchivo = Archivo::find()->count();
                    $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension);
                    $model->arc_archivo = $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension;
                    if ($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png') {
                        $model->arc_tipo = 'Imagen';
                    } else {
                        if ($archivo->extension == 'mp3') {
                            $model->arc_tipo = 'Audio';
                        } else {
                            if ($archivo->extension == 'mp4') {
                                $model->arc_tipo = 'Video';
                            } else {
                                if ($archivo->extension == 'pdf') {
                                    $model->arc_tipo = 'PDF';
                                } else {
                                    $model->arc_tipo = 'Otro';
                                }
                            }
                        }
                    }
                }
                // ****************************************************************
                // ****************************************************************
                //*** FINALIZA MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************                
             // Fin de subir el archivo
            
            //*** MANEJO DE AUDITORIA ***//
            $model->arc_fechaAudit = date('y-m-d H:i:s');
            $model->arc_accion = 'M';
            //*** FINALIZAMANEJO DE AUDITORIA ***//
            //*** MANEJO DE DETALLE ATRIBUTOS EXTRA ***//
            $dataAE = Yii::$app->request->post('Detallearchivoatributoex', []);

            // Es un archivo en el servidor
             $model->arc_enlace = 0;
            if ($model->save()) {
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $model->col_id])->one();                
                $users = User::find()->where(['rol_id'=>1])->orderBy('id DESC')->all();               
                foreach ($users as $us) {
                $this->sendEmailCreacion($us,$col->col_titulo,$model->arc_estadoarc,"");
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

                if ($borrarDAAE != 0) {
                    ///Eliminado de registro antiguos
                    foreach ($borrarDAAE as $index) {
                        if ($index->dae_id != null) {
                            $tempX = new Detallearchivoatributoex();
                            $tempX->find()->where(['dae_id' => $index->dae_id])->one()->delete();
                        }
                    }
                }



                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');

                    if ($tempAtributoExtra != null) {
                        $temp = new Detallearchivoatributoex();
                        $temp->arc_id = $model->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                                        ->where(['aex_id' => $tempAtributoExtra])
                                        ->andWhere(['tar_id' => $model->tar_id])->one();
                        $temp->aae_id = $consulta->aae_id;

                        $temp->dae_descripcion = ArrayHelper::getValue($index, 'dae_descripcion');
                        $temp->dae_estado = 'N';
                        $temp->dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp->dae_fechaAudit = date('y-m-d H:i:s');
                        $temp->dae_accion = 'N';
                        $temp->aex_id = $tempAtributoExtra;
                        echo $temp->dae_descripcion . '--';
                        if ($temp->dae_descripcion != null && $temp->dae_descripcion != '') {
                            $temp->save();
                        }
                    }
                };

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4><i class="bx bx-check"></i>Archivo modificado!</h4>
                El archivo fue modificado correctamente.
            </div>
        ');
                return $this->redirect(['view', 'id' => $model->arc_id]);
            }
        }


        return $this->render('update', [
                    'tipo' => $tipo,
                    'model' => $model,
                    'pais' => $pais,
                    'genero' => $genero,
                    'idioma' => $idioma,
                    'derecho' => $derecho,
                    'ae' => $ae,
                    //'atributoExtra' => $atributoExtra,
                    'detalleAE' => $detalleAE,
                        //
                        //'detalleAE' => $detalleAE ,
                        //'archivoAE' => $archivoAE,
                        //'atributoE'=>$atributoE,
        ]);
    }

    
    public function actionUpdate_enlace($id) {
        $tipo = 2;
        //Se busca el modelo a editar dos veces, una para que el usuario modifique
        //Y la otra para comparar las modiciaciones que se realizarón
        $model = $this->findModel($id);
        $modelAnt = $this->findModel($id);

        //Se crea las listas de las tablas que tienen relación con archivos
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $genero = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(), 'gen_id', 'gen_nombre');
        $idioma = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(), 'idi_id', 'idi_nombre');
        $derecho = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(), 'der_id', 'der_nombre');

        //Se buscan los atributos extra para el tipo de archivo de la colección.
        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id' => $model->tar_id])->all();
        $ae = ArrayHelper::map(Atributoextra::findAll($ta), 'aex_id', 'aex_nombre');


        if (Detallearchivoatributoex::find()->where(['arc_id' => $id])->count() != 0) {
            $borrarDAAE = Detallearchivoatributoex::find()->where(['arc_id' => $model->arc_id])->all();
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id' => $id])->all();
        } else {
            $borrarDAAE = 0;
            $detalleAE = [new Detallearchivoatributoex];
        }

        //Si existen valores por el metodo POST (cuando el usuario de clic en guardar en el form)
        if ($model->load(Yii::$app->request->post())) {
           //Debe subir el archivo
                // ****************************************************************
                // ****************************************************************
                //*** MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************
                //Se instancia el archivo de portada subida por el investigador
                $archivo = UploadedFile::getInstance($model, 'arc_archivo');
                //Se verifica que exista el archivo, sino se le asigna el nombre anterior
                if ($archivo == '') {
                    //Nombre anterior
                    $model->arc_archivo = $modelAnt->arc_archivo;
                } else {
                    //Elimna el archivo antiguo
                    if (is_file($modelAnt->arc_archivo) && $modelAnt->arc_archivo != 'temporal') {
                        unlink('@frontend/web/img/archivo/' . $modelAnt->arc_archivo);
                    }
                    //Se asigna sube el nuevo archivo
                    $contArchivo = Archivo::find()->count();
                    $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension);
                    $model->arc_archivo = $archivo->baseName . ($contArchivo + 1) . '.' . $archivo->extension;
                    if ($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png') {
                        $model->arc_tipo = 'Imagen';
                    } else {
                        if ($archivo->extension == 'mp3') {
                            $model->arc_tipo = 'Audio';
                        } else {
                            if ($archivo->extension == 'mp4') {
                                $model->arc_tipo = 'Video';
                            } else {
                                if ($archivo->extension == 'pdf') {
                                    $model->arc_tipo = 'PDF';
                                } else {
                                    $model->arc_tipo = 'Otro';
                                }
                            }
                        }
                    }
                }
                // ****************************************************************
                // ****************************************************************
                //*** FINALIZA MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************                
            // Fin de subir el archivo
            
            //*** MANEJO DE AUDITORIA ***//
            $model->arc_fechaAudit = date('y-m-d H:i:s');
            $model->arc_accion = 'M';
            //*** FINALIZAMANEJO DE AUDITORIA ***//
            //*** MANEJO DE DETALLE ATRIBUTOS EXTRA ***//
            $dataAE = Yii::$app->request->post('Detallearchivoatributoex', []);

            // Es un enlace
             $model->arc_enlace = 1;
            if ($model->save()) {
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $model->col_id])->one();                
                $users = User::find()->where(['rol_id'=>1])->all();
                foreach ($users as $user) {
                $this->sendEmailCreacion($user,$col->col_titulo,$model->arc_estadoarc,$user->use_apellido." ".$user->use_nombre);
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

                if ($borrarDAAE != 0) {
                    ///Eliminado de registro antiguos
                    foreach ($borrarDAAE as $index) {
                        if ($index->dae_id != null) {
                            $tempX = new Detallearchivoatributoex();
                            $tempX->find()->where(['dae_id' => $index->dae_id])->one()->delete();
                        }
                    }
                }



                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');

                    if ($tempAtributoExtra != null) {
                        $temp = new Detallearchivoatributoex();
                        $temp->arc_id = $model->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                                        ->where(['aex_id' => $tempAtributoExtra])
                                        ->andWhere(['tar_id' => $model->tar_id])->one();
                        $temp->aae_id = $consulta->aae_id;

                        $temp->dae_descripcion = ArrayHelper::getValue($index, 'dae_descripcion');
                        $temp->dae_estado = 'N';
                        $temp->dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp->dae_fechaAudit = date('y-m-d H:i:s');
                        $temp->dae_accion = 'N';
                        $temp->aex_id = $tempAtributoExtra;
                        echo $temp->dae_descripcion . '--';
                        if ($temp->dae_descripcion != null && $temp->dae_descripcion != '') {
                            $temp->save();
                        }
                    }
                };

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4><i class="bx bx-check"></i>Archivo modificado!</h4>
                El archivo fue modificado correctamente.
            </div>
        ');
                return $this->redirect(['view', 'id' => $model->arc_id]);
            }
        }


        return $this->render('update_enlace', [
                    'tipo' => $tipo,
                    'model' => $model,
                    'pais' => $pais,
                    'genero' => $genero,
                    'idioma' => $idioma,
                    'derecho' => $derecho,
                    'ae' => $ae,
                    //'atributoExtra' => $atributoExtra,
                    'detalleAE' => $detalleAE,
                        //
                        //'detalleAE' => $detalleAE ,
                        //'archivoAE' => $archivoAE,
                        //'atributoE'=>$atributoE,
        ]);
    }
    
    
    /**
     * Deletes an existing Archivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        $archivo = $this->findModel($id);
        if (is_file($archivo->arc_archivo) && $archivo->arc_archivo != 'anonimo') {
            unlink('@frontend/web/img/archivo/' . $archivo->arc_archivo);
        }

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('msg', '
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-check"></i>Archivo eliminado!</h4>
                    El archivo se eliminó correctamente.
                </div>
            ');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Archivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Archivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Archivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function downloadFile($dir, $file, $extensions = []) {
        //Si el directorio existe
        if (is_dir($dir)) {
            //Ruta absoluta del archivo
            $path = $dir . $file;

            //Si el archivo existe
            if (is_file($path)) {
                //Obtener información del archivo
                $file_info = pathinfo($path);
                //Obtener la extensión del archivo
                $extension = $file_info["extension"];

                if (is_array($extensions)) {
                    //Si el argumento $extensions es un array
                    //Comprobar las extensiones permitidas
                    foreach ($extensions as $e) {
                        //Si la extension es correcta
                        if ($e === $extension) {
                            //Procedemos a descargar el archivo
                            // Definir headers
                            $size = filesize($path);
                            header("Content-Type: application/force-download");
                            header("Content-Disposition: attachment; filename=$file");
                            header("Content-Transfer-Encoding: binary");
                            header("Content-Length: " . $size);
                            // Descargar archivo
                            readfile($path);
                            //Correcto
                            return true;
                        }
                    }
                }
            }
        }
        //Ha ocurrido un error al descargar el archivo
        return false;
    }

    public function actionDownload() {
        if (Yii::$app->request->get("file")) {
            //Si el archivo no se ha podido descargar
            //downloadFile($dir, $file, $extensions=[])
            if (!$this->downloadFile('@frontend/web/img/archivo/', Html::encode($_GET["file"]), ['jpg', 'jpeg', 'png', 'mp3', 'wav', 'avi', 'mov', 'mp4', 'pdf', 'txt', 'doc', 'docx', 'xlsx', 'pptx', 'zip', 'rar'])) {
                //Mensaje flash para mostrar el error
                Yii::$app->session->setFlash("errordownload");
            }
        }

        return $this->render("download");
    }
    
    protected function sendEmailCreacion($us, $nombCole,$estadoCol,$observacion)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'archivoCreado-html', 'text' => 'archivoCreado-text'],
                [
                    'user' => $us,
                    'titulo' => $nombCole,
                    'estado' => $estadoCol,
                    'observacion' => $observacion,
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' - DYAC'])
            ->setTo($us->email)
            ->setSubject('Solicitud de aprobación de archivo')
            ->send();
    }

}
