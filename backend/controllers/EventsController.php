<?php

namespace backend\controllers;

use Yii;
use common\lib\FrontlogBase;
use common\lib\FrontlogBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\models\Jobposition;
use common\lib\CompanyBase;
use yii\filters\VerbFilter;

/**
 * EventsController implements the CRUD actions for FrontlogBase model.
 */
class EventsController extends Controller
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
     * Lists all FrontlogBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new FrontlogBaseSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
    	$list = EventsController::getLastEvents();
        
        return $this->render('index', [
            'logList' => $list,
        ]);
    }

    public function actionNextlog($lastid)
    {
        
    	$list = EventsController::getLastEvents($lastid);
        
    	header('Content-type: application/json');
    	$this->layout=false;
    	
    	echo json_encode($list);
      	exit;
    }

/**
     * Displays a single FrontlogBase model.
     * @param integer $id
     * @param integer $userid
     * @return mixed
     */
    public function actionView($id, $userid)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $userid),
        ]);
    }

    /**
     * Creates a new FrontlogBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontlogBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'userid' => $model->userid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FrontlogBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $userid
     * @return mixed
     */
    public function actionUpdate($id, $userid)
    {
        $model = $this->findModel($id, $userid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'userid' => $model->userid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FrontlogBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $userid
     * @return mixed
     */
    public function actionDelete($id, $userid)
    {
        $this->findModel($id, $userid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FrontlogBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $userid
     * @return FrontlogBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $userid)
    {
        if (($model = FrontlogBase::findOne(['id' => $id, 'userid' => $userid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public static function getLastEvents($lastid = 0)
    {
    	$formatter = \Yii::$app->formatter;
    	$formatter->timeZone = 'UTC';
    	//$formatter->timeZone = 'Europe/Berlin';
    	
    	$logModels = FrontlogBase::find()->where(['>', 'id', $lastid])->orderBy(['logdate' => SORT_ASC])->all();
    	$list = array();
    	foreach ($logModels as $logModel)
    	{
    		$descparts = explode(':', $logModel->logdesc);
    	
    		$desc = $descparts[0];
    		//$desc = str_replace('Job', 'Die Stelle ', $desc);
    		if($logModel->iscandidate == 1)
    		{
    			$user = $logModel->user->lname . ', ' . $logModel->user->fname;
    			$userurl = Url::to(['candidate/view' , 'id' => $logModel->userid]);
    			$logdate = $formatter->asDate($logModel->logdate, 'php:d.m.Y H:i');
    		}
    		else
    		{
    			$user = $logModel->user->lname . ', ' . $logModel->user->fname;
    			$userurl = Url::to(['pdt/view' , 'id' => $logModel->userid]);
    			$logdate = $formatter->asDate($logModel->logdate, 'php:d.m.Y H:i');
    		}
    	
    		$user = '<a href="' . $userurl . '" target="_blank">' . $user . '</a>';
    		if($desc == 'JobFav' || $desc == 'JobApply')
    		{
    			$stelleModel = Jobposition::findOne(['id' => $descparts[1]]);
    			if($stelleModel){
    			    $stelleurl = Url::to(['jobpos/view' , 'id' => $stelleModel->id]);
    			    $stelle = '<a href="' . $stelleurl . '" target="_blank">' . $stelleModel->title . '</a>';
    			    
    			    $desc = str_replace('JobFav', 'Die Stelle (' . $stelle . ') wurde von (' . $user . ')  am ' . $logdate . ' zum Favorit addiert', $desc);
    			    $desc = str_replace('JobApply', 'Die Stelle (' . $stelle . ') wurde von (' . $user . ') am ' . $logdate . ' beworben', $desc);    			  
    			}
    			else {
    			    $logModel->delete();
    			    continue;
    			}
    		}
    		if($desc == 'Register')
    		{
    			if($logModel->iscandidate == 0)
    			{
    				$companyModel = CompanyBase::findOne(['id' => $descparts[2]]);
    				if($companyModel){
    				    $companyurl = Url::to(['company/view' , 'id' => $companyModel->id]);
    				    $company = '<a href="' . $companyurl . '" target="_blank">' . $companyModel->companyname . '</a>';
    				}
    				else {
    				    $logModel->delete();
    				    continue;
    				}
    			}
    			$desc = 'Register ' . ($logModel->iscandidate == 1 ? 'Berwerber ' . $user . ' am ' . $logdate : 'Unternehmer ' . $user . ' Unternehmer ' . $company . ' am ' . $logdate);
    	
    		}
    		
    		$list[] = ['desc' => $desc , 'id' => $logModel->id];
    	}
    	
    	return $list;
    }
}
