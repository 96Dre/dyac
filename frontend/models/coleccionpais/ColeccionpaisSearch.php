<?php

namespace frontend\models\coleccionpais;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\coleccionpais\Coleccionpais;

/**
 * ColeccionpaisSearch represents the model behind the search form of `frontend\models\coleccionpais\Coleccionpais`.
 */
class ColeccionpaisSearch extends Coleccionpais
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pai_id', 'col_id', 'cpa_id'], 'integer'],
            [['cpa_ubicacion', 'cpa_estado', 'cpa_fechaCreacion', 'cpa_fechaAudit', 'cpa_accion'], 'safe'],
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
        $query = Coleccionpais::find();

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
            'pai_id' => $this->pai_id,
            'col_id' => $this->col_id,
            'cpa_id' => $this->cpa_id,
            'cpa_fechaCreacion' => $this->cpa_fechaCreacion,
            'cpa_fechaAudit' => $this->cpa_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'cpa_ubicacion', $this->cpa_ubicacion])
            ->andFilterWhere(['like', 'cpa_estado', $this->cpa_estado])
            ->andFilterWhere(['like', 'cpa_accion', $this->cpa_accion]);

        return $dataProvider;
    }
}
