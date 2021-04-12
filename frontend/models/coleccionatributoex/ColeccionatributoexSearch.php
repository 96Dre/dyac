<?php

namespace frontend\models\coleccionatributoex;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\coleccionatributoex\Coleccionatributoex;

/**
 * ColeccionatributoexSearch represents the model behind the search form of `frontend\models\coleccionatributoex\Coleccionatributoex`.
 */
class ColeccionatributoexSearch extends Coleccionatributoex
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cae_id', 'aex_id', 'col_id'], 'integer'],
            [['cae_descripcion', 'cae_estado', 'cae_fechaCreacion', 'cae_fechaAudit', 'cae_accion'], 'safe'],
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
        $query = Coleccionatributoex::find();

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
            'cae_id' => $this->cae_id,
            'aex_id' => $this->aex_id,
            'col_id' => $this->col_id,
            'cae_fechaCreacion' => $this->cae_fechaCreacion,
            'cae_fechaAudit' => $this->cae_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'cae_descripcion', $this->cae_descripcion])
            ->andFilterWhere(['like', 'cae_estado', $this->cae_estado])
            ->andFilterWhere(['like', 'cae_accion', $this->cae_accion]);

        return $dataProvider;
    }
}
