<?php

namespace frontend\controllers;

use backend\models\disciplina\Disciplina;
use backend\models\user\User;
use frontend\models\archivo\Archivo;
use frontend\models\coleccion\Coleccion;
use frontend\models\coleccionatributoex\Coleccionatributoex;
use frontend\models\coleccionpais\Coleccionpais;
use frontend\models\coleccionpersona\Coleccionpersona;
use frontend\models\detallearchivoatributoex\Detallearchivoatributoex;
use frontend\models\investigador\Investigador;
use frontend\models\palabraclave\Palabraclave;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;
use \yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller {
    //public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                        [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionResultado() {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */
        $buscar_texto = Yii::$app->session->get('parametro_busqueda');
        $buscar_en_colecciones = Yii::$app->session->get('parametro_colecciones');
        $buscar_en_investigadores = Yii::$app->session->get('parametro_investigadores');
        $buscar_en_disciplinas = Yii::$app->session->get('parametro_disciplinas');
        $buscar_en_palabras_claves = Yii::$app->session->get('parametro_palabras_claves');
        if ($buscar_en_colecciones > 0 or $buscar_en_investigadores > 0 or $buscar_en_disciplinas > 0 or $buscar_en_palabras_claves > 0) {
            $sql_condicional = "";
            if ($buscar_en_colecciones == 1) {
                $sql_condicional = "c.col_titulo LIKE '%"
                        . $buscar_texto . "%' 
                    OR c.col_descripcion LIKE '%"
                        . $buscar_texto . "%'";
            }
            if ($buscar_en_investigadores == 1) {
                if ($sql_condicional == "") {
                    $sql_condicional = "";
                } else {
                    $sql_condicional = $sql_condicional . " OR ";
                }
                $sql_condicional = $sql_condicional . " u.use_nombre LIKE '%"
                        . $buscar_texto . "%' 
                    OR u.use_apellido LIKE '%"
                        . $buscar_texto . "%' ";
            }
            if ($buscar_en_disciplinas == 1) {
                if ($sql_condicional == "") {
                    $sql_condicional = "";
                } else {
                    $sql_condicional = $sql_condicional . " OR ";
                }
                $sql_condicional = $sql_condicional . " d.dis_nombre LIKE '%"
                        . $buscar_texto . "%'";
            }
            if ($buscar_en_palabras_claves == 1) {
                if ($sql_condicional == "") {
                    $sql_condicional = "";
                } else {
                    $sql_condicional = $sql_condicional . " OR ";
                }
                $sql_condicional = $sql_condicional . " pc.`pcl_palabraClave` LIKE '%"
                        . $buscar_texto . "%'";
            }

            $sql = "SELECT  c.* FROM coleccion AS c
                    INNER JOIN investigador AS i
                    ON c.`inv_id` = i.`inv_id`
                    INNER JOIN `user` AS u
                    ON u.`id` = i.`usu_id`
                    INNER JOIN disciplina AS d
                    ON c.`dis_id` = d.`dis_id`                                
                    INNER JOIN `palabra_clave` AS pc
                    ON c.`col_id` = pc.`col_id`
                    WHERE c.col_estadocol = 'A' 
                    AND u.use_accion = 'M'
                    AND u.status = 10 
                    AND (" . $sql_condicional . ") group by c.col_id";
        } else { // Busca en todo
            $sql_condicional = "        c.col_titulo LIKE '%"
                    . $buscar_texto . "%' OR c.col_descripcion LIKE '%"
                    . $buscar_texto . "%' OR u.use_nombre LIKE '%"
                    . $buscar_texto . "%' OR u.use_apellido LIKE '%"
                    . $buscar_texto . "%'  OR d.dis_nombre LIKE '%"
                    . $buscar_texto . "%' OR pc.`pcl_palabraClave` LIKE '%"
                    . $buscar_texto . "%'";

            $sql = "SELECT  c.* FROM coleccion AS c
                    INNER JOIN investigador AS i
                    ON c.`inv_id` = i.`inv_id`
                    INNER JOIN `user` AS u
                    ON u.`id` = i.`usu_id`
                    INNER JOIN disciplina AS d
                    ON c.`dis_id` = d.`dis_id`                                
                    INNER JOIN `palabra_clave` AS pc
                    ON c.`col_id` = pc.`col_id`
                    WHERE c.col_estadocol = 'A' 
                    AND u.use_accion = 'M'
                    AND u.status = 10 
                    AND (" . $sql_condicional . ") group by c.col_id";
        }
        $coleccion = Coleccion::findBySql($sql)->all();

//        if (isset($_GET['titulo']) && $_GET['titulo'] != '') { // Buscar Colección
//            $buscar_texto = $_GET['titulo'];
//            $coleccion = Coleccion::findBySql("SELECT 
//                    * FROM coleccion            
//                    WHERE col_titulo like '%"
//                            . $_GET['titulo'] . "%'"
//                            . " and col_estadocol = 'A' ")->all();
//        } else {
//            if (isset($_GET['nombre']) && $_GET['nombre'] != '') { // Buscar Investigador
//                $buscar_texto = $_GET['nombre'];
//                $coleccion = Coleccion::findBySql("SELECT  c.* FROM coleccion as c
//                                inner join investigador as i
//                                on c.`inv_id` = i.`inv_id`
//                                inner join `user` as u
//                                on u.`id` = i.`usu_id`
//                                WHERE u.use_nombre like '%"
//                                . $_GET['nombre'] . "%'
//                                or u.use_apellido LIKE '%"
//                                . $_GET['nombre'] . "%' "
//                                . " and c.col_estadocol = 'A'"
//                                . " and u.use_accion = 'M'"
//                                . " and u.status = 10")->all();
//            } else {
//                if (isset($_GET['disciplina']) && $_GET['disciplina'] != '') { // Buscar Disciplina
//                    $buscar_texto = $_GET['disciplina'];
//                    $coleccion = Coleccion::findBySql("SELECT  c.* FROM coleccion AS c
//                                INNER JOIN investigador AS i
//                                ON c.`inv_id` = i.`inv_id`
//                                INNER JOIN `user` AS u
//                                ON u.`id` = i.`usu_id`
//                                INNER JOIN disciplina AS d
//                                ON c.`dis_id` = d.`dis_id`
//                                WHERE d.dis_nombre LIKE '%"
//                                    . $_GET['disciplina'] . "%'"
//                                    . " and c.col_estadocol = 'A'"
//                                    . " and u.use_accion = 'M'"
//                                    . " and u.status = 10")->all();
//                } else {
//                    $buscar_texto = Yii::$app->session->get('parametro_busqueda');
//                    $coleccion = Coleccion::findBySql("SELECT  c.* FROM coleccion AS c
//                                INNER JOIN investigador AS i
//                                ON c.`inv_id` = i.`inv_id`
//                                INNER JOIN `user` AS u
//                                ON u.`id` = i.`usu_id`
//                                INNER JOIN disciplina AS d
//                                ON c.`dis_id` = d.`dis_id`
//                                WHERE c.col_titulo like '%"
//                                    . $buscar_texto . "%' or c.col_descripcion like '%"
//                                    . $buscar_texto . "%' or u.use_nombre like '%"
//                                    . $buscar_texto . "%' or u.use_apellido like '%"
//                                    . $buscar_texto . "%' or d.dis_nombre like '%"
//                                    . $buscar_texto . "%'"
//                                    . "  and c.col_estadocol = 'A' "
//                                    . " and u.use_accion = 'M'"
//                                    . " and u.status = 10")->all();
//                }
//            }
//        }
        return $this->render('resultado', [
                    'buscar_texto' => $buscar_texto,
                    'buscar_en_colecciones' => $buscar_en_colecciones,
                    'coleccion' => $coleccion,
                    'model_coleccion' => $model_coleccion,
        ]);
    }

    public function actionIndex() {

        $model_coleccion = new Coleccion();

        $colecciones = Coleccion::find()
                ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                ->where(['col_estadoCol' => 'A'])
                ->orderBy('col_titulo ASC')->limit(4)
                ->all();

        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }

        return $this->render('index', [
                    'colecciones' => $colecciones,
                    'model_coleccion' => $model_coleccion,
        ]);
    }

    public function actionAyuda() {
        return $this->render('ayuda');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {

            $user = User::find()->where(['email' => $model->email])->andFilterWhere(['rol_id' => 1])->count();

            if ($user != 1) {
                if ($model->login()) {
                    return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
                    //return $this->goBack();
                } else {
                    $model->password = '';
                    //Mensaje de error al iniciar sesión
                    Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-error"></i>Error al iniciar sesión.</h4>
                        Verifique que los datos sean correctos y que su cuenta de correo haya sido confirmada.
                    </div>
                ');
                    return $this->render('login', [
                                'model' => $model,
                    ]);
                }
            } else {
                $model->password = '';
                //Mensaje de error al iniciar sesión
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-error"></i>Error al iniciar sesión.</h4>
                        Verifique que los datos sean correctos y que su cuenta de correo haya sido confirmada.
                    </div>
                ');
                return $this->render('login', [
                            'model' => $model,
                ]);
            }
        } else {
            $model->password = '';
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionColeccionesinvestigador($inv) {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */
        $model = new Coleccion();
        if ($model->load(Yii::$app->request->post())) {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $model->col_titulo])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Resultados de la búsqueda";
        } else {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andWhere(['inv_id' => $inv])
                    ->orderBy('col_titulo ASC')
                    ->all();

            $inv = Investigador::find()->select(['usu_id'])->where(['inv_id' => $inv])->one();
            $nombre = User::find()->select(['use_nombre', 'use_apellido'])->where(['id' => $inv])->one();
            $titulo = 'Colecciones de "' . $nombre->use_nombre . ' ' . $nombre->use_apellido . '"';
        }

        return $this->render('colecciones', [
                    'colecciones' => $colecciones,
                    'titulo' => $titulo,
                    'model' => $model,
                    'model_coleccion' => $model_coleccion,
        ]);
    }

    public function actionColeccionesdisciplina($dis) {
        $model = new Coleccion();

        if ($model->load(Yii::$app->request->post())) {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $model->col_titulo])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Resultados de la búsqueda";
        } else {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andWhere(['dis_id' => $dis])
                    ->orderBy('col_titulo ASC')
                    ->all();

            $titdis = Disciplina::find()->select(['dis_nombre'])->where(['dis_id' => $dis])->one();
            $titulo = 'Colecciones de la disciplina "' . $titdis->dis_nombre . '"';
        }

        return $this->render('colecciones', [
                    'colecciones' => $colecciones,
                    'titulo' => $titulo,
                    'model_coleccion' => $model,
        ]);
    }

    public function actionColeccioneslike($like) {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */
        $model = new Coleccion();

        if ($model->load(Yii::$app->request->post())) {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $model->col_titulo])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Resultados de la búsqueda";
        } else {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $like . '%', false])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = 'Colecciones con "' . $like . '"';
        }

        return $this->render('colecciones', [
                    'colecciones' => $colecciones,
                    'titulo' => $titulo,
                    'model' => $model,
                    'model_coleccion' => $model_coleccion,
        ]);
    }

    public function actionColecciones() {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */
        $model = new Coleccion();
        if ($model->load(Yii::$app->request->post())) {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $model->col_titulo])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Resultados de la búsqueda";
        } else {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Colecciones";
        }

        return $this->render('colecciones', [
                    'colecciones' => $colecciones,
                    'titulo' => $titulo,
                    'model' => $model,
                    'model_coleccion' => $model_coleccion,
        ]);
    }

    public function actionColeccionview($id) {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */



        $buscar = new Coleccion();
        if ($buscar->load(Yii::$app->request->post())) {
            $colecciones = Coleccion::find()
                    ->select(['col_id', 'col_titulo', 'col_descripcion', 'col_portada', 'col_estadoCol'])
                    ->where(['col_estadoCol' => 'A'])
                    ->andFilterWhere(['like', 'col_titulo', $buscar->col_titulo])
                    ->orderBy('col_titulo ASC')
                    ->all();
            $titulo = "Resultados de la búsqueda";

            return $this->render('colecciones', [
                        'colecciones' => $colecciones,
                        'titulo' => $titulo,
                        'model' => $buscar,
                        'model_coleccion' => $model_coleccion,
            ]);
        } else {


            $model = Coleccion::find()->where(['col_id' => $id])->one();

            //$colInv = Investigador::find()->select('inv_id')->where(['col_id'=>$id])->one();

            $idInv = Investigador::find()
                    ->select(['inv_id', 'usu_id', 'inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'])
                    ->where(['inv_id' => $model->inv_id])
                    ->one();

            $investigador = User::find()
                    ->select(['use_nombre', 'use_apellido', 'use_foto'])
                    ->where(['id' => $idInv->usu_id])
                    ->one();


            if (Disciplina::find()->where(['dis_id' => $model->dis_id])->count() != 0) {
                //Se crea un array para el modelo de coleccion-pais
                $disciplina = Disciplina::find()->where(['dis_id' => $model->dis_id])->one();
            } else {
                //Se crea un array para el modelo de coleccion-pais
                $disciplina = 0;
            }

            if (Coleccionpais::find()->where(['col_id' => $id])->count() != 0) {
                //Se crea un array para el modelo de coleccion-pais
                $coleccionpais = Coleccionpais::find()->where(['col_id' => $id])->all();
            } else {
                //Se crea un array para el modelo de coleccion-pais
                $coleccionpais = 0;
            }

            if (Palabraclave::find()->where(['col_id' => $id])->count() != 0) {
                //Se crea un array para el modelo de las palabras clave
                $palabraclave = Palabraclave::find()->where(['col_id' => $id])->all();
            } else {
                //Se crea un array para el modelo de las palabras clave
                $palabraclave = 0;
            }

            if (Coleccionpersona::find()->where(['col_id' => $id])->count() != 0) {
                //Se crea un array para el modelo de las palabras clave
                $coleccionpersona = Coleccionpersona::find()->where(['col_id' => $id])->all();
            } else {
                //Se crea un array para el modelo de las palabras clave
                $coleccionpersona = 0;
            }

            if (Coleccionatributoex::find()->where(['col_id' => $id])->count() != 0) {
                //Se crea un array para el modelo de las palabras clave
                $atrExtra = Coleccionatributoex::find()->where(['col_id' => $id])->all();
            } else {
                //Se crea un array para el modelo de las palabras clave
                $atrExtra = 0;
            }

            $archivo = Archivo::find()->where(['col_id' => $model->col_id])->andWhere(['arc_estadoarc' => 'A'])->all();


            return $this->render('coleccionview', [
                        'model' => $model,
                        'disciplina' => $disciplina,
                        'coleccionpais' => $coleccionpais,
                        'palabraclave' => $palabraclave,
                        'coleccionpersona' => $coleccionpersona,
                        'atrExtra' => $atrExtra,
                        'investigador' => $investigador,
                        'datosInv' => $idInv,
                        'archivo' => $archivo,
                        'buscar' => $buscar,
                        'model_coleccion' => $model_coleccion,
            ]);
        }
    }

    public function actionInvestigadorlike($like) {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */

        $model = new User();
        //SELECT * FROM user, investigador WHERE user.id = investigador.usu_id AND user.rol_id = 2 AND user.use_estado = 2
        if ($model->load(Yii::$app->request->post())) {
            //SELECT * FROM user, investigador WHERE user.id = investigador.usu_id AND user.rol_id = 2 AND user.use_estado = 2


            $user = User::find()->select(['id', 'use_nombre', 'use_apellido', 'use_foto'])
                    ->where(['rol_id' => 2])
                    ->andFilterWhere(['use_estado' => 2])
                    ->andFilterWhere(['like', 'use_nombre', $model->use_nombre])
                    ->orFilterWhere(['like', 'use_apellido', $model->use_nombre])
                    ->orderBy('use_apellido ASC')
                    ->all();



            $investigador = Investigador::find()->select(['inv_id', 'usu_id', 'inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'])->all();
            $titulo = 'Resultados de la búsqueda';

            return $this->render('investigador', [
                        'user' => $user,
                        'investigador' => $investigador,
                        'model' => $model,
                        'titulo' => $titulo,
                        'model_coleccion' => $model_coleccion,
            ]);
        } else {

            $user = User::find()->select(['id', 'use_nombre', 'use_apellido', 'use_foto'])
                    ->where(['rol_id' => 2])
                    ->andFilterWhere(['use_estado' => 2])
                    ->andFilterWhere(['like', 'use_apellido', $like . '%', false])
                    ->orderBy('use_apellido ASC')
                    ->all();

            $investigador = Investigador::find()->select(['inv_id', 'usu_id', 'inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'])->all();
            $titulo = 'Investigador/es con "' . $like . '"';

            return $this->render('investigador', [
                        'user' => $user,
                        'investigador' => $investigador,
                        'model' => $model,
                        'titulo' => $titulo,
                        'model_coleccion' => $model_coleccion,
            ]);
        }
    }

    public function actionInvestigador() {
        /*         * ******** PARA LA BUSQUEDA ******** */
        $model_coleccion = new Coleccion();
        if ($model_coleccion->load(Yii::$app->request->post())) {
            Yii::$app->session->set('parametro_busqueda', $model_coleccion->col_titulo);
            Yii::$app->session->set('parametro_colecciones', 0);
            Yii::$app->session->set('parametro_investigadores', 0);
            Yii::$app->session->set('parametro_disciplinas', 0);
            Yii::$app->session->set('parametro_palabras_claves', 0);
            if ($model_coleccion->col_descripcion == 1) {
                Yii::$app->session->set('parametro_colecciones', $model_coleccion->col_descripcion);
            }
            if ($model_coleccion->col_fuente == 1) {
                Yii::$app->session->set('parametro_investigadores', $model_coleccion->col_fuente);
            }
            if ($model_coleccion->col_estadocol == 1) {
                Yii::$app->session->set('parametro_disciplinas', $model_coleccion->col_estadocol);
            }
            if ($model_coleccion->col_estado == 1) {
                Yii::$app->session->set('parametro_palabras_claves', $model_coleccion->col_estado);
            }
            return $this->redirect(['site/resultado']);
        }
        /*         * ******** FIN PARA LA BUSQUEDA ******** */


        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            //SELECT * FROM user, investigador WHERE user.id = investigador.usu_id AND user.rol_id = 2 AND user.use_estado = 2

            $user = User::find()->select(['id', 'use_nombre', 'use_apellido', 'use_foto', 'email'])
                    ->where(['rol_id' => 2])
                    ->andFilterWhere(['use_estado' => 2])
                    ->andFilterWhere(['like', 'use_nombre', $model->use_nombre])
                    ->orFilterWhere(['like', 'use_apellido', $model->use_nombre])
                    ->orderBy('use_apellido ASC')
                    ->all();

            $investigador = Investigador::find()->select(['inv_id', 'usu_id', 'inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'])->all();
            $titulo = 'Resultados de la búsqueda';

            return $this->render('investigador', [
                        'user' => $user,
                        'investigador' => $investigador,
                        'model' => $model,
                        'titulo' => $titulo,
                        'model_coleccion' => $model_coleccion,
            ]);
        } else {
            //SELECT * FROM user, investigador WHERE user.id = investigador.usu_id AND user.rol_id = 2 AND user.use_estado = 2

            $user = User::find()->select(['id', 'use_nombre', 'use_apellido', 'use_foto', 'email'])
                    ->where(['rol_id' => 2])
                    ->andFilterWhere(['use_estado' => 2])
                    ->orderBy('use_apellido ASC')
                    ->all();

            $investigador = Investigador::find()->select(['inv_id', 'usu_id', 'inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'])->all();
            $titulo = 'Investigadores';

            return $this->render('investigador', [
                        'user' => $user,
                        'investigador' => $investigador,
                        'model' => $model,
                        'titulo' => $titulo,
                        'model_coleccion' => $model_coleccion,
            ]);
        }
    }

    /**
     * Displays Admin page.
     *
     * @return string
     */
    public function actionAdministrar() {
        return $this->render('administrar');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Gracias por contactarnos. Nosotros responderemos a la mayor brevedad posible.');
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un error al enviar su mensaje.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    // Validación por AJAX
    protected function performAjaxValidation($model = NULL) {

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            Yii::$app->end();
        }
    }

    public function actionSignup() {
        $model = new SignupForm();
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post())) {

            $foto = UploadedFile::getInstance($model, 'use_foto');

            if ($foto == '') {
                $model->use_foto = 'usuario_anonimo.jpg';
            } else {

                $modelFoto = User::find()->count();

                $foto->saveAs('../../backend/web/img/user/' . $foto->baseName . '_' . $model->use_nombre . $model->use_apellido . '_' . ($modelFoto + 1) . '.' . $foto->extension);
                $model->use_foto = $foto->baseName . '_' . $model->use_nombre . $model->use_apellido . '_' . ($modelFoto + 1) . '.' . $foto->extension;
            }

            $model->use_estadoAudit = 'N';
            $model->use_fechaCreacion = date('y-m-d H:i:s');
            $model->use_fechaAudit = date('y-m-d H:i:s');
            $model->use_accion = 'N';

            if ($model->signup()) {
                Yii::$app->session->setFlash('success', 'Gracias por registrarse. Se envío un mensaje de verificación a su email.');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su email para obtener más instrucciones.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un error al enviar su mensaje, verifique que su email este ingresado correctamente.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Contraseña guardada.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token) {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Gracias por confirmar tu email.');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'No se pudo verificar su email.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionReenviaremailverificacion() {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su email para obtener más instrucciones.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Hubo un error al enviar su mensaje, verifique que su email este ingresado correctamente.');
        }

        return $this->render('reenviaremailverificacion', [
                    'model' => $model
        ]);
    }

}
