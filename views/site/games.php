<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Game;

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-game">

    
      <? $games = Game::find('game_name')->All();
      foreach ($games as $game)
      {
      	echo  '<li>',$game->game_name, '</li>';
  	  }?> 

 </div>
