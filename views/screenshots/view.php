<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Screenshots */

$this->title = $model->screensh_id;
$this->params['breadcrumbs'][] = ['label' => 'Screenshots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenshots-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->screensh_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->screensh_id], [
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
            'screensh_id',
            'screensh_path:ntext',
            'game_id',
        ],
    ]) ?>

</div>
