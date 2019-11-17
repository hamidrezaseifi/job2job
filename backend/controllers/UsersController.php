<?php

namespace backend\controllers;

use Yii;
use common\lib\UsersBase;
use common\lib\UsersSearchBase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\lib\UsergroupBase;
use yii\helpers\ArrayHelper;
use common\lib\UserpermissionBase;
use common\lib\BackendUserModel;
use common\helper\BrainHelper;

/**
 * UsersController implements the CRUD actions for UsersBase model.
 */
class UsersController extends Controller
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
     * Lists all UsersBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearchBase();
        $searchModel->usertype = UsersBase::UserTypeBackend;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
        	'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersBase model.
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
     * Creates a new UsersBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersBase();
        $model->status = 1;
        $model->usertype = UsersBase::UserTypeBackend;
        $model->permission = 2;
        $model->auth_key = '-';
        
        $message = '';
        $postdata = Yii::$app->request->post();
        
        if(count($postdata))
        {
        	$postdata['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($postdata['UsersBase']['password_hash']);
        	$postdata['UsersBase']['createdate'] = date('Y-m-d');
        	$postdata['UsersBase']['updatedate'] = date('Y-m-d');
        	$postdata['UsersBase']['usertype'] = UsersBase::UserTypeBackend;
        	$postdata['UsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['UsersBase']['bdate']);
        	$postdata['UsersBase']['bdate'] = isset($postdata['UsersBase']['bdate']) ? $postdata['UsersBase']['bdate'] : '1970-01-01';
        	
	        if ($model->load($postdata)) {
	        	
	        	if($model->save())
	        	{
	            	return $this->redirect(['view', 'id' => $model->id]);
	        	}
	        	else 
	        		$message = 'Error in Save! errors : ';
	        } 
	        else
	        	$message = 'Error in Load! errors : ';
	        
	        foreach ($model->errors as $err)
	        {
	        	$message .= implode(' , ', $err);
	        }
        }
        
        $status_list = array();
        $status_list[1] = UsersBase::statusTitle(1);
        $status_list[2] = UsersBase::statusTitle(2);
        $status_list[3] = UsersBase::statusTitle(3);
        
        $usertype_list = array();
        $usertype_list[1] = UsersBase::userTypeTitle(1);
        $usertype_list[2] = UsersBase::userTypeTitle(2);
        $usertype_list[3] = UsersBase::userTypeTitle(3);
        
        $groupData = UsergroupBase::find()->select(['id' , 'title'])->where(['status' => 1])->all();
        $grouplist = ArrayHelper::map($groupData, 'id', 'title');
        
        $permissionData = UserpermissionBase::find()->select(['id' , 'title'])->where(['status' => 1])->all();
        $permissionlist = ArrayHelper::map($permissionData, 'id', 'title');
        
        return $this->render('create', [
        		'model' => $model,
        		'groups_list' 		=> $grouplist,
        		'permissions_list' 	=> $permissionlist,
        		'status_list' 		=> $status_list,
        		'usertype_list' 	=> $usertype_list,
        		'message' => $message,
        ]);
    }

    /**
     * Updates an existing UsersBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->usertype = UsersBase::UserTypeBackend;
        $message = '';
        
        $postdata = $_POST;
        
        if(count($postdata))
        {
        	$postdata['UsersBase']['updatedate'] = date('y-m-d H:i:s');
        	$postdata['UsersBase']['usertype'] = UsersBase::UserTypeBackend;
        	$postdata['UsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['UsersBase']['bdate']);
        }
        
        if ($model->load($postdata) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

        	$groupData = UsergroupBase::find()->select(['id' , 'title'])->where(['status' => 1])->all();
        	$grouplist = ArrayHelper::map($groupData, 'id', 'title');
        	
        	$permissionData = UserpermissionBase::find()->select(['id' , 'title'])->where(['status' => 1])->all();
        	$permissionlist = ArrayHelper::map($permissionData, 'id', 'title');

        	$status_list = array();
        	$status_list[1] = UsersBase::statusTitle(1);
        	$status_list[2] = UsersBase::statusTitle(2);
        	$status_list[3] = UsersBase::statusTitle(3);
        	
        	$usertype_list = array();
        	$usertype_list[1] = UsersBase::userTypeTitle(1);
        	$usertype_list[2] = UsersBase::userTypeTitle(2);
        	$usertype_list[3] = UsersBase::userTypeTitle(3);
        	 
        	return $this->render('update', [
                'model' => $model,
            	'groups_list' => $grouplist,
            	'permissions_list' => $permissionlist,
        		'status_list' 		=> $status_list,
        		'usertype_list' 	=> $usertype_list,
        		'message' => $message,
        	]);
        }
    }
    
    public function actionPassword($id)
    {
    	$message = '';
    	
     	$model = $this->findModel($id);
        
        $postdata = $_POST;
        if(count($postdata))
        {
            $postdata['UsersBase']['updatedate'] = date('y-m-d H:i:s');
            $postdata['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST['UsersBase']['password_hash']);
            if ($model->load($postdata) && $model->save()) {
                return $this->redirect(['index']);
            }
        }
        
        return $this->render('password', [
            'model' 		=> $model,
            'message' 		=> $message,
        ]);
        
    	
    }

    /**
     * Deletes an existing UsersBase model.
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
     * Finds the UsersBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
