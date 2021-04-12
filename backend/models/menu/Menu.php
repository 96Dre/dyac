<?php

namespace backend\models\menu;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $men_id
 * @property string $men_nombre
 * @property string $men_descripción
 * @property string $men_icono
 * @property string $men_color
 * @property string $men_url
 * @property int $men_idPadre
 * @property int $men_posicion
 * @property int $men_activo
 * @property string $men_estado
 * @property string $men_fechaCreacion
 * @property string $men_fechaAudit
 * @property string $men_accion
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['men_nombre', 'men_activo'], 'required'],
            [['men_idPadre', 'men_posicion', 'men_activo'], 'integer'],
            [['men_nombre', 'men_descripción'], 'string', 'max' => 100],
            [['men_icono', 'men_color'], 'string', 'max' => 50],
            [['men_url'], 'string', 'max' => 2000],
            [['men_estado','men_accion'], 'string', 'max' => 1],
            [['men_fechaCreacion','men_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'men_id' => Yii::t('app', 'Men ID'),
            'men_nombre' => Yii::t('app', 'Men Nombre'),
            'men_descripción' => Yii::t('app', 'Men Descripción'),
            'men_icono' => Yii::t('app', 'Men Icono'),
            'men_color' => Yii::t('app', 'Men Color'),
            'men_url' => Yii::t('app', 'Men Url'),
            'men_idPadre' => Yii::t('app', 'Men Id Padre'),
            'men_posicion' => Yii::t('app', 'Men Posicion'),
            'men_activo' => Yii::t('app', 'Men Activo'),
        ];
    }
}
