<?php

namespace backend\models\rol;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $rol_id
 * @property string $rol_nombre
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol_nombre'], 'required'],
            [['rol_nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rol_id' => Yii::t('app', 'Rol ID'),
            'rol_nombre' => Yii::t('app', 'Rol Nombre'),
        ];
    }
}
