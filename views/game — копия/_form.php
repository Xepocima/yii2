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
            foreach ($trailers as $key) {
                
            echo $form->field($key, 'trailer_path')->widget(MultipleInput::className(), [
                'limit'             => 1,
                'allowEmptyList'    => false,
                'enableGuessTitle'  => false,
        'min'               => 1, // should be at least 2 rows
        'addButtonPosition' => MultipleInput::POS_ROW // show add button in the header
        ])
            ->label(false);
            # code...
            }
            ?>



    




            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить игру' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
