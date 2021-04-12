<?php

namespace backend\models\coleccion;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\coleccion\Coleccion;

/**
 * ColeccionSearch represents the model behind the search form of `backend\models\coleccion\Coleccion`.
 */
class ColeccionSearch extends Coleccion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['col_id', 'dis_id', 'inv_id'], 'integer'],
            [['col_titulo',  'col_fechaCreacion', 'col_fechaPublicacion', 'col_descripcion', 'col_fuente', 'col_estadocol', 'col_portada', 'col_estado'], 'safe'],
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
        $query = Coleccion::find();

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
            'col_id' => $this->col_id,
            'col_fechaCreacion' => $this->col_fechaCreacion,
            'col_fechaPublicacion' => $this->col_fechaPublicacion,
            'dis_id' => $this->dis_id,
            'inv_id' => $this->inv_id,
        ]);

        $query->andFilterWhere(['like', 'col_titulo', $this->col_titulo])
            ->andFilterWhere(['like', 'col_descripcion', $this->col_descripcion])
            ->andFilterWhere(['like', 'col_fuente', $this->col_fuente])
            ->andFilterWhere(['like', 'col_estadocol', $this->col_estadocol])
            ->andFilterWhere(['like', 'col_portada', $this->col_portada])
            ->andFilterWhere(['like', 'col_estado', $this->col_estado]);

        return $dataProvider;
    }
}
