<?php

namespace frontend\controllers;

use Yii;
use backend\models\pais\Pais;
use backend\models\usergenero\Usergenero;
use frontend\models\investigador\Investigador;
use frontend\models\investigador\InvestigadorSearch;
use frontend\models\user\User;
use frontend\models\user\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

use yii\filters\AccessControl;




/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                             'cambiarclave',
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
                            'cambiarclave',
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
    
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $pais  = \yii\helpers\ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(),'pai_id', 'pai_nombre');
        $genero = \yii\helpers\ArrayHelper::map(Usergenero::find()->all(),'uge_id', 'uge_nombre');

        $rol_investigador = 2;
        $use_estado_activo = 2;

        $id = Yii::$app->user->identity->id;

        $model = $this->findModel($id);
        $modelFoto = $this->findModel($id);

        //Verificación si existe el registro del Investigador en la base de datos
        if($model->rol_id == $rol_investigador && $model->use_estado ==$use_estado_activo){
            $cont = Investigador::find()->where(['usu_id'=>$id])->count();
            //Si no existe registro, se inicia uno nuevo
            if($cont == 0){
                $modelInvestigador = new Investigador();
                $modelInvestigador -> inv_estado = 'N';
                $modelInvestigador -> inv_fechaCreacion = date('y-m-d H:i:s');
                $modelInvestigador -> inv_fechaAudit = date('y-m-d H:i:s');
                $modelInvestigador -> inv_accion = 'N';
            //Si existe registro, carga los datos
            }else{
                $modelInvestigador = Investigador::find()->where(['usu_id'=>$id])->one();
                $modelInvestigador -> inv_fechaAudit = date('y-m-d H:i:s');
                $modelInvestigador -> inv_accion = 'M';
            }
        }

        if ($model->load(Yii::$app->request->post()) ) {

            $foto = UploadedFile::getInstance($model,'use_foto');

            if ($foto == ''){
                $model->use_foto = $modelFoto->use_foto;
            }else{

                if($modelFoto->use_foto != 'usuario_anonimo.jpg'){
                    unlink(Url::to('../../backend/web/img/user/').$modelFoto->use_foto);
                }

                $modelFoto = User::find()->count();
                $foto->saveAs(Url::to('../../backend/web/img/user/'). $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension);
                $model->use_foto = $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension;

            }

            $model -> use_fechaAudit = date('y-m-d H:i:s');
            $model -> use_accion = 'M';



            if($model->rol_id == $rol_investigador && $model->use_estado == $use_estado_activo) {

                if($modelInvestigador->load(Yii::$app->request->post())){

                    if ($modelInvestigador->save()) {
                        Yii::$app->session->setFlash('msg', '
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                                    <h4><i class="bx bx-check"></i>Perfil modificado correctamente!</h4>
                                    El perfil se modificó correctamente.
                                </div>
                            ');
                        if ($model->signup()) {
                            return $this->redirect(['update', 'id' => $model->id]);
                        }
                    }
                }

            }else{

                Yii::$app->session->setFlash('msg', '
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                                    <h4><i class="bx bx-check"></i>Perfil modificado correctamente!</h4>
                                    El perfil se modificó correctamente.
                                </div>
                            ');
                if ($model->signup()) {
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            }

        }

        if($model->rol_id == $rol_investigador && $model->use_estado == $use_estado_activo) {
            return $this->render('update', [
                'model' => $model,
                'modelInvestigador' => $modelInvestigador,
                'pais' => $pais,
                'genero' => $genero,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model,
                'pais' => $pais,
                'genero' => $genero,
            ]);
        }



    }

    
    
     public function actionCambiarclave()
    {

        $pais  = \yii\helpers\ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(),'pai_id', 'pai_nombre');
        $genero = \yii\helpers\ArrayHelper::map(Usergenero::find()->all(),'uge_id', 'uge_nombre');

        $rol_investigador = 2;
        $use_estado_activo = 2;

        $id = Yii::$app->user->identity->id;

        $model = $this->findModel($id);
        $modelFoto = $this->findModel($id);

        //Verificación si existe el registro del Investigador en la base de datos
        if($model->rol_id == $rol_investigador && $model->use_estado ==$use_estado_activo){
            $cont = Investigador::find()->where(['usu_id'=>$id])->count();
            //Si no existe registro, se inicia uno nuevo
            if($cont == 0){
                $modelInvestigador = new Investigador();
                $modelInvestigador -> inv_estado = 'N';
                $modelInvestigador -> inv_fechaCreacion = date('y-m-d H:i:s');
                $modelInvestigador -> inv_fechaAudit = date('y-m-d H:i:s');
                $modelInvestigador -> inv_accion = 'N';
            //Si existe registro, carga los datos
            }else{
                $modelInvestigador = Investigador::find()->where(['usu_id'=>$id])->one();
                $modelInvestigador -> inv_fechaAudit = date('y-m-d H:i:s');
                $modelInvestigador -> inv_accion = 'M';
            }
        }

        if ($model->load(Yii::$app->request->post()) ) {

            $foto = UploadedFile::getInstance($model,'use_foto');

            if ($foto == ''){
                $model->use_foto = $modelFoto->use_foto;
            }else{

                if($modelFoto->use_foto != 'usuario_anonimo.jpg'){
                    unlink(Url::to('../../backend/web/img/user/').$modelFoto->use_foto);
                }

                $modelFoto = User::find()->count();
                $foto->saveAs(Url::to('../../backend/web/img/user/'). $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension);
                $model->use_foto = $foto->baseName . '_'.$model->use_nombre.$model->use_apellido.'_'.($modelFoto+1) .'.' . $foto->extension;

            }

            $model -> use_fechaAudit = date('y-m-d H:i:s');
            $model -> use_accion = 'M';



            if($model->rol_id == $rol_investigador && $model->use_estado == $use_estado_activo) {

                if($modelInvestigador->load(Yii::$app->request->post())){

                    if ($modelInvestigador->save()) {
                        Yii::$app->session->setFlash('msg', '
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                                    <h4><i class="bx bx-check"></i>Perfil modificado correctamente!</h4>
                                    El perfil se modificó correctamente.
                                </div>
                            ');
                        if ($model->signup()) {
                            return $this->redirect(['update', 'id' => $model->id]);
                        }
                    }
                }

            }else{

                Yii::$app->session->setFlash('msg', '
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                                    <h4><i class="bx bx-check"></i>Clave modificada correctamente!</h4>
                                    La clave se modificó correctamente.
                                </div>
                            ');
                if ($model->signup()) {
                    return $this->redirect(['cambiarclave', 'id' => $model->id]);
                }
            }

        }

        if($model->rol_id == $rol_investigador && $model->use_estado == $use_estado_activo) {
            return $this->render('cambiarclave', [
                'model' => $model,
                'modelInvestigador' => $modelInvestigador,
                'pais' => $pais,
                'genero' => $genero,
            ]);
        }else{
            return $this->render('cambiarclave', [
                'model' => $model,
                'pais' => $pais,
                'genero' => $genero,
            ]);
        }



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
