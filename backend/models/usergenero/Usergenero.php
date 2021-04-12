<?php

namespace backend\models\usergenero;

use Yii;

/**
 * This is the model class for table "user_genero".
 *
 * @property int $uge_id
 * @property string $uge_nombre
 * @property string $uge_estado
 * @property string $uge_fechaCreacion
 * @property string $uge_fechaAudit
 * @property string $uge_accion
 */
class Usergenero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uge_nombre'], 'required'],
            [['uge_nombre'], 'string', 'max' => 100],
            [['uge_estado','uge_accion'], 'string', 'max' => 1],
            [['uge_fechaCreacion','uge_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uge_id' => Yii::t('app', 'Uge ID'),
            'uge_nombre' => Yii::t('app', 'Uge Nombre'),
        ];
    }
}
