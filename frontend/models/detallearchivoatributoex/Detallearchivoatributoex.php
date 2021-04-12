<?php

namespace frontend\models\detallearchivoatributoex;

use backend\models\atributoextra\Atributoextra;
use frontend\models\archivo\Archivo;
use backend\models\archivoatributoex\Archivoatributoex;
use Yii;

/**
 * This is the model class for table "detallearchivo_atributoex".
 *
 * @property int $dae_id
 * @property string $dae_descripcion
 * @property int|null $arc_id
 * @property int|null $aae_id
 * @property int|null $aex_id
 * @property string $dae_estado
 * @property string $dae_fechaCreacion
 * @property string $dae_fechaAudit
 * @property string $dae_accion

 * @property Atributoextra $aex
 * @property Archivo $arc
 * @property ArchivoAtributoex $aae
 *
 */
class Detallearchivoatributoex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detallearchivo_atributoex';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dae_descripcion'], 'required'],

            [['arc_id', 'aae_id','aex_id'], 'integer'],
            [['dae_descripcion'], 'string', 'max' => 1000],
            [['aex_id'], 'exist', 'skipOnError' => true, 'targetClass' => Atributoextra::className(), 'targetAttribute' => ['aex_id' => 'aex_id']],
            [['arc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archivo::className(), 'targetAttribute' => ['arc_id' => 'arc_id']],
            [['aae_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArchivoAtributoex::className(), 'targetAttribute' => ['aae_id' => 'aae_id']],

            [['dae_estado','dae_accion'], 'string', 'max' => 1],
            [['dae_fechaCreacion','dae_accion','aex_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dae_id' => Yii::t('app', 'Dae ID'),
            'dae_descripcion' => Yii::t('app', 'Dae Descripcion'),
            'arc_id' => Yii::t('app', 'Arc ID'),
            'aae_id' => Yii::t('app', 'Aae ID'),
            'aex_id' => Yii::t('app', 'Aex ID'),

        ];
    }

    /**
     * Gets query for [[Arc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArc()
    {
        return $this->hasOne(Archivo::className(), ['arc_id' => 'arc_id']);
    }

    /**
     * Gets query for [[Aae]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAae()
    {
        return $this->hasOne(ArchivoAtributoex::className(), ['aae_id' => 'aae_id']);
    }
    /**
     * Gets query for [[Aex]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAex()
    {
        return $this->hasOne(Atributoextra::className(), ['aex_id' => 'aex_id']);
    }
}
