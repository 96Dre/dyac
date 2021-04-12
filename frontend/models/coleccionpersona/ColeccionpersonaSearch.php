<?php

namespace frontend\models\coleccionpersona;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\coleccionpersona\Coleccionpersona;

/**
 * ColeccionpersonaSearch represents the model behind the search form of `frontend\models\coleccionpersona\Coleccionpersona`.
 */
class ColeccionpersonaSearch extends Coleccionpersona
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpe_id', 'inv_id', 'col_id'], 'integer'],
            [['cpe_estado', 'cpe_fechaCreacion', 'cpe_fechaAudit', 'cpe_accion'], 'safe'],
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
        $query = Coleccionpersona::find();

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
            'cpe_id' => $this->cpe_id,
            'inv_id' => $this->inv_id,
            'col_id' => $this->col_id,
            'cpe_fechaCreacion' => $this->cpe_fechaCreacion,
            'cpe_fechaAudit' => $this->cpe_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'cpe_estado', $this->cpe_estado])
            ->andFilterWhere(['like', 'cpe_accion', $this->cpe_accion]);

        return $dataProvider;
    }
}
