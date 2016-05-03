<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = $model->game_name;
$this->params['breadcrumbs'][] = ['label' => 'Game', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->game_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->game_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'game_name',
            'game_desc:ntext',
            'game_dev',
            'game_announce',
            'game_price',
            'game_poster:image',
        ],
    ]) ?>
    <?php foreach ($trailers as $key) { ?>
    <?= DetailView::widget([
        'model' => $key,
        'attributes' => [
            'trailer_path:ntext',     
        ],
    ]) ?>
    <?php } ?>
    <?php foreach ($screenshots as $key) { ?>
  
    <?= DetailView::widget([
        'model' => $key,
        'attributes' => [
            'screensh_path:image',     
        ],
    ]) ?>
    <?php } ?>
    <?php foreach ($genres as $key) { ?>
    <?= DetailView::widget([
        'model' => $key,
        'attributes' => [
            'genre_name:ntext',     
        ],
    ]) ?>
    <?php } ?>


</div>
