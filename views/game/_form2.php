<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\widgets\MultipleInput;
use kartik\date\DatePicker;
use kartik\widgets\DateTimePicker;
use app\models\Genre;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

$genresID = Genre::find()->All();

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);

?>

<div class="game-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'game_name')->textInput(['maxlength' => true])->label('Название игры') ?>




        <?= $form->field($model, 'game_desc')->textarea(['rows' => 6])->label('Описание') ?>

        <?= $form->field($model, 'game_dev')->textInput(['maxlength' => true])->label('Разработчик') ?>

        <? echo $form->field($model, 'game_announce')->widget(DatePicker::className(), [
            'name' => 'dp',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
            ]
            ]);
            ?>

            <?= $form->field($model, 'game_price')->textInput()->label('Цена') ?>

            <?= $form->field($model, 'game_poster')->textInput()->label('Постер') ?>

           



<?php
    $items = ArrayHelper::map(Genre::find()->all(), 'genre_id', 'genre_name');
        ?>
 <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Жанры</h4></div>
        <div class="panel-body">
             <?php  if(!empty($genre)){
             DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper3', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $genre[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'genre_id',
                   
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($genre as $i => $modelAddress): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Жанры</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]games_id");
                            }
                        ?>
                       
                          <?= $form->field($modelAddress, "[{$i}]genre_id")->dropDownList($items); ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); }else{
                echo 'NO';
                }?>
        </div>
    </div>









    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Трейлеры</h4></div>
        <div class="panel-body">
             <?php  if(!empty($trailers)){
             DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $trailers[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'trailer_path',
                   
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($trailers as $i => $modelAddress): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Трейлеры</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]trailer_id");
                            }
                        ?>
                        <?= $form->field($modelAddress, "[{$i}]trailer_path")->textInput(['maxlength' => true]) ?>
                     
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); }else{
                echo 'NO';
                }?>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Скриншоты</h4></div>
        <div class="panel-body">
             <?php  if(!empty($screenshot)){
             DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper2', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $screenshot[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'screensh_path',
                   
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($screenshot as $i => $modelAddress): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Скриншот</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$i}]screensh_id");
                            }
                        ?>
                        <?= $form->field($modelAddress, "[{$i}]screensh_path")->textInput(['maxlength' => true]) ?>
                     
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); }else{
                echo 'NO';
                }?>
        </div>
    </div>
      




            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить игру' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
