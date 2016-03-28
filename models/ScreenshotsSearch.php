<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Screenshots;

/**
 * ScreenshotsSearch represents the model behind the search form about `app\models\Screenshots`.
 */
class ScreenshotsSearch extends Screenshots
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screensh_id', 'game_id'], 'integer'],
            [['screensh_path'], 'safe'],
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
        $query = Screenshots::find();

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
            'screensh_id' => $this->screensh_id,
            'game_id' => $this->game_id,
        ]);

        $query->andFilterWhere(['like', 'screensh_path', $this->screensh_path]);

        return $dataProvider;
    }
}
