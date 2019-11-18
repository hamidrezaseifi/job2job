<?php

namespace backend\controllers;

use Yii;
use common\lib\CandidateBase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\lib\CandidateSearchBase;
use common\lib\UsersBase;
use common\helper\BrainHelper;
use common\helper\BrainStaticList;
use common\lib\UserpermissionBase;
use yii\helpers\ArrayHelper;
use common\lib\BackendUserModel;
use common\lib\BranchBase;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller
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
     * Lists all Candidate models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$searchModel = new CandidateSearchBase();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Candidate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'readonly' => isset($_GET['readonly']) && strval($_GET['readonly']) == '1',
        ]);
    }
    
    /**
     * Lists all UsersBase models.
     * @return mixed
     */
    public function actionSearch($name)
    {
    	$name = isset($name) ? $name : '';
    	$list = array();
    	$name = trim($name);
    	if($name != '')
    	{
    		$query = UsersBase::find()->select(['id', 'fname', 'lname', 'status'])
    		->where(['status' => 1, 'usertype' => UsersBase::UserTypeCandidate])
    		->andFilterWhere(['or', ['like' , 'lname', $name],['like' , 'fname', $name]])
    		->orderBy(['lname' => SORT_ASC, 'fname' => SORT_ASC]);
    		$list = $query->all();
    		//echo $query->createCommand()->sql; exit;
    	}
    
    	if(count($list) == 0)
    	{
    		echo Yii::t('app', 'keine Ergebnisse');
    		exit;
    	}
    
    	foreach ($list as $item)
    	{
    		echo '<li data-id="' . $item->id . '">' . $item->fullname() . '</li>';
    	}
    	exit;
    }
    
    /**
     * Creates a new Candidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$candidateModel = new CandidateBase();
    	$candidateModel->desiredjobcountry = 'Deutschland';
    	$candidateModel->country = 'Deutschland';
    	
    	$userModel = new UsersBase();
        $userModel->bdate = '1990-01-01';
        $userModel->status = 1;
        
        if(count($_POST) > 0) {
        	$_POST['CandidateBase']['reachability'] = '';
        	$_POST['reachability'] = isset($_POST['reachability']) && is_array($_POST['reachability']) ? $_POST['reachability'] : array();
        	foreach ($_POST['reachability'] as $reach)
        	{
        		$_POST['CandidateBase']['reachability'] .= $reach . ', ';
        	}
        
        	$_POST['UsersBase']['bdate'] = BrainHelper::dateAsEnglish($_POST['UsersBase']['bdate']);
        	$_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
        	$_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
        	$_POST['UsersBase']['status'] = UsersBase::UserStatusActive;
        	$_POST['UsersBase']['group'] = 2;
        	$_POST['UsersBase']['permission'] = 2;
        	$_POST['UsersBase']['usertype'] = UsersBase::UserTypeCandidate;
        	
        	$_POST['UsersBase']['createdate'] = date('Y-m-d H:i:s');
        	$_POST['UsersBase']['updatedate'] = $_POST['UsersBase']['createdate'];
        	$_POST['CandidateBase']['createdate'] = $_POST['UsersBase']['createdate'];
        	$_POST['CandidateBase']['updatedate'] = $_POST['UsersBase']['updatedate'];
        	 
        	//print_r($_POST['UsersBase']); exit;
        
       		$userModel->load($_POST);
        	$userModel->save(false);
        
        	$_POST['CandidateBase']['userid'] = $userModel->id;
        	
        	$candidateModel->load($_POST);
        	$candidateModel->save(false);
        
         	return $this->redirect(['index']);
        }
        
        $reachability = $candidateModel->reachability;
        $reachability = explode(',', $reachability);
        $reachabilityar = array();
        foreach ($reachability as $reach)
        {
        	$reach = trim($reach);
        	if($reach == '') continue;
        	$reachabilityar[] = $reach;
        }
        $candidateModel->reachability = $reachabilityar;
        
        $titleList = BrainStaticList::titleList();
        $title2List = BrainStaticList::title2List();
        $nationalityList = BrainStaticList::nationalityList(true);
        $reachabiltyList = BrainStaticList::reachabilityList();
        $employeementList = BrainStaticList::employeementList();
        $accessableList = BrainStaticList::accessableList();
        $distanceListTemp = BrainStaticList::distanceList();
        $branchs = BranchBase::allActiveKeyList(false);
        $distanceList = array();
        
        foreach ($distanceListTemp as $distid => $distance)
        {
        	$distanceList[$distid] = $distance . (($distance == '') ? '' : ' kg');
        }
        $userModel->bdate = BrainHelper::dateAsGerman($userModel->bdate);
        
        return $this->render('create', [
    		'userModel' 		=> $userModel,
    		'candidateModel' 	=> $candidateModel,
    		'titleList' 		=> $titleList,
    		'title2List' 		=> $title2List,
    		'nationalityList' 	=> $nationalityList,
    		'reachabiltyList' 	=> $reachabiltyList,
    		'employeementList' 	=> $employeementList,
    		'accessableList' 	=> $accessableList,
            'distanceList' 		=> $distanceList,
            'branchs' 		=> $branchs,
        ]);
    }

    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$candidateModel = $this->findModel($id);
    	$candidateModel->desiredjobcountry = 'Deutschland';
    	$candidateModel->country = 'Deutschland';
    	
    	$userModel = $candidateModel->user();
    	
    	if(count($_POST) > 0) {
    		$_POST['CandidateBase']['reachability'] = '';
    		$_POST['reachability'] = isset($_POST['reachability']) && is_array($_POST['reachability']) ? $_POST['reachability'] : array();
    		foreach ($_POST['reachability'] as $reach)
    		{
    			$_POST['CandidateBase']['reachability'] .= $reach . ', ';
    		}
    		
    		$_POST['UsersBase']['bdate'] = BrainHelper::dateAsEnglish($_POST['UsersBase']['bdate']);
    		$_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
    		$_POST['UsersBase']['usertype'] = UsersBase::UserTypeCandidate;
    		
    		$_POST['CandidateBase']['availablefrom'] = BrainHelper::dateAsEnglish($_POST['CandidateBase']['availablefrom']);
    		
    		$candidateModel->load($_POST);
    		$candidateModel->save(false);
    		
    		$userModel->load($_POST);
    		$userModel->save(false);
    		
    		return $this->redirect(['index']);
        } 
        
        $reachability = $candidateModel->reachability;
        $reachability = explode(',', $reachability);
        $reachabilityar = array();
        foreach ($reachability as $reach)
        {
        	$reach = trim($reach);
        	if($reach == '') continue;
        	$reachabilityar[] = $reach;
        }
        $candidateModel->reachability = $reachabilityar;
        $titleList = BrainStaticList::titleList();
        $title2List = BrainStaticList::title2List();
        $nationalityList = BrainStaticList::nationalityList(true);
        $countryList = BrainStaticList::countryList(true);
        $reachabiltyList = BrainStaticList::reachabilityList();
        $employeementList = BrainStaticList::employeementList();
        $accessableList = BrainStaticList::accessableList();
        $worktypeList = BrainStaticList::workTypeList();
        $distanceListTemp = BrainStaticList::distanceList();
        $branchs = BranchBase::allActiveKeyList(false);
        $distanceList = array();
        foreach ($distanceListTemp as $distid => $distance)
        {
        	$distanceList[$distid] = $distance . ' kg';
        }
        $userModel->bdate = BrainHelper::dateAsGerman($userModel->bdate);
        $candidateModel->availablefrom = BrainHelper::dateAsGerman($candidateModel->availablefrom);
        
        return $this->render('update', [
        	'userModel' 		=> $userModel,
        	'candidateModel' 	=> $candidateModel,
    		'titleList' 		=> $titleList,
    		'title2List' 		=> $title2List,
    		'nationalityList' 	=> $nationalityList,
    		'countryList' 		=> $countryList,
    		'reachabiltyList' 	=> $reachabiltyList,
    		'employeementList' 	=> $employeementList,
    		'accessableList' 	=> $accessableList,
    		'worktypeList' 		=> $worktypeList,
   			'distanceList' 		=> $distanceList,
            'branchs' 		=> $branchs,
        ]);
        
        
    }

    public function actionPassword($id)
    {
        $message = '';
        
        $model = UsersBase::findOne($id);
         
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
     * Deletes an existing Candidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        UsersBase::deleteAll(['id' => $id]);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Candidate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CandidateBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = CandidateBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
