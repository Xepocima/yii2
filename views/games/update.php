<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Games */

$this->title = 'Update Games: ' . $model->games_id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->games_id, 'url' => ['view', 'id' => $model->games_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="games-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
