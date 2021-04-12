<?php

namespace backend\models\archivoatributoex;


use yii\base\Model;
use yii\data\ActiveDataProvider;



/**
 * ArchivoatributoexSearch represents the model behind the search form of `backend\models\archivoatributoex\Archivoatributoex`.
 */
class ArchivoatributoexSearch extends Archivoatributoex
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aae_id', 'aex_id', 'tar_id'], 'integer'],
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
        $query = Archivoatributoex::find();

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
            'aae_id' => $this->aae_id,
            'aex_id' => $this->aex_id,
            'tar_id' => $this->tar_id,
        ]);

        return $dataProvider;
    }

    public function getAtributosExtra($tar_id){

        //SELECT * FROM archivo_atributoex a LEFT JOIN atributo_extra b ON a.aex_id = b.aex_id WHERE tar_id=7

        $model = Archivoatributoex::find()
            ->alias('a')
            ->select('*')
            ->leftJoin('atributo_extra b', 'a.aex_id = b.aex_id')
            ->where(['a.tar_id' => $tar_id])
            ->OrderBy('aex_nombre')
            ->all();
        return $model;
    }

}
