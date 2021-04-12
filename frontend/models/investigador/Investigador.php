<?php

namespace frontend\models\investigador;

use Yii;
use frontend\models\user\User;

/**
 * This is the model class for table "investigador".
 *
 * @property int $inv_id
 * @property int|null $usu_id
 * @property string $inv_tituloProfesional
 * @property string $inv_descripcion
 * @property string $inv_twitter
 * @property string $inv_facebook
 * @property string $inv_instagram
 * @property string $inv_web
 *
 *
 * @property string $inv_estado
 * @property string $inv_fechaCreacion
 * @property string $inv_fechaAudit
 * @property string $inv_accion
 *
 * @property User $usu
 */
class Investigador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investigador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_id'], 'integer'],
            [['inv_tituloProfesional', 'inv_descripcion',], 'required'],
            [['inv_tituloProfesional', 'inv_descripcion'], 'string', 'max' => 400],
            [['inv_twitter', 'inv_facebook', 'inv_instagram'], 'string', 'max' => 250],
            [['inv_web'], 'string', 'max' => 500],
            [['usu_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usu_id' => 'id']],
            [['inv_estado','inv_accion'], 'string', 'max' => 1],
            [['inv_fechaCreacion','inv_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inv_id' => Yii::t('app', 'Inv ID'),
            'usu_id' => Yii::t('app', 'Usu ID'),
            'inv_tituloProfesional' => Yii::t('app', 'Inv Titulo Profesional'),
            'inv_descripcion' => Yii::t('app', 'Inv Descripcion'),
            'inv_twitter' => Yii::t('app', 'Inv Twitter'),
            'inv_facebook' => Yii::t('app', 'Inv Facebook'),
            'inv_instagram' => Yii::t('app', 'Inv Instagram'),
            'inv_web' => Yii::t('app', 'Inv Web'),
        ];
    }

    /**
     * Gets query for [[Usu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsu()
    {
        return $this->hasOne(User::className(), ['id' => 'usu_id']);
    }
}
