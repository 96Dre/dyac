<?php

namespace frontend\models\coleccionpersona;


use frontend\models\user\User;
use Yii;
use frontend\models\investigador\Investigador;
use frontend\models\coleccion\Coleccion;

/**
 * This is the model class for table "coleccion_persona".
 *
 * @property int $cpe_id
 * @property int|null $inv_id
 * @property int|null $col_id
 * @property string $cpe_estado
 * @property string $cpe_fechaCreacion
 * @property string $cpe_fechaAudit
 * @property string $cpe_accion
 *
 * @property Coleccion $col
 * @property Investigador $inv
 */
class Coleccionpersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coleccion_persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_id', 'col_id'], 'integer'],
            [['cpe_estado', 'cpe_fechaCreacion', 'cpe_fechaAudit', 'cpe_accion'], 'required'],
            [['cpe_fechaCreacion', 'cpe_fechaAudit'], 'safe'],
            [['cpe_estado', 'cpe_accion'], 'string', 'max' => 1],
            [['col_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coleccion::className(), 'targetAttribute' => ['col_id' => 'col_id']],
            [['inv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Investigador::className(), 'targetAttribute' => ['inv_id' => 'inv_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cpe_id' => Yii::t('app', 'Cpe ID'),
            'inv_id' => Yii::t('app', 'Inv ID'),
            'col_id' => Yii::t('app', 'Col ID'),
            'cpe_estado' => Yii::t('app', 'Cpe Estado'),
            'cpe_fechaCreacion' => Yii::t('app', 'Cpe Fecha Creacion'),
            'cpe_fechaAudit' => Yii::t('app', 'Cpe Fecha Audit'),
            'cpe_accion' => Yii::t('app', 'Cpe Accion'),
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
     * Gets query for [[Inv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInv()
    {
        return $this->hasOne(Investigador::className(), ['inv_id' => 'inv_id']);
    }

}
