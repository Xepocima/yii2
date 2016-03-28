<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Screenshots */

$this->title = 'Create Screenshots';
$this->params['breadcrumbs'][] = ['label' => 'Screenshots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenshots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
