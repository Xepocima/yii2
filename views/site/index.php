<?php
use app\models\Game;
/* @var $this yii\web\View */
 
$this->title = 'KaKTyC';
?>
<div class="site-index">

    <div class="container-fluid">

        <div class="row">

<? 

     /* $games = Game::find('game_name')->All();
      foreach ($games as $game)
      {
        echo  '<li>',$game->game_name, '</li>';
      }*/

      $i = 1;
      $posters = Game::find()->All();
      foreach ($posters as $poster)
      {
        echo  '<div class="col-xs-6 col-md-4 col-sm-4 col-lg-3 clearfix"><a href="',
        Yii::$app->urlManager->createUrl(['site/about_game/', 'id' => $poster->game_id]),
        '" class="thumbnail"> <img src="',$poster->game_poster,
         '"width="225" height="320" alt="..." title="'; echo $poster->game_name; echo '"></a></div>';
        $i++;
      }
    
      ?>
            
        </div>

    </div>
</div>
