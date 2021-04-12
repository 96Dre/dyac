<?php

namespace frontend\models\coleccionpais;

use Yii;
use backend\models\pais\Pais;
use frontend\models\coleccion\Coleccion;

/**
 * This is the model class for table "coleccion_pais".
 *
 * @property int|null $pai_id
 * @property int|null $col_id
 * @property int $cpa_id
 * @property string $cpa_ubicacion
 * @property string $cpa_estado
 * @property string $cpa_fechaCreacion
 * @property string $cpa_fechaAudit
 * @property string $cpa_accion
 *
 * @property Pais $pai
 * @property Coleccion $col
 */
class Coleccionpais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    public static function tableName()
    {
        return 'coleccion_pais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pai_id', 'col_id'], 'integer'],
            [['cpa_estado', 'cpa_fechaCreacion', 'cpa_fechaAudit', 'cpa_accion'], 'required'],
            [['cpa_fechaCreacion', 'cpa_fechaAudit'], 'safe'],
            [['cpa_ubicacion'], 'string', 'max' => 500],
            [['cpa_estado', 'cpa_accion'], 'string', 'max' => 1],
            [['pai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id' => 'pai_id']],
            [['col_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coleccion::className(), 'targetAttribute' => ['col_id' => 'col_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pai_id' => Yii::t('app', 'Pai ID'),
            'col_id' => Yii::t('app', 'Col ID'),
            'cpa_id' => Yii::t('app', 'Cpa ID'),
            'cpa_ubicacion' => Yii::t('app', 'Cpa Ubicacion'),
            'cpa_estado' => Yii::t('app', 'Cpa Estado'),
            'cpa_fechaCreacion' => Yii::t('app', 'Cpa Fecha Creacion'),
            'cpa_fechaAudit' => Yii::t('app', 'Cpa Fecha Audit'),
            'cpa_accion' => Yii::t('app', 'Cpa Accion'),
        ];
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

    /**
     * Gets query for [[Col]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCol()
    {
        return $this->hasOne(Coleccion::className(), ['col_id' => 'col_id']);
    }
}
