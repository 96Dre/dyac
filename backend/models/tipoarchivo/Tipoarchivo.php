<?php

namespace backend\models\tipoarchivo;

use Yii;

/**
 * This is the model class for table "tipo_archivo".
 *
 * @property int $tar_id
 * @property string $tar_tipo
 * @property string $tar_extension
 * @property string $tar_estado
 * @property string $tar_fechaCreacion
 * @property string $tar_fechaAudit
 * @property string $tar_accion
 *
 * @property ArchivoAtributoex[] $archivoAtributoexes
 */
class Tipoarchivo extends \yii\db\ActiveRecord

{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_archivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tar_tipo','tar_extension'], 'required'],
            [['array'], 'safe'],
            [['tar_extension'], 'string', 'max' => 30],
            [['tar_tipo'], 'string', 'max' => 30],
            [['tar_estado','tar_accion'], 'string', 'max' => 1],
            [['tar_fechaCreacion','tar_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tar_id' => Yii::t('app', 'Tar ID'),
            'tar_tipo' => Yii::t('app', 'Tar Tipo'),
            'tar_extension' => Yii::t('app', 'Tar Extension'),
        ];
    }

    /**
     * Gets query for [[ArchivoAtributoexes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoAtributoexes()
    {
        return $this->hasMany(ArchivoAtributoex::className(), ['tar_id' => 'tar_id']);
    }
}
