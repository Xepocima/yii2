<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property integer $genre_id
 * @property string $genre_name
 * @property string $genre_desc
 *
 * @property Games[] $games
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['genre_name', 'genre_desc'], 'required'],
            [['genre_desc'], 'string'],
            [['genre_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'genre_id' => 'Genre ID',
            'genre_name' => 'Genre Name',
            'genre_desc' => 'Genre Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['genre_id' => 'genre_id']);
    }
}
