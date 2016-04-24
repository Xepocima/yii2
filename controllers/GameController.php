<?php

namespace app\controllers;

use Yii;
use app\models\Game;
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
        $trailer = new Trailers(); // Добавить трейлер
        $screenshot = new Screenshots(); // Добавить трейлер

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              //$trailer->trailer_id = 2;
            //print_r(Yii::$app->request->post('Screenshots'));
           $info1 = Yii::$app->request->post('Screenshots');
           $info2 = Yii::$app->request->post('Trailers');
        
           $trailer->trailer_path = $info2['trailer_path'];
           $trailer->game_id = $model->game_id;
           $trailer->save();

           $screenshot->screensh_path = $info1['screensh_path'];
           $screenshot->game_id = $model->game_id;
           $screenshot->save();
            //print_r($x);
            //die();*/
            
            
            return $this->redirect(['view', 'id' => $model->game_id]);
            
        } else {
            return $this->render('create', [
                'model' => $model, 'trailer' => $trailer,'screenshot' => $screenshot, 
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->game_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
