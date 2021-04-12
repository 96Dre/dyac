<?php

namespace backend\models\idioma;

use Yii;

/**
 * This is the model class for table "idioma".
 *
 * @property int $idi_id
 * @property string $idi_nombre
 * @property string $idi_estado
 * @property string $idi_fechaCreacion
 * @property string $idi_fechaAudit
 * @property string $idi_accion
 */
class Idioma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idioma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idi_nombre'], 'required'],
            [['idi_nombre'], 'string', 'max' => 50],
            [['idi_estado','idi_accion'], 'string', 'max' => 1],
            [['idi_fechaCreacion','idi_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idi_id' => Yii::t('app', 'Idi ID'),
            'idi_nombre' => Yii::t('app', 'Idi Nombre'),
        ];
    }
}
