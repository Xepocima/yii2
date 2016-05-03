<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Trailers".
 *
 * @property integer $trailer_id
 * @property string $trailer_path
 * @property integer $game_id
 *
 * @property Game $game
 */
class Trailers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Trailers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id'], 'required'],
            [['trailer_path'], 'string'],
            [['game_id'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'game_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trailer_id' => 'Trailer ID',
            'trailer_path' => 'Трейлер',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['game_id' => 'game_id']);
    }
}
