<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Genre;

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-game">

    
      <? $genres = Genre::find()->All();
      foreach ($genres as $genr)
      {
      	echo  '<li>',$genr->genre_name,' - ',$genr->genre_desc,'</li>';
  	  }?> 

 </div>
