<?php

namespace frontend\models\archivo;

use frontend\models\archivo\Archivo;
use frontend\models\coleccion\Coleccion;
use frontend\models\investigador\Investigador;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ArchivoSearch represents the model behind the search form of `frontend\models\archivo\Archivo`.
 */
class ArchivoSearch extends Archivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arc_id', 'col_id', 'tar_id', 'pai_id', 'gen_id', 'idi_id', 'der_id'], 'integer'],
            [['arc_descripcion', 'arc_archivo', 'arc_ubicacion', 'arc_cita', 'arc_estadoarc', 'arc_estado', 'arc_fechaCreacion', 'arc_fechaAudit', 'arc_accion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        /*$model = Investigador::find()->select(['inv_id'])->where(['usu_id' => Yii::$app->user->identity->id])->one();

        $coleccion = Coleccion::find()->select(['col_id'])
            ->where(['inv_id'=>$model->inv_id])
            ->all();*/

        if (isset(Yii::$app->session['c_id'])){
            $c_id = Yii::$app->session['c_id'];
        } else {
            $c_id = 'null';
        }


        $query = Archivo::find()
            ->where(['col_id'=>$c_id])
           ->orderBy('arc_fechaCreacion DESC')
         ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'arc_id' => $this->arc_id,
            'col_id' => $this->col_id,
            'tar_id' => $this->tar_id,
            'pai_id' => $this->pai_id,
            'gen_id' => $this->gen_id,
            'idi_id' => $this->idi_id,
            'der_id' => $this->der_id,
            'arc_fechaCreacion' => $this->arc_fechaCreacion,
            'arc_fechaAudit' => $this->arc_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'arc_descripcion', $this->arc_descripcion])
            ->andFilterWhere(['like', 'arc_archivo', $this->arc_archivo])
            ->andFilterWhere(['like', 'arc_ubicacion', $this->arc_ubicacion])
            ->andFilterWhere(['like', 'arc_cita', $this->arc_cita])
            ->andFilterWhere(['like', 'arc_estadoarc', $this->arc_estadoarc])
            ->andFilterWhere(['like', 'arc_estado', $this->arc_estado])
            ->andFilterWhere(['like', 'arc_accion', $this->arc_accion]);

        return $dataProvider;
    }
}
