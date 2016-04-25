<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'game_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'game_dev')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'game_announce')->textInput() ?>

    <?= $form->field($model, 'game_price')->textInput() ?>

    <?= $form->field($model, 'game_poster')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
