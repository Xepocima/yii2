<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Games;

/**
 * GamesSearch represents the model behind the search form about `app\models\Games`.
 */
class GamesSearch extends Games
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['games_id', 'game_id', 'genre_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Games::find();

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
            'games_id' => $this->games_id,
            'game_id' => $this->game_id,
            'genre_id' => $this->genre_id,
        ]);

        return $dataProvider;
    }
}
