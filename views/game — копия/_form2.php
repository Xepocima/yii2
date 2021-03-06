<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\widgets\MultipleInput;
use kartik\date\DatePicker;
use kartik\widgets\DateTimePicker;
use app\models\Genre;
use yii\helpers\ArrayHelper;

$genresID = Genre::find()->All();

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_name')->textInput(['maxlength' => true])->label('Название игры') ?>


    <?php
    $items = ArrayHelper::map(Genre::find()->all(), 'genre_id', 'genre_name');
    echo  $form->field($genre[0], 'genre_id')->widget(MultipleInput::className(), [
        'limit' => 4,
        'columns' => [
        [
        'name'  => 'genre_id',
        'type'  => 'dropDownList',
        'title' => 'Жанр',
        'defaultValue' => 1,
        'items' => $items,
        ]
        ],

        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'min'               => 1, // should be at least 2 rows
        'addButtonPosition' => MultipleInput::POS_ROW,

        ])->label(false);
        ?>


        <?= $form->field($model, 'game_desc')->textarea(['rows' => 6])->label('Описание') ?>

        <?= $form->field($model, 'game_dev')->textInput(['maxlength' => true])->label('Разработчик') ?>

        <? echo $form->field($model, 'game_announce')->widget(DatePicker::className(), [
            'name' => 'dp',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
            ]
            ]);
            ?>

            <?= $form->field($model, 'game_price')->textInput()->label('Цена') ?>

            <?= $form->field($model, 'game_poster')->textInput()->label('Постер') ?>

            <?php
            echo $form->field($trailers[0], 'trailer_path')->widget(MultipleInput::className(), [
                'limit'             => 3,
                'allowEmptyList'    => false,
                'enableGuessTitle'  => true,
        'min'               => 1, // should be at least 2 rows
        'addButtonPosition' => MultipleInput::POS_ROW // show add button in the header
        ])
            ->label(false);
            ?>



            <?php
            echo $form->field($screenshot[0], 'screensh_path')->widget(MultipleInput::className(), [
                'limit'             => 6,
                'allowEmptyList'    => false,
                'enableGuessTitle'  => true,
        'min'               => 1, // should be at least 2 rows
        'addButtonPosition' => MultipleInput::POS_ROW // show add button in the header
        ])
            ->label(false);
            ?>




            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить игру' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
