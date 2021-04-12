<?php

namespace backend\models\atributoextra;


use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * AtributoextraSearch represents the model behind the search form of `backend\models\atributoextra\Atributoextra`.
 */
class AtributoextraSearch extends Atributoextra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aex_id'], 'integer'],
            [['aex_nombre', 'aex_tipo', 'aex_descripcion'], 'safe'],
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
        $query = Atributoextra::find()->orderBy('aex_nombre ASC');

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
            'aex_id' => $this->aex_id,
        ]);

        $query->andFilterWhere(['like', 'aex_nombre', $this->aex_nombre])
            ->andFilterWhere(['like', 'aex_tipo', $this->aex_tipo])
            ->andFilterWhere(['like', 'aex_descripcion', $this->aex_descripcion]);

        return $dataProvider;
    }

    public function getAllAtributosextra()
    {
        $query = Atributoextra::find()
            ->alias('aex')
            ->where(['aex.aex_tipo' => 'Archivo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }
        return $dataProvider;
    }


}
