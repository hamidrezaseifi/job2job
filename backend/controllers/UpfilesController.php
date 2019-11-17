<?php

namespace backend\controllers;

use Yii;
use common\lib\UploadedfilesBase;
use common\lib\UploadedfilesBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UpfilesController implements the CRUD actions for UploadedfilesBase model.
 */
class UpfilesController extends Controller
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
     * Lists all UploadedfilesBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadedfilesBaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadedfilesBase model.
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
     * Creates a new UploadedfilesBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UploadedfilesBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UploadedfilesBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UploadedfilesBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$file = $this->findModel($id);
    	
    	$filepath = $_SERVER['DOCUMENT_ROOT'] .  $file->file;
    	$filepath = str_replace('//', '/', $filepath);
    	if(file_exists($filepath)){
    	    unlink($filepath);
    	}
    	
    	
        $file->delete();        

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing UploadedfilesBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteall()
    {
    	if(isset($_POST['list']) && is_array($_POST['list']))
    	{
    		foreach ($_POST['list'] as $id)
    		{
    			$this->actionDelete($id);
    		}
    		echo 'ok';
    	}
    	else
    	{
    		echo 'Invalid Data!';
    	}
    	
    	exit;
    }
    
    /**
     * Deletes an existing UploadedfilesBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionApproveall()
    {
    	if(isset($_POST['list']) && is_array($_POST['list']))
    	{
    		//print_r($_POST['list']);
    		foreach ($_POST['list'] as $id)
    		{
    			$this->actionApprove($id);
    		}
    		echo 'ok';
    	}
    	else
    	{
    		echo 'Invalid Data!';
    	}
    	
    	exit;
    }
    
/**
     * Deletes an existing UploadedfilesBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save(false);

        return $this->redirect(['index']);
    }

	/**
     * Finds the UploadedfilesBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadedfilesBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UploadedfilesBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
