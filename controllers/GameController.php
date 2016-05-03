<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\Games;
use app\models\Genre;
use app\models\Trailers;
use app\models\Screenshots;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\GameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'delete' => ['POST'],
        ],
        ],
        ];
    }

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Displays a single Game model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         $model = $this->findModel($id);
         $addresses = Trailers::find()->where(['game_id'=>$model->game_id])->All();
         $modelScreenshots = Screenshots::find()->where(['game_id'=>$model->game_id])->All();
         $modelGames = Games::find()->where(['game_id'=>$model->game_id])->All();

         $genresID = Games::find()->where(['game_id'=>$model->game_id])->All();

foreach ($genresID as $key) {
 $genre[] = Genre::find()
 ->where(['genre_id' => $key->genre_id])
 ->one();
}
        
        return $this->render('view', [
            'model' => $model,
            'trailers' => $addresses,
            'screenshots' => $modelScreenshots,
            'genres' => $genre,

        ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelCustomer = new Game;
        $modelsAddress = [new Trailers];
        $modelScreenshots = [new Screenshots];

        $genres = [new Games()]; // Добавить жанры
        $genre = [new Genre()]; // Список жанров

        $arr_trl = [];
        $arr_scr = [];
        $arr_gnr = [];



        if ($modelCustomer->load(Yii::$app->request->post()) && $modelCustomer->save()) {

        	$trlrs = Yii::$app->request->post('Trailers');
            $scrsh = Yii::$app->request->post('Screenshots');
            $genrs = Yii::$app->request->post('Games');
        	/*print_r($modelCustomer);
        	die();*/

           /* print_r($genrs[1][genre_id]);
           die();*/
           /* foreach ($genrs as $key) {
                $genre[] = Genre::findOne(['genre_id' => $key->genre_id,]);
            }*/

            foreach ( $trlrs as $key) {
              $arr_trl[] = $key[trailer_path];
          }
          foreach ( $scrsh as $key) {
              $arr_scr[] = $key[screensh_path];
          }


         /* foreach ($genrs as $key) {
              $arr_gnr[]=$key;
          }*/

         /* print_r($genrs);
         die();*/

         for ($index=0; $index <count(array_keys($genrs)) ; $index++) { 
             $genres[$index] = new Games();
             $genres[$index]->genre_id = $genrs[$index][genre_id];
             $genres[$index]->game_id = $modelCustomer->game_id;
             $genres[$index]->save(false);
         }


            //print_r($trlrs);
         /*   print('                               ');
            print_r($arr_scr);

            die();*/
            /* $modelsAddress = Model::createMultiple(Trailers::classname());*/

            for ($index=0; $index < count(array_keys($trlrs)); $index++) { 
                $modelsAddress[$index] = new Trailers();
                $modelsAddress[$index]->trailer_path = $arr_trl[$index];
                $modelsAddress[$index]->game_id = $modelCustomer->game_id;
                $modelsAddress[$index]->save(false);
            }

         /*   print_r(array_keys($trlrs));
            print_r(count(array_keys($scrsh)));
            die();*/

         /*   foreach (array_keys($scrsh) as $index2) {
            $modelScreenshots[$index2] = new Screenshots();
            $modelScreenshots[$index2]->screensh_path = $arr_scr[$index2]; // err
            $modelScreenshots[$index2]->game_id = $modelCustomer->game_id;
            $modelScreenshots[$index2]->save(false);
        }*/
        for ($i=0; $i < count(array_keys($scrsh)); $i++) { 
            $modelScreenshots[$i] = new Screenshots();
            $modelScreenshots[$i]->screensh_path = $arr_scr[$i]; // err
            $modelScreenshots[$i]->game_id = $modelCustomer->game_id;
            $modelScreenshots[$i]->save(false);
        }




           // Model::loadMultiple($modelsAddress, Yii::$app->request->post());

            // ajax validation
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ArrayHelper::merge(
                ActiveForm::validateMultiple($modelsAddress),
                ActiveForm::validateMultiple($modelScreenshots),
                ActiveForm::validate($modelCustomer)
                );
        }

            // validate all models
        $valid = $modelCustomer->validate();
            //$valid = Model::validateMultiple($modelsAddress) && $valid;

        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($flag = $modelCustomer->save(false)) {
                    foreach ($modelsAddress as $modelAddress) {
                        $modelAddress->game_id = $modelCustomer->game_id;
                        if (! ($flag = $modelAddress->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                foreach ($modelScreenshots as $modelScr) {
                    $modelScr->game_id = $modelCustomer->game_id;
                    if (! ($flag = $modelScr->save(false))) {
                        $transaction->rollBack();
                        break;
                    }
                }

                foreach ($genres as $modelScr) {
                    $modelScr->game_id = $modelCustomer->game_id;
                    if (! ($flag = $modelScr->save(false))) {
                        $transaction->rollBack();
                        break;
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $modelCustomer->game_id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }

    return $this->render('create', [
        'model' => $modelCustomer,
        'trailers' => (empty($modelsAddress)) ? [new Trailers] : $modelsAddress,
        'screenshot' => (empty($modelScreenshots)) ? [new Screenshots] : $modelScreenshots,
        'genre' => (empty($genres)) ? [new Games] : $genres,
        ]);
}

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {


        $modelCustomer = $this->findModel($id);
        $modelsAddress = Trailers::find()->where(['game_id'=>$modelCustomer->game_id])->All();
        $modelScreenshots = Screenshots::find()->where(['game_id'=>$modelCustomer->game_id])->All();
        $modelGames = Games::find()->where(['game_id'=>$modelCustomer->game_id])->All();

       $arr_trl = [];
       $arr_scr = [];
       $arr_gnrs = [];

       if ($modelCustomer->load(Yii::$app->request->post()) && $modelCustomer->save()) {



           $trlrs = Yii::$app->request->post('Trailers');
           $scrnsh = Yii::$app->request->post('Screenshots');
           $genrs = Yii::$app->request->post('Games');


            $oldIDs = ArrayHelper::map($modelsAddress, 'trailer_id', 'trailer_id');
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'trailer_id', 'trailer_id')));

            $oldIDs2 = ArrayHelper::map($modelScreenshots, 'screensh_id', 'screensh_id');
            $deletedIDs2 = array_diff($oldIDs, array_filter(ArrayHelper::map($modelScreenshots, 'screensh_id', 'screensh_id')));

            $oldIDs3 = ArrayHelper::map($modelGames, 'games_id', 'games_id');
            $deletedIDs3 = array_diff($oldIDs, array_filter(ArrayHelper::map($modelGames, 'games_id', 'games_id')));
            $arr_trl_new = [];
            $arr_scr_new = [];
            $arr_gnr_new = [];

            $find_ID = [];
            $arr_IDS=[];

            $find_ID_S = [];
            $arr_IDS_screen=[];

            $find_ID_G = [];
            $arr_IDS_genre=[];
           
           foreach ( $trlrs as $key) {
                $arr_IDS[] = $key[trailer_id];  
           }
           for ($i=0; $i < count($modelsAddress); $i++) { 
              if($modelsAddress[$i][trailer_id] != $arr_IDS[$i]){
                   $find_ID[] = $modelsAddress[$i][trailer_id];
              }
           }
            foreach ( $trlrs as $key) {
                if(!empty($key[trailer_id])){
                    $arr_trl[] = $key[trailer_path];
                }
                else{
                    $arr_trl_new[] = $key[trailer_path];
                }
            }

          foreach ( $scrnsh as $key) {
                $arr_IDS_screen[] = $key[screensh_id];  
           }
           for ($i=0; $i < count($modelScreenshots); $i++) { 
              if($modelScreenshots[$i][screensh_id] != $arr_IDS_screen[$i]){
                   $find_ID_S[] = $modelScreenshots[$i][screensh_id];
              }
           }
            foreach ( $scrnsh as $key) {
                if(!empty($key[screensh_id])){
                    $arr_scr[] = $key[screensh_path];
                }
                else{
                    $arr_scr_new[] = $key[screensh_path];
                }
            }

            /*________________________________________________________________________*/


            foreach ( $genrs as $key) {
                $arr_IDS_genre[] = $key[games_id];  
           }


           for ($i=0; $i < count($modelGames); $i++) { 
              if($modelGames[$i][games_id] != $arr_IDS_genre[$i]){
                   $find_ID_G[] = $modelGames[$i][games_id];
              }
           }

            foreach ( $genrs as $key) {
                if(!empty($key[games_id])){
                    $arr_gnrs[] = $key[genre_id];
                }
                else{
                    $arr_gnr_new[] = $key[genre_id];
                }
            }

/*___________________________________________________________________________________*/
    for ($index=0; $index < count($arr_gnrs); $index++) { 
       $modelGames[$index]->genre_id = $arr_gnrs[$index];
       $modelGames[$index]->game_id = $modelCustomer->game_id;
       $modelGames[$index]->save(false);
   }
   if(!empty($arr_gnr_new)){
       for ($index=0; $index < count($arr_gnr_new); $index++) { 
        $modelGames[$index] = new Games();
        $modelGames[$index]->genre_id = $arr_gnr_new[$index];
        $modelGames[$index]->game_id = $modelCustomer->game_id;
        $modelGames[$index]->save(false);
        }
    }


    for ($i=0; $i < count($find_ID_G); $i++) {
        $customer = Games::findOne($find_ID_G[$i]);
        $customer->delete(); 
    }


/*___________________________________________________________________________________*/

    for ($index=0; $index < count($arr_trl); $index++) { 
       $modelsAddress[$index]->trailer_path = $arr_trl[$index];
       $modelsAddress[$index]->game_id = $modelCustomer->game_id;
       $modelsAddress[$index]->save(false);
   }
   if(!empty($arr_trl_new)){
       for ($index=0; $index < count($arr_trl_new); $index++) { 
        $modelsAddress[$index] = new Trailers();
        $modelsAddress[$index]->trailer_path = $arr_trl_new[$index];
        $modelsAddress[$index]->game_id = $modelCustomer->game_id;
        $modelsAddress[$index]->save(false);
        }
    }


    for ($i=0; $i < count($find_ID); $i++) {
        $customer = Trailers::findOne($find_ID[$i]);
        $customer->delete(); 
    }

/*___________________________________________________________________________________*/

    for ($index=0; $index < count($arr_scr); $index++) { 
       $modelScreenshots[$index]->screensh_path = $arr_scr[$index];
       $modelScreenshots[$index]->game_id = $modelCustomer->game_id;
       $modelScreenshots[$index]->save(false);
   }
   if(!empty($arr_scr_new)){
       for ($index=0; $index < count($arr_scr_new); $index++) { 
        $modelScreenshots[$index] = new Screenshots();
        $modelScreenshots[$index]->screensh_path = $arr_scr_new[$index];
        $modelScreenshots[$index]->game_id = $modelCustomer->game_id;
        $modelScreenshots[$index]->save(false);
        }
    }


    for ($i=0; $i < count($find_ID_S); $i++) {
        $customer = Screenshots::findOne($find_ID_S[$i]);
        $customer->delete(); 
    }


/*___________________________________________________________________________________*/




           // Model::loadMultiple($modelsAddress, Yii::$app->request->post());

            // ajax validation
if (Yii::$app->request->isAjax) {
    Yii::$app->response->format = Response::FORMAT_JSON;
    return ArrayHelper::merge(
        ActiveForm::validateMultiple($modelGames),
        ActiveForm::validateMultiple($modelScreenshots),
        ActiveForm::validateMultiple($modelsAddress),
        ActiveForm::validate($modelCustomer)
        );
}

            // validate all models
$valid = $modelCustomer->validate();
            //$valid = Model::validateMultiple($modelsAddress) && $valid;

if ($valid) {
    $transaction = \Yii::$app->db->beginTransaction();
    try {
        if ($flag = $modelCustomer->save(false)) {
          if (!empty($deletedIDs)) {
            Trailers::deleteAll(['trailer_id' => $deletedIDs]);
        }
        foreach ($modelsAddress as $modelAddress) {
            $modelAddress->game_id = $modelCustomer->game_id;
            if (! ($flag = $modelAddress->save(false))) {
                $transaction->rollBack();
                break;
            }
        }
        if (!empty($deletedIDs2)) {
            Screenshots::deleteAll(['screensh_id' => $deletedIDs2]);
        }
        foreach ($modelScreenshots as $modelAddress) {
            $modelAddress->game_id = $modelCustomer->game_id;
            if (! ($flag = $modelAddress->save(false))) {
                $transaction->rollBack();
                break;
            }
        }

        if (!empty($deletedIDs3)) {
            Games::deleteAll(['games_id' => $deletedIDs3]);
        }
        foreach ($modelGames as $modelAddress) {
            $modelAddress->game_id = $modelCustomer->game_id;
            if (! ($flag = $modelAddress->save(false))) {
                $transaction->rollBack();
                break;
            }
        }
    }
    if ($flag) {
        $transaction->commit();
        return $this->redirect(['view', 'id' => $modelCustomer->game_id]);
    }
} catch (Exception $e) {
    $transaction->rollBack();
}
}
}

return $this->render('update', [
    'model' => $modelCustomer,
    'trailers' => (empty($modelsAddress)) ? [new Trailers] : $modelsAddress,
    'screenshot' => (empty($modelScreenshots)) ? [new Screenshots] : $modelScreenshots,
    'genre' => (empty($modelGames)) ? [new Games] : $modelGames,
    ]);
}


    /**
     * Deletes an existing Game model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = Trailers::find()->where(['game_id'=>$model->game_id])->All();
        $screenshots = Screenshots::find()->where(['game_id'=>$model->game_id])->All();
        $games = Games::find()->where(['game_id'=>$model->game_id])->All();
        /*print_r($name);
        die();*/
        foreach ($name as $key) {
            $key->delete();
        }
        foreach ($games as $key) {
            $key->delete();
        }
        foreach ($screenshots as $key) {
            $key->delete();
        }
        if ($model->delete()) {

            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }
    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
