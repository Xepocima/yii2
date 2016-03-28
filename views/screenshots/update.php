<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Screenshots */

$this->title = 'Update Screenshots: ' . $model->screensh_id;
$this->params['breadcrumbs'][] = ['label' => 'Screenshots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->screensh_id, 'url' => ['view', 'id' => $model->screensh_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="screenshots-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
