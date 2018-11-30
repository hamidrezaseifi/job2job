<?php

namespace backend\controllers;

use Yii;
use common\lib\UsergroupBase;
use common\lib\UsergroupSearchBase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\lib\UsergroupnavgationBase;
use common\lib\NavigationBase;

/**
 * UsergroupController implements the CRUD actions for UsergroupBase model.
 */
class UsergroupController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UsergroupBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsergroupSearchBase();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsergroupBase model.
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
     * Creates a new UsergroupBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsergroupBase();
        $model->status = 1;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
        	
        	$status_list = array();
        	$status_list[1] = UsergroupBase::statusTitle(1);
        	$status_list[2] = UsergroupBase::statusTitle(2);
        	$status_list[3] = UsergroupBase::statusTitle(3);
        	 
            return $this->render('create', [
                'model' => $model,
                'status_list' => $status_list,
            ]);
        }
    }

    /**
     * Updates an existing UsergroupBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $postdata = Yii::$app->request->post();

        if ($model->load($postdata) && $model->save()) {
        	
        	UsergroupnavgationBase::deleteAll(['groupid' => $id]);
        	
        	
        	
        	$allnav = NavigationBase::allID();
        	
        	foreach ($allnav as $navid)
        	{
        		$ngmodel = new UsergroupnavgationBase();
        		$ngmodel->groupid = $id;
        		$ngmodel->navigationid = $navid;
        		$ngmodel->status = 1;
        		
        		$hasaccess= false;
        		if(isset($postdata['navaccessread'][$navid]))
        		{
        			$ngmodel->readright = 1;
        			$hasaccess = true;
        		}
        		if(isset($postdata['navaccessedit'][$navid]))
        		{
        			$ngmodel->editright = 1;
        			$hasaccess = true;
        		}
        		if(isset($postdata['navaccessdelete'][$navid]))
        		{
        			$ngmodel->deleteright = 1;
        			$hasaccess = true;
        		}
        		if(isset($postdata['navaccessprint'][$navid]))
        		{
        			$ngmodel->printright = 1;
        			$hasaccess = true;
        		}
        		if($hasaccess)
        		{
        			$ngmodel->save();
        		}
        	}
        	
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

        	$status_list = array();
        	$status_list[1] = UsergroupBase::statusTitle(1);
        	$status_list[2] = UsergroupBase::statusTitle(2);
        	$status_list[3] = UsergroupBase::statusTitle(3);
        	 
        	return $this->render('update', [
                'model' => $model,
                'status_list' => $status_list,
        	]);
        }
    }

    /**
     * Deletes an existing UsergroupBase model.
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
     * Finds the UsergroupBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsergroupBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsergroupBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
