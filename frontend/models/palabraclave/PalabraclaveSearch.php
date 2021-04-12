<?php

namespace frontend\models\palabraclave;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\palabraclave\Palabraclave;

/**
 * PalabraclaveSearch represents the model behind the search form of `frontend\models\palabraclave\Palabraclave`.
 */
class PalabraclaveSearch extends Palabraclave
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pcl_id', 'col_id'], 'integer'],
            [['pcl_palabraClave', 'pcl_estado', 'pcl_fechaCreacion', 'pcl_fechaAudit', 'pcl_accion'], 'safe'],
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
        $query = Palabraclave::find();

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
            'pcl_id' => $this->pcl_id,
            'col_id' => $this->col_id,
            'pcl_fechaCreacion' => $this->pcl_fechaCreacion,
            'pcl_fechaAudit' => $this->pcl_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'pcl_palabraClave', $this->pcl_palabraClave])
            ->andFilterWhere(['like', 'pcl_estado', $this->pcl_estado])
            ->andFilterWhere(['like', 'pcl_accion', $this->pcl_accion]);

        return $dataProvider;
    }
}
