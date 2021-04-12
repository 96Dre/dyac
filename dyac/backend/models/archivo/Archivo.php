<?php

namespace backend\models\archivo;

use Yii;
use backend\models\coleccion\Coleccion;
use backend\models\tipoarchivo\Tipoarchivo;
use backend\models\pais\Pais;
use backend\models\genero\Genero;
use backend\models\idioma\Idioma;
use backend\models\derecho\Derecho;

/**
 * This is the model class for table "archivo".
 *
 * @property int $arc_id
 * @property string $arc_descripcion
 * @property string $arc_archivo
 * @property int|null $col_id
 * @property int|null $tar_id
 * @property int|null $pai_id
 * @property string $arc_ubicacion
 * @property int|null $gen_id
 * @property string $arc_cita
 * @property int|null $idi_id
 * @property int|null $der_id
 * @property string $arc_estadoarc
 * @property string $arc_estado
 * @property string $arc_fechaCreacion
 * @property string $arc_fechaAudit
 * @property string $arc_accion
 * @property string $arc_tipo
 *
 * @property Coleccion $col
 * @property TipoArchivo $tar
 * @property Pais $pai
 * @property Genero $gen
 * @property Idioma $idi
 * @property Derecho $der
 * @property ContadorArchivo[] $contadorArchivos
 * @property DetallearchivoAtributoex[] $detallearchivoAtributoexes
 */
class Archivo extends \yii\db\ActiveRecord
{
    public $observacion;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arc_descripcion', 'arc_ubicacion', 'arc_cita','tar_id','pai_id','idi_id'], 'required'],
            [['col_id', 'tar_id', 'pai_id', 'gen_id', 'idi_id', 'der_id'], 'integer'],
            [['arc_fechaCreacion','arc_accion','arc_accionarc','arc_tipo'], 'safe'],
            [['arc_tipo'], 'string', 'max' => 25],
            [['arc_descripcion'], 'string', 'max' => 1000],
            [['arc_archivo'], 'string', 'max' => 2000],
            [['arc_ubicacion', 'arc_cita'], 'string', 'max' => 500],
            [['arc_estadoarc', 'arc_estado', 'arc_accion'], 'string', 'max' => 1],
            [['col_id'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\coleccion\Coleccion::className(), 'targetAttribute' => ['col_id' => 'col_id']],
            [['tar_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoArchivo::className(), 'targetAttribute' => ['tar_id' => 'tar_id']],
            [['pai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['pai_id' => 'pai_id']],
            [['gen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['gen_id' => 'gen_id']],
            [['idi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::className(), 'targetAttribute' => ['idi_id' => 'idi_id']],
            [['der_id'], 'exist', 'skipOnError' => true, 'targetClass' => Derecho::className(), 'targetAttribute' => ['der_id' => 'der_id']],
            ['arc_archivo', 'file',
                //'skipOnEmpty' => false,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024*1024*50, //50 MB
                'tooBig' => 'El tamaño máximo permitido es 50MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                //'extensions' => 'jpg,jpeg,png,mp3,mp4,pdf,txt,doc,docx,xlsx,pptx,zip,rar',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'maxFiles' => 1,
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'arc_id' => Yii::t('app', 'Arc ID'),
            'arc_descripcion' => Yii::t('app', 'Arc Descripcion'),
            'arc_archivo' => Yii::t('app', 'Arc Archivo'),
            'col_id' => Yii::t('app', 'Col ID'),
            'tar_id' => Yii::t('app', 'Tar ID'),
            'pai_id' => Yii::t('app', 'Pai ID'),
            'arc_tipo' => Yii::t('app', 'Arc Tipo'),
            'arc_ubicacion' => Yii::t('app', 'Arc Ubicacion'),
            'gen_id' => Yii::t('app', 'Gen ID'),
            'arc_cita' => Yii::t('app', 'Arc Cita'),
            'idi_id' => Yii::t('app', 'Idi ID'),
            'der_id' => Yii::t('app', 'Der ID'),
            'arc_estadoarc' => Yii::t('app', 'Arc Estadoarc'),
            'arc_estado' => Yii::t('app', 'Arc Estado'),
            'arc_fechaCreacion' => Yii::t('app', 'Arc Fecha Creacion'),
            'arc_fechaAudit' => Yii::t('app', 'Arc Fecha Audit'),
            'arc_accion' => Yii::t('app', 'Arc Accion'),
        ];
    }

    /**
     * Gets query for [[Col]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCol()
    {
        return $this->hasOne(Coleccion::className(), ['col_id' => 'col_id']);
    }

    /**
     * Gets query for [[Tar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTar()
    {
        return $this->hasOne(TipoArchivo::className(), ['tar_id' => 'tar_id']);
    }

    /**
     * Gets query for [[Pai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPai()
    {
        return $this->hasOne(Pais::className(), ['pai_id' => 'pai_id']);
    }

    /**
     * Gets query for [[Gen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGen()
    {
        return $this->hasOne(Genero::className(), ['gen_id' => 'gen_id']);
    }

    /**
     * Gets query for [[Idi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdi()
    {
        return $this->hasOne(Idioma::className(), ['idi_id' => 'idi_id']);
    }

    /**
     * Gets query for [[Der]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDer()
    {
        return $this->hasOne(Derecho::className(), ['der_id' => 'der_id']);
    }

    /**
     * Gets query for [[ContadorArchivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContadorArchivos()
    {
        return $this->hasMany(ContadorArchivo::className(), ['arc_id' => 'arc_id']);
    }

    /**
     * Gets query for [[DetallearchivoAtributoexes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetallearchivoAtributoexes()
    {
        return $this->hasMany(DetallearchivoAtributoex::className(), ['arc_id' => 'arc_id']);
    }
}
