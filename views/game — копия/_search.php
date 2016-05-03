<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'game_id') ?>

    <?= $form->field($model, 'game_name') ?>

    <?= $form->field($model, 'game_desc') ?>

    <?= $form->field($model, 'game_dev') ?>

    <?= $form->field($model, 'game_announce') ?>

    <?php // echo $form->field($model, 'game_price') ?>

    <?php // echo $form->field($model, 'game_poster') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
