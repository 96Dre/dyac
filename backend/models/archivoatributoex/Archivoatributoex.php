<?php

namespace backend\models\archivoatributoex;

use Yii;
use backend\models\atributoextra\Atributoextra;
use backend\models\tipoarchivo\Tipoarchivo;

/**
 * This is the model class for table "archivo_atributoex".
 *
 * @property int $aae_id
 * @property int|null $aex_id
 * @property int|null $tar_id
 *
 * @property AtributoExtra $aex
 * @property TipoArchivo $tar
 *
 * @property string $aae_estado
 * @property string $aae_fechaCreacion
 * @property string $aae_fechaAudit
 * @property string $aae_accion
 */
class Archivoatributoex extends \yii\db\ActiveRecord
{

    public $aex_nombre;
    public $aex_descripcion;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivo_atributoex';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aex_id', 'tar_id'], 'integer'],
            [['aex_id'], 'exist', 'skipOnError' => true, 'targetClass' => AtributoExtra::className(), 'targetAttribute' => ['aex_id' => 'aex_id']],
            [['tar_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoArchivo::className(), 'targetAttribute' => ['tar_id' => 'tar_id']],
            [['aae_estado','aae_accion'], 'string', 'max' => 1],
            [['aae_fechaCreacion','aae_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aae_id' => Yii::t('app', 'Aae ID'),
            'aex_id' => Yii::t('app', 'Aex ID'),
            'tar_id' => Yii::t('app', 'Tar ID'),
        ];
    }

    /**
     * Gets query for [[Aex]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAex()
    {
        return $this->hasOne(AtributoExtra::className(), ['aex_id' => 'aex_id']);
    }

    /**
     * Gets query for [[Tar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTar()
    {
        return $this->hasOne(TipoArchivo::className(), ['tar_id' => 'tar_id']);
    }
}
