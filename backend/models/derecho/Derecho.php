<?php

namespace backend\models\derecho;

use Yii;

/**
 * This is the model class for table "derecho".
 *
 * @property int $der_id
 * @property string $der_nombre
 * @property string $der_estado
 * @property string $der_fechaCreacion
 * @property string $der_fechaAudit
 * @property string $der_accion
 */
class Derecho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'derecho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['der_nombre'], 'required'],
            [['der_nombre'], 'string', 'max' => 50],
            [['der_estado','der_accion'], 'string', 'max' => 1],
            [['der_fechaCreacion','der_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'der_id' => Yii::t('app', 'Der ID'),
            'der_nombre' => Yii::t('app', 'Der Nombre'),
        ];
    }
}
