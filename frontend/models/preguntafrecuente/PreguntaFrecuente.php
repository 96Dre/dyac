<?php

namespace frontend\models\preguntafrecuente;

use Yii;

/**
 * This is the model class for table "pregunta_frecuente".
 *
 * @property int $pfr_id
 * @property string $pfr_pregunta
 * @property string $pfr_respuesta
 * @property string $pfr_estado
 * @property string $pfr_fechaCreacion
 * @property string $pfr_fechaAudit
 * @property string $pfr_accion
 */
class PreguntaFrecuente extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pregunta_frecuente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['pfr_pregunta', 'pfr_respuesta', 'pfr_estado', 'pfr_fechaCreacion', 'pfr_fechaAudit', 'pfr_accion'], 'required'],
                [['pfr_fechaCreacion', 'pfr_fechaAudit'], 'safe'],
                [['pfr_pregunta'], 'string', 'max' => 500],
                [['pfr_respuesta'], 'string', 'max' => 1000],
                [['pfr_estado', 'pfr_accion'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'pfr_id' => Yii::t('app', 'N°'),
            'pfr_pregunta' => Yii::t('app', 'Pregunta'),
            'pfr_respuesta' => Yii::t('app', 'Respuesta'),
            'pfr_estado' => Yii::t('app', 'Estado'),
            'pfr_fechaCreacion' => Yii::t('app', 'Fecha de creacion'),
            'pfr_fechaAudit' => Yii::t('app', 'Fecha de auditoria'),
            'pfr_accion' => Yii::t('app', 'Acción'),
        ];
    }

    public function countRegistros() {
        $count = $this->connection->createCommand()
                        ->select("count(pfr_id) as 'count' ")->from('pregunta_frecuente')->queryAll();
        return $count[0]["count"];
    }

    public function getPreguntas($inicio, $cantidad) {

        $this->getPreguntas = $this->connection
                ->createCommand("SELECT * FROM pregunta_frecuente LIMIT $inicio,$cantidad")
                ->queryAll();
        return $this->getPreguntas;
    }

}
