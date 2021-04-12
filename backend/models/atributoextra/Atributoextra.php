<?php

namespace backend\models\atributoextra;

use Yii;

/**
 * This is the model class for table "atributo_extra".
 *
 * @property int $aex_id
 * @property string $aex_nombre
 * @property string $aex_tipo
 * @property string $aex_descripcion
 * @property string $aex_estado
 * @property string $aex_fechaCreacion
 * @property string $aex_fechaAudit
 * @property string $aex_accion
 *
 * @property ArchivoAtributoex[] $archivoAtributoexes
 */
class Atributoextra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atributo_extra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aex_nombre', 'aex_tipo', 'aex_descripcion'], 'required'],
            [['aex_nombre'], 'string', 'max' => 30],
            [['aex_tipo'], 'string'],
            [['aex_descripcion'], 'string', 'max' => 250],
            [['aex_estado','aex_accion'], 'string', 'max' => 1],
            [['aex_fechaCreacion','aex_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aex_id' => Yii::t('app', 'Aex ID'),
            'aex_nombre' => Yii::t('app', 'Aex Nombre'),
            'aex_tipo' => Yii::t('app', 'Aex Tipo'),
            'aex_descripcion' => Yii::t('app', 'Aex Descripcion'),
        ];
    }

    /**
     * Gets query for [[ArchivoAtributoexes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivoAtributoexes()
    {
        return $this->hasMany(ArchivoAtributoex::className(), ['aex_id' => 'aex_id']);
    }
}
