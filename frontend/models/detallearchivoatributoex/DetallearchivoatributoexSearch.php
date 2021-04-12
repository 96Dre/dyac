<?php

namespace frontend\models\detallearchivoatributoex;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\detallearchivoatributoex\Detallearchivoatributoex;

/**
 * DetallearchivoatributoexSearch represents the model behind the search form of `frontend\models\detallearchivoatributoex\Detallearchivoatributoex`.
 */
class DetallearchivoatributoexSearch extends Detallearchivoatributoex
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dae_id', 'arc_id', 'aae_id'], 'integer'],
            [['dae_descripcion'], 'safe'],
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
        $query = Detallearchivoatributoex::find();

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
            'dae_id' => $this->dae_id,
            'arc_id' => $this->arc_id,
            'aae_id' => $this->aae_id,
        ]);

        $query->andFilterWhere(['like', 'dae_descripcion', $this->dae_descripcion]);

        return $dataProvider;
    }
}
