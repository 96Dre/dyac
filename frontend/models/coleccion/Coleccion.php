<?php

namespace frontend\models\coleccion;

use Yii;
use backend\models\disciplina\Disciplina;
use frontend\models\investigador\Investigador;

/**
 * This is the model class for table "coleccion".
 *
 * @property int $col_id
 * @property string $col_titulo
 * @property string $col_fechaPublicacion
 * @property int|null $dis_id
 * @property string $col_descripcion
 * @property string $col_fuente
 * @property string $col_estadocol
 * @property string $col_portada
 * @property int|null $inv_id
 * @property string $col_estado
 *
 *
 * @property string $col_estadoAudit
 * @property string $col_fechaCreacion
 * @property string $col_fechaAudit
 * @property string $col_accion
 *
 *
 * @property Archivo[] $archivos
 * @property Disciplina $dis
 * @property Investigador $inv
 * @property ColeccionAtributoex[] $coleccionAtributoexes
 * @property ColeccionPais[] $coleccionPais
 * @property ColeccionPersona[] $coleccionPersonas
 * @property ContadorColeccion[] $contadorColeccions
 * @property PalabraClave[] $palabraClaves
 */
class Coleccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coleccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['col_titulo', 'col_fechaPublicacion', 'col_descripcion', 'col_fuente', 'col_estadocol', 'dis_id', 'col_estado'], 'required'],
            [['col_fechaCreacion', 'col_fechaPublicacion'], 'safe'],
            [['col_portada'], 'file', 'extensions' => 'jpeg,jpg,png'],
            [['dis_id', 'inv_id'], 'integer'],
            [['col_titulo'], 'string', 'max' => 50],
            [['col_descripcion'], 'string', 'max' => 4000],
            [['col_fuente'], 'string', 'max' => 500],
            [['col_estadocol', 'col_estado'], 'string', 'max' => 1],
            [['col_portada'], 'string', 'max' => 2000],
            [['dis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['dis_id' => 'dis_id']],
            [['inv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Investigador::className(), 'targetAttribute' => ['inv_id' => 'inv_id']],

            [['col_estadoAudit','col_accion'], 'string', 'max' => 1],
            [['col_fechaCreacion','col_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'col_id' => Yii::t('app', 'Col ID'),
            'col_titulo' => Yii::t('app', 'Col Titulo'),
            'col_fechaCreacion' => Yii::t('app', 'Col Fecha Creacion'),
            'col_fechaPublicacion' => Yii::t('app', 'Col Fecha Publicacion'),
            'dis_id' => Yii::t('app', 'Dis ID'),
            'col_descripcion' => Yii::t('app', 'Col Descripcion'),
            'col_fuente' => Yii::t('app', 'Col Fuente'),
            'col_estadocol' => Yii::t('app', 'Col Estadocol'),
            'col_portada' => Yii::t('app', 'Col Portada'),
            'inv_id' => Yii::t('app', 'Inv ID'),
            'col_estado' => Yii::t('app', 'Col Estado'),
        ];
    }

    /**
     * Gets query for [[Archivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivos()
    {
        return $this->hasMany(Archivo::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[Dis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDis()
    {
        return $this->hasOne(Disciplina::className(), ['dis_id' => 'dis_id']);
    }

    /**
     * Gets query for [[Inv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInv()
    {
        return $this->hasOne(Investigador::className(), ['inv_id' => 'inv_id']);
    }

    /**
     * Gets query for [[ColeccionAtributoexes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColeccionAtributoexes()
    {
        return $this->hasMany(ColeccionAtributoex::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[ColeccionPais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColeccionPais()
    {
        return $this->hasMany(ColeccionPais::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[ColeccionPersonas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColeccionPersonas()
    {
        return $this->hasMany(ColeccionPersona::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[ContadorColeccions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContadorColeccions()
    {
        return $this->hasMany(ContadorColeccion::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[PalabraClaves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPalabraClaves()
    {
        return $this->hasMany(PalabraClave::className(), ['col_id' => 'col_id']);
    }
}
