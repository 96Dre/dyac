<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;


/**
 * Signup form
 */
class SignupForm extends Model
{
   // public $username;

    public $use_nombre;
    public $use_apellido;
    public $uge_id;
    public $use_telefono;
    public $pai_id;
    public $use_foto;
    public $email;
    public $repeat_email;
    public $password;
    public $repeat_password;
    public $use_estado;
    public $rol_id;
    public $use_estadoAudit;
    public $use_fechaCreacion;
    public $use_fechaAudit;
    public $use_accion;






    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // ['username', 'trim'],
          //  ['username', 'required'],
          //  ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
         //   ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['repeat_password', 'required'],
            ['repeat_password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            [['use_nombre', 'use_apellido', 'uge_id', 'pai_id', 'rol_id', 'use_estado'], 'required'],
            [['use_nombre','use_apellido'], 'string', 'max' => 50],
            [['use_telefono'], 'string', 'max' => 20],
            [['use_estado'], 'string', 'max' => 2],
            [['pai_id','uge_id','rol_id'], 'integer'],

            [['use_foto'], 'file', 'extensions' => ['jpeg','jpg','png','gif'],  'maxSize' => 1024*1024*10],

            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden.'],
            
            ['email', 'required'],
            ['email', 'email'],
            ['repeat_email', 'compare', 'compareAttribute' => 'email', 'message' => 'Email no coinciden.'],

            [['use_estadoAudit','use_accion'], 'string', 'max' => 1],
            [['use_fechaCreacion','use_accion'], 'safe'],
            
            [['use_nombre','use_apellido'], 
                'match',                 
                'pattern'=>'/^[a-zA-Z\s]+$/',
                'message' => 'Debe ingresar solo texto'],
            
//            [['use_telefono'], 
//                'match',                 
//                'pattern'=>"^[0-9]{2,3}-? ?[0-9]{6,7}$",
//                'message' => 'Solo número telefónico'],

        ];
    }

    
     public function attributeLabels()
    {
        return [
            'use_nombre' => 'Nombres',
             'use_apellido' => 'Apellidos',
             'uge_id' => 'Género',
             'pai_id' => 'País',
            'use_telefono' => 'Teléfono',
            'use_foto' => 'Foto',
            'email' => 'Email',
            'password' => 'Contraseña',
            'repeat_password' => 'Repetir Contraseña',
            'repeat_email' => 'Repetir email',
            'rol_id' => 'Tipo de cuenta',            
        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();

        $user->use_nombre = $this->use_nombre;
        $user->use_apellido = $this->use_apellido;
        $user->uge_id = $this->uge_id;
        $user->use_telefono = $this->use_telefono;
        $user->pai_id = $this->pai_id;
        $user->use_foto = $this->use_foto;
        $user->use_estado = $this->use_estado;
        $user->rol_id = $this->rol_id;
        $user->pai_id = $this->pai_id;
        $user->use_foto = $this->use_foto;
        $user->use_estado = $this->use_estado;
        $user->rol_id = $this->rol_id;

        $user->use_estadoAudit = $this->use_estadoAudit;
        $user->use_fechaCreacion = $this->use_fechaCreacion;
        $user->use_fechaAudit = $this->use_fechaAudit;
        $user->use_accion = $this->use_accion;


        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' - DYAC'])
                // ->setReplyTo($replyTo)
            ->setTo($this->email)
            ->setSubject('Verificación de email')
            ->send();

    }
}
