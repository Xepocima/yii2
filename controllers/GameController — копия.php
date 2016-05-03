<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\Games;
use app\models\Genre;
use app\models\Trailers;
use app\models\Screenshots;
use app\models\GameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
            ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Game();
        $trailers = [new Trailers()]; // Добавить трейлер
        $screenshot = [new Screenshots()]; // Добавить скриншот
        $genres = [new Games()]; // Добавить жанры
        $genre = [new Genre()]; // Список жанров
        
        $arr_gnr = [];
        $arr_scr = [];
        $arr_trl = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $data = Yii::$app->request->post('Screenshots');
            $genrs = Yii::$app->request->post('Genre');
            $trlrs = Yii::$app->request->post('Trailers');

            /*
                        print($genrs[genre_id][0]);
            */

                        foreach ($genrs as $key) {
                            $genre[] = Genre::findOne(['genre_name' => $key->genre_name,]);
                        }



                        foreach ($data[screensh_path] as $key) {
                          $arr_scr[]=$key;
                      }
                      foreach ($genrs[genre_id] as $key) {
                          $arr_gnr[]=$key;
                      }
                      foreach ($trlrs[trailer_path] as $key) {
                          $arr_trl[]=$key;
                      }
           /* print_r($trlrs);
           die();*/

           foreach (array_keys($data[screensh_path]) as $index) {
            $screenshot[$index] = new Screenshots();
            $screenshot[$index]->screensh_path = $arr_scr[$index];
            $screenshot[$index]->game_id = $model->game_id;
              if($screenshot[$index]->validate()){
                $screenshot[$index]->save();
            }else{
                print_r($screenshot->errors);
                die();
            }

        }
        foreach (array_keys($genrs[genre_id]) as $index) {
            $genres[$index] = new Games();
            $genres[$index]->genre_id = $arr_gnr[$index];
            $genres[$index]->game_id = $model->game_id;
              if($genres[$index]->validate()){
                $genres[$index]->save();
            }else{
                print_r($genres->errors);
                die();
            }

        }
        foreach (array_keys($trlrs[trailer_path]) as $index) {
            $trailers[$index] = new Trailers();
            $trailers[$index]->trailer_path = $arr_trl[$index];
            $trailers[$index]->game_id = $model->game_id;
            if($trailers[$index]->validate()){
                $trailers[$index]->save();
            }else{
                print_r($trailers->errors);
                die();
            }
            
            

        }

        return $this->redirect(['view', 'id' => $model->game_id]);

    } else {
        return $this->render('create', [
            'model' => $model, 'trailers' => $trailers,'screenshot' => $screenshot, 'genre' => $genre,
            ]);
    }
}

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        /* $model = Game::findOne($id);
         $trailers = Trailers::find()->where([game_id=>$id])->all();


        if ($model->load(Yii::$app->request->post())) {
            foreach ($trailers as $key) {
                $key->load(Yii::$app->request->post());
            }
           
            $isValid = $model->validate();
            foreach ($trailers as $key) {
               $isValid = $key->validate() && $isValid;
            }

            if ($isValid) {
                $model->save();
                foreach ($trailers as $key) {
                   $key->save();

                }
                
                return $this->redirect(['game/view', 'id' => $id]);
            }
        } else {
            print('123');
            return $this->render('update', [
                'model' => $model, 'trailers' => $trailers,
                ]);
}*/

		 $model = $this->findModel($id);
         $trailers = Trailers::find()->where([game_id=>$id])->all(); // 2 объекта

         if ($model->load(Yii::$app->request->post()) ) {
            foreach ($trailers as $key) {
                $key->load(Yii::$app->request->post());
                //$key->save();
            }
            //$trailers->load(Yii::$app->request->post());//Добавляет одно поле
            if($model->validate()){
                $model->save();               
            }else{
                print_r($key->errors);
                die();
            }

            foreach ($trailers as $key) {
                if($key->validate()){
                $key->save(false);
            }else{
                //print_r($key);
                print_r($key->errors);
                die();
            }
            }
            return $this->redirect(['view', 'id' => $model->game_id]);
        } else {
            return $this->render('update', [
                'model' => $model,'trailers' => $trailers,
                ]);
        }
    }

    /**
     * Deletes an existing Game model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
