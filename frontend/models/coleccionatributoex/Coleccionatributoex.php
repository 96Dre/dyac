<?php

namespace frontend\models\coleccionatributoex;

use Yii;
use frontend\models\coleccion\Coleccion;
use backend\models\atributoextra\Atributoextra;

/**
 * This is the model class for table "coleccion_atributoex".
 *
 * @property int $cae_id
 * @property int|null $aex_id
 * @property string $cae_descripcion
 * @property int|null $col_id
 * @property string $cae_estado
 * @property string $cae_fechaCreacion
 * @property string $cae_fechaAudit
 * @property string $cae_accion
 *
 * @property Coleccion $col
 * @property AtributoExtra $aex
 */
class Coleccionatributoex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coleccion_atributoex';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aex_id', 'col_id'], 'integer'],
            [['cae_descripcion', 'cae_estado', 'cae_fechaCreacion', 'cae_fechaAudit', 'cae_accion'], 'required'],
            [['cae_fechaCreacion', 'cae_fechaAudit'], 'safe'],
            [['cae_descripcion'], 'string', 'max' => 1000],
            [['cae_estado', 'cae_accion'], 'string', 'max' => 1],
            [['col_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coleccion::className(), 'targetAttribute' => ['col_id' => 'col_id']],
            [['aex_id'], 'exist', 'skipOnError' => true, 'targetClass' => AtributoExtra::className(), 'targetAttribute' => ['aex_id' => 'aex_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cae_id' => Yii::t('app', 'Cae ID'),
            'aex_id' => Yii::t('app', 'Aex ID'),
            'cae_descripcion' => Yii::t('app', 'Cae Descripcion'),
            'col_id' => Yii::t('app', 'Col ID'),
            'cae_estado' => Yii::t('app', 'Cae Estado'),
            'cae_fechaCreacion' => Yii::t('app', 'Cae Fecha Creacion'),
            'cae_fechaAudit' => Yii::t('app', 'Cae Fecha Audit'),
            'cae_accion' => Yii::t('app', 'Cae Accion'),
        ];
    }

    /**
     * Gets query for [[Col]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCol()
    {
        return $this->hasOne(Coleccion::className(), ['col_id' => 'col_id']);
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
}
