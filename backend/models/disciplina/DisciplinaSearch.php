<?php

namespace backend\models\disciplina;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\disciplina\Disciplina;

/**
 * DisciplinaSearch represents the model behind the search form of `backend\models\disciplina\Disciplina`.
 */
class DisciplinaSearch extends Disciplina
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dis_id'], 'integer'],
            [['dis_nombre'], 'safe'],
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
        $query = Disciplina::find()->orderBy('dis_nombre ASC');

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
            'dis_id' => $this->dis_id,
        ]);

        $query->andFilterWhere(['like', 'dis_nombre', $this->dis_nombre]);

        return $dataProvider;
    }
}
