<?php

namespace backend\models\tipoarchivo;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\tipoarchivo\Tipoarchivo;

/**
 * TipoarchivoSearch represents the model behind the search form of `backend\models\tipoarchivo\Tipoarchivo`.
 */
class TipoarchivoSearch extends Tipoarchivo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tar_id'], 'integer'],
            [['tar_tipo','tar_extension'], 'safe'],
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
        $query = Tipoarchivo::find()->orderBy('tar_tipo ASC');

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
            'tar_id' => $this->tar_id,
        ]);

        $query->andFilterWhere(['like', 'tar_tipo', $this->tar_tipo]);
        $query->andFilterWhere(['like', 'tar_extension', $this->tar_extension]);

        return $dataProvider;
    }
}
