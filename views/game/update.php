<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = 'Изменить: ' . $model->game_name;
$this->params['breadcrumbs'][] = ['label' => 'Игры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->game_name, 'url' => ['view', 'id' => $model->game_id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
         'model' => $model, 'trailers'=>$trailers ,'screenshot'=>$screenshot, 'genre'=>$genre,
    ]) ?>

</div>
