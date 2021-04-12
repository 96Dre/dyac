<?php

namespace frontend\models\preguntafrecuente;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\preguntafrecuente\PreguntaFrecuente;

/**
 * PreguntaFrecuenteSearch represents the model behind the search form of `backend\models\preguntafrecuente\PreguntaFrecuente`.
 */
class PreguntaFrecuenteSearch extends PreguntaFrecuente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pfr_id'], 'integer'],
            [['pfr_pregunta', 'pfr_respuesta', 'pfr_estado', 'pfr_fechaCreacion', 'pfr_fechaAudit', 'pfr_accion'], 'safe'],
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
        $query = PreguntaFrecuente::find();

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
            'pfr_id' => $this->pfr_id,
            'pfr_fechaCreacion' => $this->pfr_fechaCreacion,
            'pfr_fechaAudit' => $this->pfr_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'pfr_pregunta', $this->pfr_pregunta])
            ->andFilterWhere(['like', 'pfr_respuesta', $this->pfr_respuesta])
            ->andFilterWhere(['like', 'pfr_estado', $this->pfr_estado])
            ->andFilterWhere(['like', 'pfr_accion', $this->pfr_accion]);

        return $dataProvider;
    }
}
