<?php

namespace backend\models\menu;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\menu\Menu;

/**
 * MenuSearch represents the model behind the search form of `backend\models\menu\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['men_id', 'men_idPadre', 'men_posicion', 'men_activo'], 'integer'],
            [['men_nombre', 'men_descripción', 'men_icono', 'men_color', 'men_url'], 'safe'],
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
        $query = Menu::find();

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
            'men_id' => $this->men_id,
            'men_idPadre' => $this->men_idPadre,
            'men_posicion' => $this->men_posicion,
            'men_activo' => $this->men_activo,
        ]);

        $query->andFilterWhere(['like', 'men_nombre', $this->men_nombre])
            ->andFilterWhere(['like', 'men_descripción', $this->men_descripción])
            ->andFilterWhere(['like', 'men_icono', $this->men_icono])
            ->andFilterWhere(['like', 'men_color', $this->men_color])
            ->andFilterWhere(['like', 'men_url', $this->men_url]);

        return $dataProvider;
    }
}
