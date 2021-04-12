<?php

namespace backend\models\idioma;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\idioma\Idioma;

/**
 * IdiomaSerach represents the model behind the search form of `backend\models\idioma\Idioma`.
 */
class IdiomaSerach extends Idioma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idi_id'], 'integer'],
            [['idi_nombre'], 'safe'],
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
        $query = Idioma::find()->orderBy('idi_nombre ASC');;

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
            'idi_id' => $this->idi_id,
        ]);

        $query->andFilterWhere(['like', 'idi_nombre', $this->idi_nombre]);

        return $dataProvider;
    }
}
