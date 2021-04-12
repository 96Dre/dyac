<?php

namespace backend\models\genero;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $gen_id
 * @property string $gen_nombre
 * @property string $gen_estado
 * @property string $gen_fechaCreacion
 * @property string $gen_fechaAudit
 * @property string $gen_accion
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gen_nombre'], 'required'],
            [['gen_nombre'], 'string', 'max' => 30],
            [['gen_estado','gen_accion'], 'string', 'max' => 1],
            [['gen_fechaCreacion','gen_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gen_id' => Yii::t('app', 'Gen ID'),
            'gen_nombre' => Yii::t('app', 'Gen Nombre'),
        ];
    }
}
