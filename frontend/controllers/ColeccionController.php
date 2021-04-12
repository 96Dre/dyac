<?php

namespace frontend\controllers;

use backend\models\atributoextra\Atributoextra;
use backend\models\disciplina\Disciplina;
use backend\models\pais\Pais;
use frontend\models\coleccionatributoex\Coleccionatributoex;
use frontend\models\coleccionpais\Coleccionpais;
use frontend\models\coleccionpersona\Coleccionpersona;
use frontend\models\user\User;
use frontend\models\investigador\Investigador;
use frontend\models\palabraclave\Palabraclave;
use Yii;
use frontend\models\coleccion\Coleccion;
use frontend\models\archivo\Archivo;
use frontend\models\coleccion\ColeccionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * ColeccionController implements the CRUD actions for Coleccion model.
 */
class ColeccionController extends Controller
{

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

    public function behaviors()
    {
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
                            'cambiar',
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
                            'cambiar',
                        ], // El administrador tiene permisos sobre las siguientes acciones
                        // Este método nos permite crear un filtro sobre la identidad del usuario
                        // y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            return (!Yii::$app->user->isGuest && Yii::$app->user->identity->rol_id == 3); // Usuario normal
                        }
                    ],
                    [
                        'allow' => true, // Esta propiedad establece que tiene permisos
                        'actions' => [
                            'buscarcoleccion',
                            'buscararchivo',
                            'buscarinvestigadores',
                            'guardarparametro'
                        ], // El administrador tiene permisos sobre las siguientes acciones
                        // Este método nos permite crear un filtro sobre la identidad del usuario
                        // y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            return (1 == 1); // Cualquiera
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

    public function actionCambiar($id)
    {
        $model = Coleccion::findOne($id);
        if (!Yii::$app->session->getIsActive()) {
            Yii::$app->session->open();
        }
        Yii::$app->session['c_id'] = $id;
        Yii::$app->session['c_titulo'] = $model->col_titulo;
        Yii::$app->session->close();

        return $this->redirect(['archivo/index']);
        // return $this->render('guardarparametro');
    }

    public function actionGuardarparametro()
    {
        $par = $_POST['parametro'];
        Yii::$app->session->set('parametro_busqueda', $par);
        // return $this->render('guardarparametro');
    }

    public function actionBuscarcoleccion()
    {
        $par = $_POST['parametro'];
        $coleccion = Coleccion::findBySql("SELECT 
                    * FROM coleccion            
                    WHERE col_titulo like '%" . $par . "%' or col_descripcion like '%" . $par . "%'")->all();
        $datos = [];
        $cont = 0;
        foreach ($coleccion as $col) {
            $disciplina = Disciplina::findBySql('select * from disciplina where dis_id = ' . $col['dis_id'])->one();
            $investigador = User::findBySql('select u.* from user as u inner join investigador as i '
                . ' on u.id = i.usu_id where i.inv_id = ' . $col['inv_id'])->one();
            $cont++;
            $datos[$cont]['col_id'] = $col['col_id'];
            $datos[$cont]['col_titulo'] = $col['col_titulo'];
            $datos[$cont]['col_descripcion'] = substr($col['col_descripcion'], 0, 200) . '...';
            $datos[$cont]['col_portada'] = $col['col_portada'];
            $datos[$cont]['disciplina'] = $disciplina['dis_nombre'];
            $datos[$cont]['investigador'] = $investigador['use_apellido'] . ' ' . $investigador['use_nombre'];
            $datos[$cont]['col_fechaPublicacion'] = $col['col_fechaPublicacion'];
        }
        $datos[0][0] = $cont;
        return json_encode($datos);
    }

    public function actionBuscararchivo()
    {
        $par = $_POST['parametro'];
        $archivos = Archivo::findBySql("SELECT 
                    * FROM archivo            
                    WHERE arc_tipo like '%" . $par . "%' or arc_descripcion like '%" . $par . "%' AND arc_estadoarc = 'A'")->all();
        $datos = [];
        $cont = 0;
        foreach ($archivos as $ar) {
            $cont++;
            $datos[$cont]['col_id'] = $ar['col_id'];
            $datos[$cont]['arc_tipo'] = $ar['arc_tipo'];
            $datos[$cont]['arc_descripcion'] = substr($ar['arc_descripcion'], 0, 200) . '...';
        }
        $datos[0][0] = $cont;
        return json_encode($datos);
    }

    public function actionBuscarinvestigadores()
    {
        $par = $_POST['parametro'];
        $investigadores = Investigador::findBySql("SELECT
                        i.`inv_id`,
                        CONCAT(u.`use_apellido`,' ',u.`use_nombre`) AS `inv_web`,
                        i.`inv_tituloProfesional`,
                        i.`inv_descripcion`
                      FROM `investigador` AS i INNER JOIN `user` AS u
                      ON i.`usu_id` = u.`id`            
                    WHERE i.inv_tituloProfesional like '%"
            . $par . "%' or inv_descripcion like '%"
            . $par . "%' or u.use_apellido like '%"
            . $par . "%' or u.use_nombre like '%"
            . $par . "%' AND use_estado = '2'")->all();
        $datos = [];
        $cont = 0;
        foreach ($investigadores as $inv) {
            $cont++;
            $datos[$cont]['inv_id'] = $inv['inv_id'];
            $datos[$cont]['nombres'] = $inv['inv_web'];
            $datos[$cont]['inv_tituloProfesional'] = $inv['inv_tituloProfesional'];
            $datos[$cont]['inv_descripcion'] = substr($inv['inv_descripcion'], 0, 200) . '...';
        }
        $datos[0][0] = $cont;
        return json_encode($datos);
    }

    public function actionIndex()
    {

        if (Investigador::find()->select(['inv_id'])->where(['usu_id' => Yii::$app->user->identity->id])->count() != 0) {
            $searchModel = new ColeccionSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            //Mensaje de confirmación
            Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Complete su información!</h4>
                        Para crear una colección, debe completar su información de investigador.
                    </div>
                ');

            //Redirecciona a la pagina de vista de la colección
            return $this->redirect(['/user']);
        }
    }

    /**
     * Displays a single Coleccion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

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
            //Se crea el query para obtener a los investigadores con sus nombres
            $query = (new \yii\db\Query())
                ->select(['i.inv_id', "CONCAT (u.use_nombre,SPACE(1),u.use_apellido) AS 'nombre'"])
                ->from(['investigador i', 'user u', 'coleccion_persona cp'])
                ->where('i.usu_id = u.id AND i.inv_id = cp.inv_id AND cp.col_id =' . $id)
                ->orderBy('use_nombre ASC');
            //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
            $command = $query->createCommand();
            // Ejecutar el comando  y se lo convierte en array
            // $coleccionpersona  = ArrayHelper::map($rows = $command->queryAll(),'inv_id','nombre');
            $coleccionpersona = $rows = $command->queryAll();

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


        return $this->render('view', [
            'model' => $this->findModel($id),
            'coleccionpais' => $coleccionpais,
            'palabraclave' => $palabraclave,
            'coleccionpersona' => $coleccionpersona,
            'atrExtra' => $atrExtra,
        ]);
    }

    /**
     * Creates a new Coleccion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /* 	EstadoCol:
      •	P: Pendiente Al registrarse una nueva colección/archivo
      •	A: Activo El administrador aceptar la colección/archivo.
      •	N: Negado El administrador negar la colección/archivo
      •	B: Bloqueado El administrador bloquear la colección/archivo
      Estado:
      •	N: Normal Al crear el registro
      •	E: Eliminado Al eliminar el registro */

    public function actionCreate()
    {
        //Obtienen los datos de la DB de disciplina, país, colaboradores
        $disciplina = ArrayHelper::map(Disciplina::find()->orderBy('dis_nombre')->all(), 'dis_id', 'dis_nombre');
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $atributosExtra = ArrayHelper::map(Atributoextra::find()->where(['aex_tipo' => 'Colección'])->orderBy('aex_nombre')->all(), 'aex_id', 'aex_nombre');

        //Se crea el query para obtener a los investigadores con sus nombres
        $query = (new \yii\db\Query())
            ->select(['i.inv_id', "CONCAT (u.use_nombre,SPACE(1),u.use_apellido) AS 'nombre'"])
            ->from(['investigador i', 'user u'])
            ->where('i.usu_id = u.id')
            ->andFilterWhere(['<>', 'u.id', Yii::$app->user->identity->id])
            ->orderBy('use_nombre ASC');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();
        // Ejecutar el comando  y se lo convierte en array
        $colaborador = ArrayHelper::map($rows = $command->queryAll(), 'inv_id', 'nombre');


        //Se crea un nuevo modelo de colección
        $model = new Coleccion();
        //Se crea un array para el modelo de coleccion-pais
        $coleccionpais = [new Coleccionpais()];
        //Se crea un array para el modelo de las palabras clave
        $palabraclave = [new Palabraclave()];
        //Se crea un array para el modelo de las palabras clave
        $coleccionpersona = [new Coleccionpersona()];
        //Se crea un array para el modelo de las palabras clave
        $atrExtra = [new Coleccionatributoex()];


        //Se manda a buscar el perfil del investigador para obtener su ID
        $inv = Investigador::find()->where(['usu_id' => Yii::$app->user->identity->id])->one();

        //Se verifica que existan datos en el formulario
        if ($model->load(Yii::$app->request->post())) {

            //Recogen los valores del widget para la tabla Coleccion-País
            $data = Yii::$app->request->post('Coleccionpais', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataPC = Yii::$app->request->post('Palabraclave', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataCC = Yii::$app->request->post('Coleccionpersona', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataAE = Yii::$app->request->post('Coleccionatributoex', []);

            //Se instancia la foto de portada subida por el investigador
            $foto = UploadedFile::getInstance($model, 'col_portada');

            //Se verifica que exista la foto, sino se le asigna una provisional
            if ($foto == '') {
                //Nombre provisional
                $model->col_portada = 'coleccion_anonimo.jpg';
            } else {
                //Se asigna el nombre a la foto y se sube el archivo al servidor
                $modelFoto = Coleccion::find()->count();
                $foto->saveAs('@backend/web/img/coleccion/' . $foto->baseName . '_' . $model->col_titulo . '_' . ($modelFoto + 1) . '.' . $foto->extension);
                $model->col_portada = $foto->baseName . '_' . $model->col_titulo . '_' . ($modelFoto + 1) . '.' . $foto->extension;
            }

            //Asignacion de valores de auditoria para la colección
            $model->inv_id = $inv->inv_id;
            $model->col_estadoAudit = 'N';
            $model->col_fechaCreacion = date('y-m-d H:i:s');
            $model->col_fechaAudit = date('y-m-d H:i:s');
            $model->col_accion = 'N';

            //Guardan los valores de la coleccion
            if ($model->save()) {

                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&                
                $users = User::find()->where(['rol_id' => 1])->all();
                foreach ($users as $user) {
                    $this->sendEmailCreacion($user, $model->col_titulo, $model->col_estadocol, "");
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

                //Guardan los valores de la relación coleccion-pais
                foreach ($data as $index) {
                    $temp = new Coleccionpais();
                    $temp->pai_id = ArrayHelper::getValue($index, 'pai_id');
                    $temp->cpa_ubicacion = ArrayHelper::getValue($index, 'cpa_ubicacion');
                    $temp->col_id = $model->col_id;
                    $temp->cpa_estado = 'N';
                    $temp->cpa_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cpa_fechaAudit = date('y-m-d H:i:s');
                    $temp->cpa_accion = 'N';
                    if ($temp->pai_id != null) {
                        $temp->save();
                    }
                };

                //Guardan los valores de la relación palabra clave
                foreach ($dataPC as $index) {
                    $temp = new Palabraclave();
                    $temp->pcl_palabraClave = ArrayHelper::getValue($index, 'pcl_palabraClave');
                    $temp->col_id = $model->col_id;
                    $temp->pcl_estado = 'N';
                    $temp->pcl_fechaCreacion = date('y-m-d H:i:s');
                    $temp->pcl_fechaAudit = date('y-m-d H:i:s');
                    $temp->pcl_accion = 'N';
                    if ($temp->pcl_palabraClave != null) {
                        $temp->save();
                    }
                };

                //Guardan los valores de la relación coleccion-persona
                foreach ($dataCC as $index) {
                    $temp = new Coleccionpersona();
                    $temp->inv_id = ArrayHelper::getValue($index, 'inv_id');
                    $temp->col_id = $model->col_id;
                    $temp->cpe_estado = 'N';
                    $temp->cpe_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cpe_fechaAudit = date('y-m-d H:i:s');
                    $temp->cpe_accion = 'N';
                    if ($temp->inv_id != null) {
                        $temp->save();
                    }
                };

                //Guardan los valores de la relación coleccion-atributoextra
                foreach ($dataAE as $index) {
                    $temp = new Coleccionatributoex();
                    $temp->aex_id = ArrayHelper::getValue($index, 'aex_id');
                    $temp->cae_descripcion = ArrayHelper::getValue($index, 'cae_descripcion');
                    $temp->col_id = $model->col_id;
                    $temp->cae_estado = 'N';
                    $temp->cae_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cae_fechaAudit = date('y-m-d H:i:s');
                    $temp->cae_accion = 'N';
                    if ($temp->aex_id != null) {
                        $temp->save();
                    }
                };


                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Coleccion creada!</h4>
                        La coleccion fue agregada correctamente.
                    </div>
                ');

                //Redirecciona a la pagina de vista de la colección
                return $this->redirect(['view', 'id' => $model->col_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'disciplina' => $disciplina,
            'coleccionpais' => $coleccionpais,
            'pais' => $pais,
            'palabraclave' => $palabraclave,
            'colaborador' => $colaborador,
            'coleccionpersona' => $coleccionpersona,
            'atributosExtra' => $atributosExtra,
            'atrExtra' => $atrExtra,
        ]);
    }

    /**
     * Updates an existing Coleccion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        //Obtienen los datos de la DB de disciplina, país, colaboradores
        $disciplina = ArrayHelper::map(Disciplina::find()->orderBy('dis_nombre')->all(), 'dis_id', 'dis_nombre');
        $pais = ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
        $atributosExtra = ArrayHelper::map(Atributoextra::find()->where(['aex_tipo' => 'Colección'])->orderBy('aex_nombre')->all(), 'aex_id', 'aex_nombre');

        //Se busca el modelo de la coleccion a editar
        $model = $this->findModel($id);
        $modelFoto = $this->findModel($id);


        if (Coleccionpais::find()->where(['col_id' => $model->col_id])->count() != 0) {
            //Se crea un array para el modelo de coleccion-pais
            $coleccionpais = Coleccionpais::find()->where(['col_id' => $model->col_id])->all();
            $tempCP = Coleccionpais::find()->where(['col_id' => $model->col_id])->all();
        } else {
            //Se crea un array para el modelo de coleccion-pais
            $coleccionpais = [new Coleccionpais()];
            $tempCP = [new Coleccionpais()];
        }

        if (Palabraclave::find()->where(['col_id' => $model->col_id])->count() != 0) {
            //Se crea un array para el modelo de las palabras clave
            $palabraclave = Palabraclave::find()->where(['col_id' => $model->col_id])->all();
            $tempPC = Palabraclave::find()->where(['col_id' => $model->col_id])->all();
        } else {
            //Se crea un array para el modelo de las palabras clave
            $palabraclave = [new Palabraclave()];
            $tempPC = [new Palabraclave()];
        }

        if (Coleccionpersona::find()->where(['col_id' => $model->col_id])->count() != 0) {
            //Se crea un array para el modelo de las palabras clave
            $coleccionpersona = Coleccionpersona::find()->where(['col_id' => $model->col_id])->all();
            $tempCPer = Coleccionpersona::find()->where(['col_id' => $model->col_id])->all();
        } else {
            //Se crea un array para el modelo de las palabras clave
            $coleccionpersona = [new Coleccionpersona()];
            $tempCPer = [new Coleccionpersona()];
        }

        if (Coleccionatributoex::find()->where(['col_id' => $model->col_id])->count() != 0) {
            //Se crea un array para el modelo de las palabras clave
            $atrExtra = Coleccionatributoex::find()->where(['col_id' => $model->col_id])->all();
            $tempAE = Coleccionatributoex::find()->where(['col_id' => $model->col_id])->all();
        } else {
            //Se crea un array para el modelo de las palabras clave
            $atrExtra = [new Coleccionatributoex()];
            $tempAE = [new Coleccionatributoex()];
        }

        //Se crea el query para obtener a los investigadores con sus nombres
        $query = (new \yii\db\Query())
            ->select(['i.inv_id', "CONCAT (u.use_nombre,SPACE(1),u.use_apellido) AS 'nombre'"])
            ->from(['investigador i', 'user u'])
            ->where('i.usu_id = u.id')
            ->orderBy('use_nombre ASC');
        //  Crear un comando. Se puede obtener la consulta SQL actual utilizando $command->sql
        $command = $query->createCommand();
        // Ejecutar el comando  y se lo convierte en array
        $colaborador = ArrayHelper::map($rows = $command->queryAll(), 'inv_id', 'nombre');

        //Se manda a buscar el perfil del investigador para obtener su ID
        //$inv = Investigador::find()->where(['usu_id'=>Yii::$app->user->identity->id])->one();
        //Se verifica que existan datos en el formulario
        if ($model->load(Yii::$app->request->post())) {

            //Recogen los valores del widget para la tabla Coleccion-País
            $data = Yii::$app->request->post('Coleccionpais', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataPC = Yii::$app->request->post('Palabraclave', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataCC = Yii::$app->request->post('Coleccionpersona', []);

            //Recogen los valores del widget para la tabla Palabra clave
            $dataAE = Yii::$app->request->post('Coleccionatributoex', []);

            //Se instancia la foto de portada subida por el investigador
            $foto = UploadedFile::getInstance($model, 'col_portada');

            //Se verifica que exista la foto, sino se le asigna una provisional
            if ($foto == '') {
                //Nombre provisional
                $model->col_portada = $modelFoto->col_portada;
            } else {
                //Elimina la foto anterior
                if ($modelFoto->col_portada != 'coleccion_anonimo.jpg') {
                    unlink('../../backend/web/img/coleccion/' . $modelFoto->col_portada);
                }

                //Se asigna el nombre a la foto y se sube el archivo al servidor
                $modelFoto = Coleccion::find()->count();
                //$foto->saveAs(Url::base() . '/img/coleccion/' . $foto->baseName . '_' . $model->col_titulo . '_' . ($modelFoto + 1) . '.' . $foto->extension);
                $foto->saveAs('@backend/web/img/coleccion/' . $foto->baseName . '_' . $model->col_titulo . '_' . ($modelFoto + 1) . '.' . $foto->extension);
                $model->col_portada = $foto->baseName . '_' . $model->col_titulo . '_' . ($modelFoto + 1) . '.' . $foto->extension;
            }

            //Asignacion de valores de auditoria para la colección
            $model->col_fechaAudit = date('y-m-d H:i:s');
            $model->col_accion = 'M';

            //Guardan los valores de la coleccion
            if ($model->save()) {
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%%%%% *** ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&                
                $users = User::find()->where(['rol_id' => 1])->all();
                foreach ($users as $user) {
                    $this->sendEmailCreacion($user, $model->col_titulo, $model->col_estadocol, "");
                }
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                // %%%%%%%%%%%%%%% *** FIN DE ENVÍO DE EMAIL *** %%%%%%%%%%%%%%%
                // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

                //Eliminado de registro antiguos
                foreach ($tempCP as $index) {
                    if ($index->col_id != null) {
                        $tempX = new Coleccionpais();
                        $tempX->find()->where(['col_id' => $index->col_id])->one()->delete();
                    }
                }


                //Guardan los valores de la relación coleccion-pais
                foreach ($data as $index) {
                    $temp = new Coleccionpais();
                    $temp->pai_id = ArrayHelper::getValue($index, 'pai_id');
                    $temp->cpa_ubicacion = ArrayHelper::getValue($index, 'cpa_ubicacion');
                    $temp->col_id = $model->col_id;
                    $temp->cpa_estado = 'N';
                    $temp->cpa_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cpa_fechaAudit = date('y-m-d H:i:s');
                    $temp->cpa_accion = 'N';
                    if ($temp->pai_id != null) {
                        $temp->save();
                    }
                };

                //Eliminado de registro antiguos
                foreach ($tempPC as $index) {
                    if ($index->col_id != null) {
                        $tempX = new Palabraclave();
                        $tempX->find()->where(['col_id' => $index->col_id])->one()->delete();
                    }
                }

                //Guardan los valores de la relación coleccion-pais
                foreach ($dataPC as $index) {
                    $temp = new Palabraclave();
                    $temp->pcl_palabraClave = ArrayHelper::getValue($index, 'pcl_palabraClave');
                    $temp->col_id = $model->col_id;
                    $temp->pcl_estado = 'N';
                    $temp->pcl_fechaCreacion = date('y-m-d H:i:s');
                    $temp->pcl_fechaAudit = date('y-m-d H:i:s');
                    $temp->pcl_accion = 'N';
                    if ($temp->pcl_palabraClave != null) {
                        $temp->save();
                    }
                };


                //Eliminado de registro antiguos
                foreach ($tempCPer as $index) {
                    if ($index->col_id != null) {
                        $tempX = new Coleccionpersona();
                        $tempX->find()->where(['col_id' => $index->col_id])->one()->delete();
                    }
                }

                //Guardan los valores de la relación coleccion-pais
                foreach ($dataCC as $index) {
                    $temp = new Coleccionpersona();
                    $temp->inv_id = ArrayHelper::getValue($index, 'inv_id');
                    $temp->col_id = $model->col_id;
                    $temp->cpe_estado = 'N';
                    $temp->cpe_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cpe_fechaAudit = date('y-m-d H:i:s');
                    $temp->cpe_accion = 'N';
                    if ($temp->inv_id != null) {
                        $temp->save();
                    }
                };


                //Eliminado de registro antiguos
                foreach ($tempAE as $index) {
                    if ($index->col_id != null) {
                        $tempX = new Coleccionatributoex();
                        $tempX->find()->where(['col_id' => $index->col_id])->one()->delete();
                    }
                }

                //Guardan los valores de la relación coleccion-atributoextra
                foreach ($dataAE as $index) {
                    $temp = new Coleccionatributoex();
                    $temp->aex_id = ArrayHelper::getValue($index, 'aex_id');
                    $temp->cae_descripcion = ArrayHelper::getValue($index, 'cae_descripcion');
                    $temp->col_id = $model->col_id;
                    $temp->cae_estado = 'N';
                    $temp->cae_fechaCreacion = date('y-m-d H:i:s');
                    $temp->cae_fechaAudit = date('y-m-d H:i:s');
                    $temp->cae_accion = 'N';
                    if ($temp->aex_id != null) {
                        $temp->save();
                    }
                };


                //Mensaje de confirmación
                Yii::$app->session->setFlash('msg', '
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check"></i>Coleccion modificada!</h4>
                        La coleccion fue modificada correctamente.
                    </div>
                ');

                //Redirecciona a la pagina de vista de la colección
                return $this->redirect(['view', 'id' => $model->col_id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'disciplina' => $disciplina,
            'coleccionpais' => $coleccionpais,
            'pais' => $pais,
            'palabraclave' => $palabraclave,
            'colaborador' => $colaborador,
            'coleccionpersona' => $coleccionpersona,
            'atributosExtra' => $atributosExtra,
            'atrExtra' => $atrExtra,
        ]);
    }

    /**
     * Deletes an existing Coleccion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if (Coleccionpais::find()->where(['col_id' => $id])->count() != 0) {
            foreach (Coleccionpais::find()->where(['col_id' => $id])->all() as $item) {
                $temp = new Coleccionpais;
                $temp->find()->where(['col_id' => $item->col_id])->one()->delete();
            }
        }

        if (Palabraclave::find()->where(['col_id' => $id])->count() != 0) {
            foreach (Palabraclave::find()->where(['col_id' => $id])->all() as $item) {
                $temp = new Palabraclave;
                $temp->find()->where(['col_id' => $item->col_id])->one()->delete();
            }
        }

        if (Coleccionpersona::find()->where(['col_id' => $id])->count() != 0) {
            foreach (Coleccionpersona::find()->where(['col_id' => $id])->all() as $item) {
                $temp = new Coleccionpersona;
                $temp->find()->where(['col_id' => $item->col_id])->one()->delete();
            }
        }

        if (Coleccionatributoex::find()->where(['col_id' => $id])->count() != 0) {
            foreach (Coleccionatributoex::find()->where(['col_id' => $id])->all() as $item) {
                $temp = new Coleccionatributoex;
                $temp->find()->where(['col_id' => $item->col_id])->one()->delete();
            }
        }

        $modelFoto = $this->findModel($id);
        if ($modelFoto->col_portada != 'coleccion_anonimo.jpg') {
            unlink('../../backend/web/img/coleccion/' . $modelFoto->col_portada);
        }

        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('msg', '
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-check"></i>Colección eliminada!</h4>
                    La colección se eliminó correctamente.
                </div>
            ');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Coleccion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coleccion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Coleccion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function sendEmailCreacion($user, $nombCole, $estadoCol, $observacion)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'coleccionCreado-html', 'text' => 'coleccionCreado-text'],
                [
                    'user' => $user,
                    'titulo' => $nombCole,
                    'estado' => $estadoCol,
                    'observacion' => $observacion,
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' - DYAC'])
            ->setTo($user->email)
            ->setSubject('Solicitud de aprobación para colección')
            ->send();
    }

}
