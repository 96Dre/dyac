<?php

namespace backend\models\disciplina;

use Yii;

/**
 * This is the model class for table "disciplina".
 *
 * @property int $dis_id
 * @property string $dis_nombre
 * @property string $dis_estado
 * @property string $dis_fechaCreacion
 * @property string $dis_fechaAudit
 * @property string $dis_accion
 */
class Disciplina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disciplina';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dis_nombre'], 'required'],
            [['dis_nombre'], 'string', 'max' => 30],
            [['dis_estado','dis_accion'], 'string', 'max' => 1],
            [['dis_fechaCreacion','dis_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dis_id' => Yii::t('app', 'Dis ID'),
            'dis_nombre' => Yii::t('app', 'Dis Nombre'),
        ];
    }
}
