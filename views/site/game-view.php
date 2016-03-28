<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Game;


$id = $id-1;
$games = Game::find($id)->All();
$this->title = $games[$id]->game_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<h1 class="text-center"><? echo $games[$id]->game_name?></h1>
	<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 clearfix">

  	
  	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 clearfix">
  	<img src="<? echo $games[$id]->game_poster?>" width="225" height="320" alt="..." title="<?echo $games[$id]->game_name;?>">
  	</div>
  	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 clearfix">
  	<h3 class="text-left">Дата выхода</h3>
  	<p class="text-left"><? echo $games[$id]->game_announce?> </p>
  	<h3 class="text-left">Разработчик</h3>
  	<p class="text-left"><? echo $games[$id]->game_dev?> </p>
  	<h3 class="text-left">Цена</h3>
  	<p class="text-left"><? echo $games[$id]->game_price?> руб.</p>
  	</div>
  	</div>
  	<div class="row">
  	<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

  	<h3 class="text-center">Описание</h3>
  	<p><? echo $games[$id]->game_desc?> </p>

</div>
</div>
 </div>
