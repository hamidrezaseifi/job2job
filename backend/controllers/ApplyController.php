<?php

namespace backend\controllers;

use Yii;
use common\lib\CandidatejobapplyBase;
use common\lib\CandidatejobapplyBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\lib\CompanyBase;
use common\lib\CandidateBase;
use common\lib\JobpositionBase;

/**
 * ApplyController implements the CRUD actions for CandidatejobapplyBase model.
 */
class ApplyController extends Controller
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
     * Lists all CandidatejobapplyBase models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$status = isset($_GET['status']) ? $_GET['status'] : -1;
    	$candidateid = isset($_GET['candidate']) ? $_GET['candidate'] : -1;
    	$jobposid = isset($_GET['jobpos']) ? $_GET['jobpos'] : -1;
    	$companyid = isset($_GET['company']) ? $_GET['company'] : -1;
    	 
    	$candidatename = '';
    	$jobpostitle = '';
    	$companyname = '';
    	 
        $searchModel = new CandidatejobapplyBaseSearch();
        if($status > -1)
        {
        	$searchModel->status = $status;
        }
        if($candidateid > 0)
        {
        	$searchModel->userid = $candidateid;
        	
        	$candidatename = CandidateBase::findOne(['userid' => $candidateid])->fullname();
        }
        if($jobposid > 0)
        {
        	$searchModel->jobposid = $jobposid;
        	
        	$jobpostitle = JobpositionBase::findOne(['id' => $jobposid])->title;
        }
        if($companyid > 0)
        {
        	$searchModel->companyid = $companyid;
        	
        	$companyname = CompanyBase::findOne(['id' => $companyid])->companyname;
        }
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' 		=> $searchModel,
            'dataProvider' 		=> $dataProvider,
            'status' 			=> $status,
            'candidateid' 		=> $candidateid,
            'jobposid' 			=> $jobposid,
            'companyid' 		=> $companyid,
            'candidatename' 	=> $candidatename,
            'jobpostitle' 		=> $jobpostitle,
            'companyname' 		=> $companyname,
        ]);
    }

    /**
     * Displays a single CandidatejobapplyBase model.
     * @param integer $userid
     * @param integer $jobposid
     * @return mixed
     */
    public function actionView($userid, $jobposid)
    {
        return $this->render('view', [
            'model' => $this->findModel($userid, $jobposid),
        ]);
    }

    /**
     * Creates a new CandidatejobapplyBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CandidatejobapplyBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'jobposid' => $model->jobposid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CandidatejobapplyBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $userid
     * @param integer $jobposid
     * @return mixed
     */
    public function actionUpdate($userid, $jobposid)
    {
        $model = $this->findModel($userid, $jobposid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userid' => $model->userid, 'jobposid' => $model->jobposid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CandidatejobapplyBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $userid
     * @param integer $jobposid
     * @return mixed
     */
    public function actionDelete($userid, $jobposid)
    {
    	$this->findModel($userid, $jobposid)->delete();
    
    	return $this->redirect(['index']);
    }

    /**
     * Deletes an existing CandidatejobapplyBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $userid
     * @param integer $jobposid
     * @return mixed
     */
    public function actionArchive($userid, $jobposid, $status)
    {
    	$model = $this->findModel($userid, $jobposid);
    
    	$model->status = 1;
    	$model->save(false);
    	
    	return $this->redirect(['index']);
    }
    
    /**
     * Finds the CandidatejobapplyBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $userid
     * @param integer $jobposid
     * @return CandidatejobapplyBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userid, $jobposid)
    {
        if (($model = CandidatejobapplyBase::findOne(['userid' => $userid, 'jobposid' => $jobposid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
