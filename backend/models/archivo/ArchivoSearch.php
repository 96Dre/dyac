<?php

namespace backend\models\archivo;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\archivo\Archivo;

/**
 * ArchivoSearch represents the model behind the search form of `backend\models\archivo\Archivo`.
 */
class ArchivoSearch extends Archivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arc_id', 'col_id', 'tar_id', 'pai_id', 'gen_id', 'idi_id', 'der_id'], 'integer'],
            [['arc_descripcion', 'arc_archivo', 'arc_ubicacion', 'arc_cita', 'arc_estadoarc', 'arc_estado', 'arc_fechaCreacion', 'arc_fechaAudit', 'arc_accion'], 'safe'],
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
        $query = Archivo::find()
        ->orderBy('arc_fechaCreacion DESC')
    ;

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
            'arc_id' => $this->arc_id,
            'col_id' => $this->col_id,
            'tar_id' => $this->tar_id,
            'pai_id' => $this->pai_id,
            'gen_id' => $this->gen_id,
            'idi_id' => $this->idi_id,
            'der_id' => $this->der_id,
            'arc_fechaCreacion' => $this->arc_fechaCreacion,
            'arc_fechaAudit' => $this->arc_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'arc_descripcion', $this->arc_descripcion])
            ->andFilterWhere(['like', 'arc_archivo', $this->arc_archivo])
            ->andFilterWhere(['like', 'arc_ubicacion', $this->arc_ubicacion])
            ->andFilterWhere(['like', 'arc_cita', $this->arc_cita])
            ->andFilterWhere(['like', 'arc_estadoarc', $this->arc_estadoarc])
            ->andFilterWhere(['like', 'arc_estado', $this->arc_estado])
            ->andFilterWhere(['like', 'arc_accion', $this->arc_accion]);

        return $dataProvider;
    }
      public function searchPendientes($params)
    {
        $query = Archivo::find()
        ->orderBy('arc_fechaCreacion DESC')
    ;

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
            'arc_id' => $this->arc_id,
            'col_id' => $this->col_id,
            'tar_id' => $this->tar_id,
            'pai_id' => $this->pai_id,
            'gen_id' => $this->gen_id,
            'idi_id' => $this->idi_id,
            'der_id' => $this->der_id,
            'arc_fechaCreacion' => $this->arc_fechaCreacion,
            'arc_fechaAudit' => $this->arc_fechaAudit,
        ]);

        $query->andFilterWhere(['like', 'arc_descripcion', $this->arc_descripcion])
            ->andFilterWhere(['like', 'arc_archivo', $this->arc_archivo])
            ->andFilterWhere(['like', 'arc_ubicacion', $this->arc_ubicacion])
            ->andFilterWhere(['like', 'arc_cita', $this->arc_cita])
            ->andFilterWhere(['like', 'arc_estadoarc', 'P']) //Pendiente
            ->andFilterWhere(['like', 'arc_estado', $this->arc_estado])
            ->andFilterWhere(['like', 'arc_accion', $this->arc_accion]);

        return $dataProvider;
    }
}
