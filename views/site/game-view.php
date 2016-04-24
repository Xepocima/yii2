<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Game;
use app\models\Screenshots;
use app\models\Trailers;
use app\models\Comments;
use app\models\Games;
use app\models\Genre;


$id = $id-1;
$games = Game::find($id)->All();

$genresID = Games::find()->where(['game_id'=>$id+1])->All();

foreach ($genresID as $key) {
 $genre[] = Genre::find()
 ->where(['genre_id' => $key->genre_id])
 ->one();
}



$scren = Screenshots::find()->where(['game_id'=>$id+1])->All();
$trailers = Trailers::find()->where(['game_id'=>$id+1])->All();
$comm = Comments::find()->where(['game_id'=>$id+1])->All();



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


     <? if(!empty($genre)){echo '
     <h3 class="text-left">Жанры</h3>
     <p class="text-left">';
      foreach ($genre as $key) {
        echo $key->genre_name.' ';
      }
      echo '
    </p>';
  }
  ?>



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

 <? if(!empty($scren)){echo '
 <div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

    <h3 class="text-center">Скриншоты</h3>';
    foreach($scren as $key){
      echo '<img src='.$key->screensh_path.'></img>';
    }
    echo '
  </div>
</div>
';}
?>
<? if(!empty($trailers)){echo '
<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

    <h3 class="text-center">Трейлеры</h3>';
    foreach($trailers as $key){

     echo $key->trailer_path;
   }
   echo '
 </div>
</div>';
}
?>

<? if(!empty($comm)){echo '
<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

    <h3 class="text-center">Отзывы</h3>';
    foreach($comm as $key){
      
      echo '<p>'.$key->comm_auth.'</p>';
      echo '<p>'.$key->comm_desc.'</p>';
    }
    echo '
  </div>
</div>';
}?>

</div>
