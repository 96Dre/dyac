<?php

namespace backend\controllers;

use backend\models\archivoatributoex\Archivoatributoex;
use backend\models\atributoextra\Atributoextra;
use backend\models\coleccion\Coleccion;
use backend\models\derecho\Derecho;
use backend\models\genero\Genero;
use backend\models\idioma\Idioma;
use backend\models\pais\Pais;
use backend\models\user\User;
use frontend\models\detallearchivoatributoex\Detallearchivoatributoex;
use backend\models\tipoarchivo\Tipoarchivo;
use Yii;
use backend\models\archivo\Archivo;
use backend\models\archivo\ArchivoSearch;
use frontend\models\investigador\Investigador;
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
class ArchivoController extends Controller
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
                            'update',
                            'delete',
                            'pendientes',
                            'cambiar',
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
     * Lists all Archivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Archivo();
        $tipoArchivo  = ArrayHelper::map(Tipoarchivo::find()->orderBy('tar_tipo')->all(),'tar_id', 'tar_tipo');

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['create', 'tar_id' => $model->tar_id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'tipoArchivo' => $tipoArchivo,
        ]);
    }

    public function actionPendientes()
    {
        $searchModel = new ArchivoSearch();
        $dataProvider = $searchModel->searchPendientes(Yii::$app->request->queryParams);
        $model = new Archivo();
        $tipoArchivo  = ArrayHelper::map(Tipoarchivo::find()->orderBy('tar_tipo')->all(),'tar_id', 'tar_tipo');

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['create', 'tar_id' => $model->tar_id]);
        }

        return $this->render('pendientes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    public function actionView($id)
    {
        $model =$this->findModel($id);
        $c_titulo = Coleccion::find()->select(['col_titulo'])->where(['col_id' => $model->col_id])->one();

        if(Detallearchivoatributoex::find()->where(['arc_id'=> $id])->count() != 0)
        {
            //Se crea un array para el modelo de coleccion-pais
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id'=> $id])->all();
        }else{
            //Se crea un array para el modelo de coleccion-pais
            $detalleAE = 0;
        }


        return $this->render('view', [
            'model' => $model,
            'c_titulo'=>$c_titulo,
            'detalleAE' => $detalleAE,
        ]);
    }


    /**
     * Updates an existing Archivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $tipo = 2;
        //Se busca el modelo a editar dos veces, una para que el usuario modifique
        //Y la otra para comparar las modiciaciones que se realizarón
        $model = $this->findModel($id);
        $modelAnt = $this->findModel($id);

        //Se crea las listas de las tablas que tienen relación con archivos
        $pais  = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(),'pai_id', 'pai_nombre');
        $genero  = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(),'gen_id', 'gen_nombre');
        $idioma  = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(),'idi_id', 'idi_nombre');
        $derecho  = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(),'der_id', 'der_nombre');

        //Se buscan los atributos extra para el tipo de archivo de la colección.
        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id'=>$model->tar_id])->all();
        $ae =ArrayHelper::map(Atributoextra::findAll($ta),'aex_id', 'aex_nombre');


        if(Detallearchivoatributoex::find()->where(['arc_id'=> $id])->count() != 0){
            $borrarDAAE = Detallearchivoatributoex::find()->where(['arc_id'=> $model->arc_id])->all();
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id'=> $id])->all();
        }
        else{
            $borrarDAAE = 0;
            $detalleAE = [new Detallearchivoatributoex];
        }

        //Si existen valores por el metodo POST (cuando el usuario de clic en guardar en el form)
        if ($model->load(Yii::$app->request->post())){
            //*** MANEJO DEL ARCHIVO ***//
            //Se instancia el archivo de portada subida por el investigador
            $archivo = UploadedFile::getInstance($model,'arc_archivo');
            //Se verifica que exista el archivo, sino se le asigna el nombre anterior
            if ($archivo == ''){
                //Nombre anterior
                $model->arc_archivo = $modelAnt->arc_archivo;
            }else{
                //Elimna el archivo antiguo
                if($modelAnt->arc_archivo != 'temporal'){
                    unlink('../../frontend/web/img/archivo/'.$modelAnt->arc_archivo);
                }
                //Se asigna sube el nuevo archivo
                $contArchivo = \frontend\models\archivo\Archivo::find()->count();
                $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo+1). '.' . $archivo->extension);
                $model->arc_archivo = $archivo->baseName . ($contArchivo+1) . '.' . $archivo->extension;
                if($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png' ){
                    $model->arc_tipo = 'Imagen';
                }else{
                    if($archivo->extension == 'mp3'){
                        $model->arc_tipo = 'Audio';
                    }else{
                        if($archivo->extension == 'mp4'){
                            $model->arc_tipo = 'Video';
                        }else{
                            if($archivo->extension == 'pdf'){
                                $model->arc_tipo = 'PDF';
                            }else{
                                $model->arc_tipo = 'Otro';
                            }
                        }

                    }
                }
            }
            //*** FINALIZA MANEJO DEL ARCHIVO ***//


            //*** MANEJO DE AUDITORIA ***//
            $model -> arc_fechaAudit = date('y-m-d H:i:s');
            $model -> arc_accion = 'M';
            //*** FINALIZAMANEJO DE AUDITORIA ***//


            //*** MANEJO DE DETALLE ATRIBUTOS EXTRA ***//
            $dataAE = Yii::$app->request->post('Detallearchivoatributoex', []);


            if( $model->save()) {

/*
                if($borrarDAAE != 0){
                    ///Eliminado de registro antiguos
                    foreach ($borrarDAAE as $index){
                        if($index->dae_id != null ) {
                            $tempX = new Detallearchivoatributoex();
                            $tempX->find()->where(['dae_id' => $index->dae_id])->one()->delete();
                        }
                    }
                }*/


/*
                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');

                    if($tempAtributoExtra != null){
                        $temp = new Detallearchivoatributoex();
                        $temp -> arc_id = $model ->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                            ->where(['aex_id'=>$tempAtributoExtra])
                            ->andWhere(['tar_id'=>$model->tar_id])->one();
                        $temp -> aae_id = $consulta->aae_id;

                        $temp -> dae_descripcion = ArrayHelper::getValue($index, 'dae_descripcion');
                        $temp -> dae_estado = 'N';
                        $temp -> dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp -> dae_fechaAudit = date('y-m-d H:i:s');
                        $temp -> dae_accion =  'N';
                        $temp -> aex_id = $tempAtributoExtra;
                        echo  $temp -> dae_descripcion . '--';
                        if( $temp -> dae_descripcion != null && $temp -> dae_descripcion != '' ){
                            $temp->save();
                        }
                    }

                };*/

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Archivo modificado!</h4>
                        El archivo fue modificado correctamente.
                    </div>
                ');

                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $model->col_id])->one();

                $inv = Investigador::find()->where(['inv_id'=>$col->inv_id])->one();
                $user = User::find()->where(['id'=>$inv->usu_id])->one();

                $this->sendEmail($user,$col->col_titulo,$model->arc_estadoarc,$model->observacion);

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
            'detalleAE' => $detalleAE ,

            //
            //'detalleAE' => $detalleAE ,
            //'archivoAE' => $archivoAE,
            //'atributoE'=>$atributoE,

        ]);
    }
public function actionCambiar($id)
    {
        $tipo = 2;
        //Se busca el modelo a editar dos veces, una para que el usuario modifique
        //Y la otra para comparar las modiciaciones que se realizarón
        $model = $this->findModel($id);
        $modelAnt = $this->findModel($id);

        //Se crea las listas de las tablas que tienen relación con archivos
        $pais  = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(),'pai_id', 'pai_nombre');
        $genero  = ArrayHelper::map(Genero::find()->orderBy('gen_nombre')->all(),'gen_id', 'gen_nombre');
        $idioma  = ArrayHelper::map(Idioma::find()->orderBy('idi_nombre')->all(),'idi_id', 'idi_nombre');
        $derecho  = ArrayHelper::map(Derecho::find()->orderBy('der_nombre')->all(),'der_id', 'der_nombre');

        //Se buscan los atributos extra para el tipo de archivo de la colección.
        $ta = Archivoatributoex::find()->select(['aex_id'])->where(['tar_id'=>$model->tar_id])->all();
        $ae =ArrayHelper::map(Atributoextra::findAll($ta),'aex_id', 'aex_nombre');


        if(Detallearchivoatributoex::find()->where(['arc_id'=> $id])->count() != 0){
            $borrarDAAE = Detallearchivoatributoex::find()->where(['arc_id'=> $model->arc_id])->all();
            $detalleAE = Detallearchivoatributoex::find()->where(['arc_id'=> $id])->all();
        }
        else{
            $borrarDAAE = 0;
            $detalleAE = [new Detallearchivoatributoex];
        }

        //Si existen valores por el metodo POST (cuando el usuario de clic en guardar en el form)
        if ($model->load(Yii::$app->request->post())){
             if ($model->tar_id == 2 || $model->tar_id == 3) { // Es audio o video
                //Guarda la URL normal;
                
            } else { //Debe subir el archivo
                // ****************************************************************
                // ****************************************************************
                //*** MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************
            //*** MANEJO DEL ARCHIVO ***//
            //Se instancia el archivo de portada subida por el investigador
            $archivo = UploadedFile::getInstance($model,'arc_archivo');
            //Se verifica que exista el archivo, sino se le asigna el nombre anterior
            if ($archivo == ''){
                //Nombre anterior
                $model->arc_archivo = $modelAnt->arc_archivo;
            }else{
                //Elimna el archivo antiguo
                if($modelAnt->arc_archivo != 'temporal'){
                    unlink('../../frontend/web/img/archivo/'.$modelAnt->arc_archivo);
                }
                //Se asigna sube el nuevo archivo
                $contArchivo = \frontend\models\archivo\Archivo::find()->count();
                $archivo->saveAs('@frontend/web/img/archivo/' . $archivo->baseName . ($contArchivo+1). '.' . $archivo->extension);
                $model->arc_archivo = $archivo->baseName . ($contArchivo+1) . '.' . $archivo->extension;
                if($archivo->extension == 'jpg' || $archivo->extension == 'jpeg' || $archivo->extension == 'png' ){
                    $model->arc_tipo = 'Imagen';
                }else{
                    if($archivo->extension == 'mp3'){
                        $model->arc_tipo = 'Audio';
                    }else{
                        if($archivo->extension == 'mp4'){
                            $model->arc_tipo = 'Video';
                        }else{
                            if($archivo->extension == 'pdf'){
                                $model->arc_tipo = 'PDF';
                            }else{
                                $model->arc_tipo = 'Otro';
                            }
                        }

                    }
                }
            }
            //*** FINALIZA MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************
                //*** FINALIZA MANEJO DEL ARCHIVO ***//
                // ****************************************************************
                // ****************************************************************                
            } // Fin de subir el archivo

            //*** MANEJO DE AUDITORIA ***//
            $model -> arc_fechaAudit = date('y-m-d H:i:s');
            $model -> arc_accion = 'M';
            //*** FINALIZAMANEJO DE AUDITORIA ***//


            //*** MANEJO DE DETALLE ATRIBUTOS EXTRA ***//
            $dataAE = Yii::$app->request->post('Detallearchivoatributoex', []);


            if( $model->save()) {

/*
                if($borrarDAAE != 0){
                    ///Eliminado de registro antiguos
                    foreach ($borrarDAAE as $index){
                        if($index->dae_id != null ) {
                            $tempX = new Detallearchivoatributoex();
                            $tempX->find()->where(['dae_id' => $index->dae_id])->one()->delete();
                        }
                    }
                }*/


/*
                //Guardan los valores de la relación coleccion-pais
                foreach ($dataAE as $index) {
                    $tempAtributoExtra = ArrayHelper::getValue($index, 'aex_id');

                    if($tempAtributoExtra != null){
                        $temp = new Detallearchivoatributoex();
                        $temp -> arc_id = $model ->arc_id;
                        $consulta = Archivoatributoex::find()->select(['aae_id'])
                            ->where(['aex_id'=>$tempAtributoExtra])
                            ->andWhere(['tar_id'=>$model->tar_id])->one();
                        $temp -> aae_id = $consulta->aae_id;

                        $temp -> dae_descripcion = ArrayHelper::getValue($index, 'dae_descripcion');
                        $temp -> dae_estado = 'N';
                        $temp -> dae_fechaCreacion = date('y-m-d H:i:s');
                        $temp -> dae_fechaAudit = date('y-m-d H:i:s');
                        $temp -> dae_accion =  'N';
                        $temp -> aex_id = $tempAtributoExtra;
                        echo  $temp -> dae_descripcion . '--';
                        if( $temp -> dae_descripcion != null && $temp -> dae_descripcion != '' ){
                            $temp->save();
                        }
                    }

                };*/

                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Archivo modificado!</h4>
                        El archivo fue modificado correctamente.
                    </div>
                ');

                $col = Coleccion::find()->select(['col_titulo','inv_id'])->where(['col_id' => $model->col_id])->one();

                $inv = Investigador::find()->where(['inv_id'=>$col->inv_id])->one();
                $user = User::find()->where(['id'=>$inv->usu_id])->one();

                $this->sendEmail($user,$col->col_titulo,$model->arc_estadoarc,$model->observacion);

                return $this->redirect(['view', 'id' => $model->arc_id]);
            }
        }


        return $this->render('cambiar', [
            'tipo' => $tipo,
            'model' => $model,
            'pais' => $pais,
            'genero' => $genero,
            'idioma' => $idioma,
            'derecho' => $derecho,
            'ae' => $ae,
            //'atributoExtra' => $atributoExtra,
            'detalleAE' => $detalleAE ,

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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Archivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Archivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user,$nombCole,$estadoCol,$observacion)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'archivoVerify-html', 'text' => 'archivoVerify-text'],
                [
                    'user' => $user,
                    'titulo' => $nombCole,
                    'estado' => $estadoCol,
                    'observacion' => $observacion,
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' - DYAC'])
            ->setTo($user->email)
            ->setSubject('Solicitud de aprobación de archivo')
            ->send();
    }
}
