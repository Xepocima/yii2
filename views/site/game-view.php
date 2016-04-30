<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Game;
use app\models\Screenshots;
use app\models\Trailers;
use app\models\Comments;
use app\models\Games;
use app\models\Genre;

$games = Game::find()->where(['game_name'=>$id])->All();

$genresID = Games::find()->where(['game_id'=>$games[0]->game_id])->All();

foreach ($genresID as $key) {
 $genre[] = Genre::find()
 ->where(['genre_id' => $key->genre_id])
 ->one();
}


$scren = Screenshots::find()->where(['game_id'=>$games[0]->game_id])->All();
$trailers = Trailers::find()->where(['game_id'=>$games[0]->game_id])->All();
$comm = Comments::find()->where(['game_id'=>$games[0]->game_id])->All();


$this->title = $games[0]->game_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<h1 class="text-center"><? echo $games[0]->game_name?></h1>
	<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 clearfix">


   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 clearfix">
     <img src="<? echo $games[0]->game_poster?>" width="225" height="320" alt="..." title="<?echo $games[0]->game_name;?>">
   </div>
   <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 clearfix">
     <h3 class="text-left">Дата выхода</h3>
     <p class="text-left"><? echo $games[0]->game_announce?> </p>


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
  <p class="text-left"><? echo $games[0]->game_dev?> </p>
  <h3 class="text-left">Цена</h3>
  <p class="text-left"><? 
    if($games[0]->game_price != 0){
      echo '$'.$games[0]->game_price;
    }else{
      echo 'Free';
    }

    ?></p>
  </div>
</div>
<div class="row">
 <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

   <h3 class="text-center">Описание</h3>
   <p><? echo $games[0]->game_desc?> </p>
 </div>

 <? if(!empty($scren)){echo '
 <div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

    <h3 class="text-center">Скриншоты</h3>';
    foreach($scren as $key){
      echo '<a href='.$key->screensh_path.'><img src='.$key->screensh_path.' width="580" height="410" class="img-thumbnail"></img></a>';

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

     echo '<iframe class="embed-responsive-item" width="580" height="410" src="'.
     $key->trailer_path.
     '" frameborder="0" allowfullscreen ></iframe>';
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


      echo '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">'.$key->comm_auth.'</h3></div>';
      echo '<div class="panel-body">'.$key->comm_desc.'</div></div>';
    }
    echo '
  </div>
</div>';
}?>

</div>
