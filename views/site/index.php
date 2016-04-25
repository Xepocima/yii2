<?php
use app\models\Game;
use app\models\Trailers;
/* @var $this yii\web\View */
 
$this->title = 'KaKTyC';
?>
<div class="site-index">

    <div class="container-fluid">

        <div class="row">

<? 

      /*$games = Game::find('game_name')->All();
      foreach ($games as $game)
      {
        echo  '<li><a href=',$game->game_id,'>',$game->game_name, ' </a></li>';
      }*/

   /*   $fnd = Game::find()->where(['game_id'=>23])->All();
      $tr = Trailers::find()->where(['game_id'=>23])->All();

		echo  '<a href=',$fnd[0]->game_id,'>',$fnd[0]->game_name, '/ </a></li>';
		echo  'Desc: ',$fnd[0]->game_desc,' Dev',$fnd[0]->game_dev;
		echo '<p>SCR <img scr="',$fnd[0]->game_poster,'"></p>';
		echo '<p>Trailers:',$tr[0]->trailer_path ,'</p>';

		die();*/
      

      $i = 1;
      $posters = Game::find()->All();
      foreach ($posters as $poster)
      {
        echo  '<div class="col-xs-6 col-md-4 col-sm-4 col-lg-3 clearfix"><a href="',
        Yii::$app->urlManager->createUrl(['site/about_game/', 'id' => $poster->game_name]),
        '" class="thumbnail"> <img src="',$poster->game_poster,
         '"width="225" height="320" alt="..." title="'; echo $poster->game_name; echo '"></a></div>';
        $i++;
      }
    
      ?>
            
        </div>

    </div>
</div>
