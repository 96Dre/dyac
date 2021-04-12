<?php

namespace backend\models\usergenero;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\usergenero\Usergenero;

/**
 * UsergeneroSearch represents the model behind the search form of `backend\models\usergenero\Usergenero`.
 */
class UsergeneroSearch extends Usergenero
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uge_id'], 'integer'],
            [['uge_nombre'], 'safe'],
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
        $query = Usergenero::find()->orderBy('uge_nombre ASC');

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
            'uge_id' => $this->uge_id,
        ]);

        $query->andFilterWhere(['like', 'uge_nombre', $this->uge_nombre]);

        return $dataProvider;
    }
}
