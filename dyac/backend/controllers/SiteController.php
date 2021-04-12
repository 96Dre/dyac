<?php
namespace backend\controllers;

use backend\models\archivo\Archivo;
use backend\models\coleccion\Coleccion;
use backend\models\user\User;
use backend\models\menu\Menu;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
    public function actions()
    {
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
     * @return string
     */
    public function actionIndex()
    {
        $menu = Menu::find()->where(['men_activo' => 1])->andFilterWhere(['men_idPadre'=>0])->orderBy(['men_id' => SORT_DESC])->all();
        $submenu = Menu::find()->where(['men_activo' => 1])->andFilterWhere(['>','men_idPadre',0])->orderBy(['men_posicion' => SORT_ASC, 'men_id' => SORT_DESC])->all();
       /* $menu = Menu::find()->where(['men_activo' => 1])->orderBy([
            'men_idPadre' => SORT_DESC,
            'men_posicion'=>SORT_DESC,

        ])->all();*/

        //$menu = Menu::find()->where(['men_activo' => 1])->all();


        $solicitudes = User::find()->where(['rol_id' => 2])->andFilterWhere(['use_estado' => 1])->count();
        $solicitudesCol = Coleccion::find()->where(['col_estadoCol' => 'P'])->count();
        $solicitudesArc = Archivo::find()->where(['arc_estadoarc' => 'P'])->count();


        return $this->render('index', ['solicitudes'=>$solicitudes,'menu'=>$menu,'submenu'=>$submenu,'solicitudesCol'=>$solicitudesCol,'solicitudesArc'=>$solicitudesArc]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

       // $this->layout = 'blank';

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {

            $user = User::find()->where(['email'=>$model->email])->andFilterWhere(['rol_id'=>1])->count();

            if($user == 1)
            {
                if($model->login()){
                    return $this->goBack();
                }
            }else{
                $model->password = '';

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

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
