<?php

namespace frontend\models\palabraclave;

use Yii;
use frontend\models\coleccion\Coleccion;

/**
 * This is the model class for table "palabra_clave".
 *
 * @property int $pcl_id
 * @property string $pcl_palabraClave
 * @property int|null $col_id
 * @property string $pcl_estado
 * @property string $pcl_fechaCreacion
 * @property string $pcl_fechaAudit
 * @property string $pcl_accion
 *
 * @property Coleccion $col
 */
class Palabraclave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'palabra_clave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pcl_palabraClave', 'pcl_estado', 'pcl_fechaCreacion', 'pcl_fechaAudit', 'pcl_accion'], 'required'],
            [['col_id'], 'integer'],
            [['pcl_fechaCreacion', 'pcl_fechaAudit'], 'safe'],
            [['pcl_palabraClave'], 'string', 'max' => 100],
            [['pcl_estado', 'pcl_accion'], 'string', 'max' => 1],
            [['col_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coleccion::className(), 'targetAttribute' => ['col_id' => 'col_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pcl_id' => Yii::t('app', 'Pcl ID'),
            'pcl_palabraClave' => Yii::t('app', 'Pcl Palabra Clave'),
            'col_id' => Yii::t('app', 'Col ID'),
            'pcl_estado' => Yii::t('app', 'Pcl Estado'),
            'pcl_fechaCreacion' => Yii::t('app', 'Pcl Fecha Creacion'),
            'pcl_fechaAudit' => Yii::t('app', 'Pcl Fecha Audit'),
            'pcl_accion' => Yii::t('app', 'Pcl Accion'),
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
}
