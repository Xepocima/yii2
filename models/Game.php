<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $game_id
 * @property string $game_name
 * @property string $game_desc
 * @property string $game_dev
 * @property string $game_announce
 * @property integer $game_price
 * @property string $game_poster
 *
 * @property Comments[] $comments
 * @property News[] $news
 * @property Trailers[] $trailers
 * @property Games[] $games
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_name', 'game_desc', 'game_dev', 'game_announce', 'game_price', 'game_poster'], 'required'],
            [['game_poster'], 'url'],
            [['game_announce'], 'date', 'format' => 'yyyy-mm-dd'],
            [['game_price'], 'integer'],
            [['game_name', 'game_dev','game_desc'], 'string', 'max' => 1100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_id' => 'Game ID',
            'game_name' => 'Game Name',
            'game_desc' => 'Game Desc',
            'game_dev' => 'Game Dev',
            'game_announce' => 'Дата выхода',
            'game_price' => 'Game Price',
            'game_poster' => 'Game Poster',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['game_id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['game_id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrailers()
    {
        return $this->hasMany(Trailers::className(), ['game_id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['game_id' => 'game_id']);
    }
}
