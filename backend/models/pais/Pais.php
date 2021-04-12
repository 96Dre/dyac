<?php

namespace backend\models\pais;

use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property int $pai_id
 * @property string $pai_nombre
 * @property string $pai_estado
 * @property string $pai_fechaCreacion
 * @property string $pai_fechaAudit
 * @property string $pai_accion
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pai_nombre'], 'required'],
            [['pai_nombre'], 'string', 'max' => 50],
            [['pai_estado','pai_accion'], 'string', 'max' => 1],
            [['pai_fechaCreacion','pai_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pai_id' => Yii::t('app', 'Pai ID'),
            'pai_nombre' => Yii::t('app', 'Pai Nombre'),
        ];
    }
}
