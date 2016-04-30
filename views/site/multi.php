<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_name')->textInput(['maxlength' => true])->label('Название игры') ?>

    <?= $form->field($model, 'game_desc')->textarea(['rows' => 6])->label('Описание') ?>

    <?= $form->field($model, 'game_dev')->textInput(['maxlength' => true])->label('Разработчик') ?>

    <?= $form->field($model, 'game_announce')->textInput()->label('Дата выхода') ?>

    <?= $form->field($model, 'game_price')->textInput()->label('Цена') ?>

    <?= $form->field($model, 'game_poster')->textInput()->label('Постер') ?>

    <?= $form->field($screenshot, 'screensh_path')->textInput()->label('Скриншот') ?>

    <?= $form->field($trailer, 'trailer_path')->textInput()->label('Трейлер') ?>

    



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>