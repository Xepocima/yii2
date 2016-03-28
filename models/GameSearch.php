<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Game;

/**
 * GameSearch represents the model behind the search form about `app\models\Game`.
 */
class GameSearch extends Game
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'game_price'], 'integer'],
            [['game_name', 'game_desc', 'game_dev', 'game_announce', 'game_poster'], 'safe'],
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
        $query = Game::find();

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
            'game_id' => $this->game_id,
            'game_announce' => $this->game_announce,
            'game_price' => $this->game_price,
        ]);

        $query->andFilterWhere(['like', 'game_name', $this->game_name])
            ->andFilterWhere(['like', 'game_desc', $this->game_desc])
            ->andFilterWhere(['like', 'game_dev', $this->game_dev])
            ->andFilterWhere(['like', 'game_poster', $this->game_poster]);

        return $dataProvider;
    }
}
