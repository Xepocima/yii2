<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Screenshots".
 *
 * @property integer $screensh_id
 * @property string $screensh_path
 * @property integer $game_id
 */
class Screenshots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Screenshots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screensh_path', 'game_id'], 'required'],
            [['screensh_path'], 'string'],
            [['game_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'screensh_id' => 'Screensh ID',
            'screensh_path' => 'Screensh Path',
            'game_id' => 'Game ID',
        ];
    }
}
