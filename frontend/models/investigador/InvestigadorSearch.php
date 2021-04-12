<?php

namespace frontend\models\investigador;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\investigador\Investigador;

/**
 * InvestigadorSearch represents the model behind the search form of `frontend\models\investigador\Investigador`.
 */
class InvestigadorSearch extends Investigador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_id', 'usu_id'], 'integer'],
            [['inv_tituloProfesional', 'inv_descripcion', 'inv_twitter', 'inv_facebook', 'inv_instagram', 'inv_web'], 'safe'],
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
        $query = Investigador::find();

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
            'inv_id' => $this->inv_id,
            'usu_id' => $this->usu_id,
        ]);

        $query->andFilterWhere(['like', 'inv_tituloProfesional', $this->inv_tituloProfesional])
            ->andFilterWhere(['like', 'inv_descripcion', $this->inv_descripcion])
            ->andFilterWhere(['like', 'inv_twitter', $this->inv_twitter])
            ->andFilterWhere(['like', 'inv_facebook', $this->inv_facebook])
            ->andFilterWhere(['like', 'inv_instagram', $this->inv_instagram])
            ->andFilterWhere(['like', 'inv_web', $this->inv_web]);

        return $dataProvider;
    }
}
