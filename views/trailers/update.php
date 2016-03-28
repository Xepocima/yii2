<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trailers */

$this->title = 'Update Trailers: ' . $model->trailer_id;
$this->params['breadcrumbs'][] = ['label' => 'Trailers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trailer_id, 'url' => ['view', 'id' => $model->trailer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trailers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
