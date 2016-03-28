<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScreenshotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Screenshots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenshots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Screenshots', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'screensh_id',
            'screensh_path:ntext',
            'game_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
