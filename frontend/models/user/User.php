<?php

namespace frontend\models\user;

use backend\models\pais\Pais;
use backend\models\rol\Rol;
use backend\models\usergenero\Usergenero;
use Yii;
use common\models\User as UserCommon;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $use_nombre
 * @property string $use_apellido
 * @property int $uge_id
 * @property string $use_telefono
 * @property int $pai_id
 * @property int $rol_id
 * @property string $use_foto
 * @property string $use_estado
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property string $use_estadoAudit
 * @property string $use_fechaCreacion
 * @property string $use_fechaAudit
 * @property string $use_accion
 *
 * @property Investigador[] $investigadors
 */
class User extends UserCommon
{
    public $password;
    public $repeat_password;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['use_nombre', 'use_apellido', 'uge_id', 'rol_id', 'pai_id', 'use_estado', 'email'], 'required'],
            [['pai_id', 'status', 'created_at', 'uge_id','rol_id', 'updated_at','use_telefono'], 'integer'],
            [['use_nombre', 'use_apellido'], 'string', 'max' => 50],
            [['use_telefono'], 'string', 'max' => 20],
            [['use_foto'], 'file', 'extensions' => 'jpeg,jpg,png'],
            //[['use_estado'], 'string', 'max' => 2],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],

            // ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            //['repeat_password', 'required'],
            ['repeat_password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden.'],

            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            [['use_estadoAudit','use_accion'], 'string', 'max' => 1],
            [['use_fechaCreacion','use_accion','use_estado' ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'use_nombre' => Yii::t('app', 'Use Nombre'),
            'use_apellido' => Yii::t('app', 'Use Apellido'),
            'uge_id' => Yii::t('app', 'Uge ID'),
            'use_telefono' => Yii::t('app', 'Use Telefono'),
            'pai_id' => Yii::t('app', 'Pai ID'),
            'rol_id' => Yii::t('app', 'Rol ID'),
            'use_foto' => Yii::t('app', 'Use Foto'),
            'use_estado' => Yii::t('app', 'Use Estado'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'password' => Yii::t('app', 'Password'),
            'repeat_password' => Yii::t('app', 'Repeat Password'),
        ];
    }

    /**
     * Gets query for [[Investigadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvestigadors()
    {
        return $this->hasMany(Investigador::className(), ['usu_id' => 'id']);
    }

    public function signup() {

        $bandera = false;

        if (!$this->validate()) {
            return null;
        }
        if($this->id != null){
            if($this->password != null && $this->password != '' ){
                $this->setPassword($this->password);
            }
        }else{
            $this->setPassword($this->password);
        }
        if($this->auth_key == null){
            $this->generateAuthKey();
        }

        if($this->verification_token == null){
            $this->generateEmailVerificationToken();
            $this->status = self::STATUS_INACTIVE;
            $bandera = true;
        }

        if(!$this->save()){
            $this->addErrors($this->getErrors());
            return false;
        }

    }
    /**
     * Gets query for [[Pai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPai()
    {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id']);
    }

    public function getUge()
    {
        return $this->hasOne(Usergenero::className(), ['uge_id' => 'uge_id']);
    }

    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['rol_id' => 'rol_id']);
    }
}
