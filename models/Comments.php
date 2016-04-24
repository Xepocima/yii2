<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Comments".
 *
 * @property integer $comm_id
 * @property string $comm_desc
 * @property string $comm_auth
 * @property string $comm_date
 * @property integer $game_id
 *
 * @property Game $game
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comm_desc', 'comm_auth', 'comm_date', 'game_id'], 'required'],
            [['comm_desc'], 'string'],
            [['comm_date'], 'safe'],
            [['game_id'], 'integer'],
            [['comm_auth'], 'string', 'max' => 30],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'game_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comm_id' => 'Comm ID',
            'comm_desc' => 'Comm Desc',
            'comm_auth' => 'Comm Auth',
            'comm_date' => 'Comm Date',
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
