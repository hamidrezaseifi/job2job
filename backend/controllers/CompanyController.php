<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller ;
use common\lib\CompanySearchBase;
use common\lib\CompanyBase;
use common\helper\BrainHelper;
use common\lib\PersonaldecisionmakerBase;
use common\lib\ConnectedcompanyBase;
use common\helper\BrainStaticList;
use common\lib\UploadedfilesBase;
use yii\web\NotFoundHttpException;
use common\lib\UsersBase;


/**
 * CompanyController implements the CRUD actions for CompanyBase model.
 */
class CompanyController extends Controller
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
     * Lists all CompanyBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearchBase();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all CompanyBase models.
     * @return mixed
     */
    public function actionSearch($name)
    {
    	$name = isset($name) ? $name : ''; 
    	$list = array(); 
    	$name = trim($name); 
    	if($name != '')
    	{
	    	$list = CompanyBase::find()->select(['id', 'companyname', 'status'])->where(['status' => 1])->andWhere(['like' , 'companyname', $name])
	    	->orderBy(['companyname' => SORT_ASC])->all();
    	}
    	
    	if(count($list) == 0)
    	{
    		echo Yii::t('app', 'keine Ergebnisse');
    		exit;
    	}
    	
    	foreach ($list as $item)
    	{
    		echo '<li data-id="' . $item->id . '">' . $item->companyname . '</li>';
    	}
    	exit;
    }
    
    /**
     * Displays a single CompanyBase model.
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
     * Creates a new CompanyBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyBase();
        $model->founddate = date('Y-m-d');
        $model->status = 1;
        $model->isjob2job = 0;
        
        $postdata = Yii::$app->request->post();
        
        $drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";
        
        if(isset($_POST) && isset($_POST['CompanyBase'])){
            
            //print_r($postdata); exit;
            $postdata['CompanyBase']['founddate'] = BrainHelper::dateAsEnglish($postdata['CompanyBase']['founddate']);
            $postdata['PETUsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['PETUsersBase']['bdate']);

            $postdata['CompanyBase']['createdate'] = date('Y-m-d H:i:s');
            $postdata['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
            
            if(isset($postdata['SVUsersBase']))
            {
                $postdata['SVUsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['SVUsersBase']['bdate']);
            }
            
            if ($model->load($postdata) && $model->save(false)) {
                
                //$postdata['connectedcompanies']
                $postdata['connectedcompanies'] = isset($postdata['connectedcompanies']) && is_array($postdata['connectedcompanies']) ? $postdata['connectedcompanies'] : array();
                ConnectedcompanyBase::deleteAll(['companyid' => $model->id]);
                $condata = array('ConnectedcompanyBase' => array());
                $condata['ConnectedcompanyBase']['companyid'] = $model->id;
                foreach ($postdata['connectedcompanies'] as $connected)
                {
                    $condata['ConnectedcompanyBase']['name'] = $connected;
                    $conModel = new ConnectedcompanyBase();
                    $conModel->load($condata);
                    $conModel->save(false);
                }
                
                
                //PET PETUsersBase SV SVUsersBase connectedcompanies
                $data = [];
                $data['UsersBase'] = $postdata['PETUsersBase'];
                $data['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($data['UsersBase']['password_hash']);
                $data['UsersBase']['uname'] = $postdata['PET']['email'];
                $data['UsersBase']['group'] = 2;
                $data['UsersBase']['permission'] = 2;
                $data['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
                
                $userModel = new UsersBase();
                if ($userModel->load($data) && $userModel->save(false)) {
                    $data = [];
                    $data['PersonaldecisionmakerBase'] = $postdata['PET'];
                    $data['PersonaldecisionmakerBase']['userid'] = $userModel->id;
                    $data['PersonaldecisionmakerBase']['companyid'] = $model->id;
                    $data['PersonaldecisionmakerBase']['isdeputy'] = 0;
                    $data['PersonaldecisionmakerBase']['reachability'] = is_array($data['PersonaldecisionmakerBase']['reachability'])? implode(',', $data['PersonaldecisionmakerBase']['reachability']) : '';
                    
                    $petModel = new PersonaldecisionmakerBase();
                    $petModel->load($data);
                    $petModel->save(false);
                }
                
                if(isset($postdata['SV']['set']) && isset($postdata['SVUsersBase']))
                {
                    $data = [];
                    $data['UsersBase'] = $postdata['SVUsersBase'];
                    $data['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($data['UsersBase']['password_hash']);
                    $data['UsersBase']['uname'] = $postdata['SV']['email'];
                    $data['UsersBase']['group'] = 2;
                    $data['UsersBase']['permission'] = 2;
                    $data['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
                    
                    $userModel = new UsersBase();
                    if ($userModel->load($data) && $userModel->save(false)) {
                        $data = [];
                        $data['PersonaldecisionmakerBase'] = $postdata['SV'];
                        $data['PersonaldecisionmakerBase']['userid'] = $userModel->id;
                        $data['PersonaldecisionmakerBase']['companyid'] = $model->id;
                        $data['PersonaldecisionmakerBase']['isdeputy'] = 1;
                        $data['PersonaldecisionmakerBase']['reachability'] = is_array($data['PersonaldecisionmakerBase']['reachability'])? implode(',', $data['PersonaldecisionmakerBase']['reachability']) : '';
                        
                        $petModel = new PersonaldecisionmakerBase();
                        $petModel->load($data);
                        $petModel->save(false);
                    }
                    
                }
                
                
                $listurl = ['index'];
                if(!$drawmenu)
                {
                    $listurl['nomenu'] = 1;
                }
                
                return $this->redirect($listurl);
            }
            
        }
        	
    	$companytype_array = BrainStaticList::companyTypeList();
    	$employeecount_array = BrainStaticList::employeeCountList();
    	$model->founddate = Yii::$app->formatter->asDate($model->founddate, 'dd.MM.Y');
    	$titleList = BrainStaticList::titleList();
    	$title2List = BrainStaticList::title2List();
    	$reachabiltyList = BrainStaticList::reachabilityList();
    	$personalEntscheiderUserModel = $this->createCompanyUser();
    	$stellVertreterUserModel = $this->createCompanyUser();
    	
    	$model->founddate = BrainHelper::dateAsGerman($model->founddate);
    	$personalEntscheiderUserModel->bdate = BrainHelper::dateAsGerman($personalEntscheiderUserModel->bdate);
    	$stellVertreterUserModel->bdate = BrainHelper::dateAsGerman($stellVertreterUserModel->bdate);
    	
        return $this->render('create', [
            'model' 				=> $model,
			'companytypeList'		=> $companytype_array,
			'employeecountList'		=> $employeecount_array,
            'personalEntscheiderModel'	=> $this->createPersonaldecisionmaker(false),
            'stellVertreterModel'		=> $this->createPersonaldecisionmaker(true),
            'personalEntscheiderUserModel'	=> $personalEntscheiderUserModel,
            'stellVertreterUserModel'		=> $stellVertreterUserModel,
            'connectedCompanies'	=> [],
        	'logopath'				=> false,
        	'logoModel'				=> null,
            'titleList' 		=> $titleList,
            'title2List' 		=> $title2List,
            'reachabiltyList' 	=> $reachabiltyList,
        ]);
        
    }

    /**
     * Updates an existing CompanyBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $plist = $model->personalDecisionMakerList();
        
        $personalEntscheiderUser = isset($plist[0]) ? $plist[0]->getUser() : $this->createCompanyUser();
        $stellVertreterUser = isset($plist[1]) ? $plist[1]->getUser() : $this->createCompanyUser();
        
        $personalEntscheiderModel = isset($plist[0]) ? $plist[0] : $this->createPersonaldecisionmaker(false);
        $stellVertreterModel = isset($plist[1]) ? $plist[1] : $this->createPersonaldecisionmaker(true);        
        
        $postdata = Yii::$app->request->post();
        
        if(isset($_POST) && isset($_POST['CompanyBase'])){
            
            
            $postdata['CompanyBase']['founddate'] = BrainHelper::dateAsEnglish($postdata['CompanyBase']['founddate']);
            $postdata['PETUsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['PETUsersBase']['bdate']);
            
            
            $postdata['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
            $postdata['PET']['updatedate'] = date('Y-m-d H:i:s');
            $postdata['PETUsersBase']['updatedate'] = date('Y-m-d H:i:s');
            if(isset($postdata['SV'])){
                $postdata['SV']['updatedate'] = date('Y-m-d H:i:s');
                $postdata['SVUsersBase']['updatedate'] = date('Y-m-d H:i:s');
            }
            
            
            if(isset($postdata['SVUsersBase']))
            {
                $postdata['SVUsersBase']['bdate'] = BrainHelper::dateAsEnglish($postdata['SVUsersBase']['bdate']);
            }
            //print_r($postdata); exit;
            if ($model->load($postdata) && $model->save(false)) {
                
                //$postdata['connectedcompanies']
                $postdata['connectedcompanies'] = isset($postdata['connectedcompanies']) && is_array($postdata['connectedcompanies']) ? $postdata['connectedcompanies'] : array();
                ConnectedcompanyBase::deleteAll(['companyid' => $model->id]);
                $condata = array('ConnectedcompanyBase' => array());
                $condata['ConnectedcompanyBase']['companyid'] = $model->id;
                foreach ($postdata['connectedcompanies'] as $connected)
                {
                    $condata['ConnectedcompanyBase']['name'] = $connected;
                    $conModel = new ConnectedcompanyBase();
                    $conModel->load($condata);
                    $conModel->save(false);
                }
                
                
                //PET PETUsersBase SV SVUsersBase connectedcompanies
                $data = [];
                $data['UsersBase'] = $postdata['PETUsersBase'];
                //$data['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($data['UsersBase']['password_hash']);
                $data['UsersBase']['uname'] = $postdata['PET']['email'];
                $data['UsersBase']['group'] = 2;
                $data['UsersBase']['permission'] = 2;
                $data['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
                
                
                if ($personalEntscheiderUser->load($data) && $personalEntscheiderUser->save(false)) {
                    $data = [];
                    $data['PersonaldecisionmakerBase'] = $postdata['PET'];
                    $data['PersonaldecisionmakerBase']['userid'] = $personalEntscheiderUser->id;
                    $data['PersonaldecisionmakerBase']['companyid'] = $model->id;
                    $data['PersonaldecisionmakerBase']['isdeputy'] = 0;
                    $data['PersonaldecisionmakerBase']['reachability'] = is_array($data['PersonaldecisionmakerBase']['reachability'])? implode(',', $data['PersonaldecisionmakerBase']['reachability']) : '';
                    $personalEntscheiderModel->load($data);
                    $personalEntscheiderModel->save(false);
                }
                
                if(isset($postdata['SV']['set']) && isset($postdata['SVUsersBase']))
                {
                    unset($postdata['SV']['set']);
                    $data = [];
                    $data['UsersBase'] = $postdata['SVUsersBase'];
                    //$data['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($data['UsersBase']['password_hash']);
                    $data['UsersBase']['uname'] = $postdata['SV']['email'];
                    $data['UsersBase']['group'] = 2;
                    $data['UsersBase']['permission'] = 2;
                    $data['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
                    
                    if ($stellVertreterUser->load($data) && $stellVertreterUser->save(false)) {
                        $data = [];
                        $data['PersonaldecisionmakerBase'] = $postdata['SV'];
                        $data['PersonaldecisionmakerBase']['userid'] = $stellVertreterUser->id;
                        $data['PersonaldecisionmakerBase']['companyid'] = $model->id;
                        $data['PersonaldecisionmakerBase']['isdeputy'] = 1;
                        $data['PersonaldecisionmakerBase']['reachability'] = is_array($data['PersonaldecisionmakerBase']['reachability'])? implode(',', $data['PersonaldecisionmakerBase']['reachability']) : '';
                        //print_r($data); exit;
                        $stellVertreterModel->load($data);
                        $stellVertreterModel->save(false);
                    }
                    
                }
                else{
                    $stellVertreterUser->delete();
                    $stellVertreterModel->delete();
                }
                             
                return $this->redirect(['index']);
            }
            
        }
        	
    	$companytype_array = BrainStaticList::companyTypeList();
    	$employeecount_array = BrainStaticList::employeeCountList();
    	$logopath = $this->company_logo($id);
    	$logoModel = UploadedfilesBase::findOne(['file' => $logopath]);
    	$connectedCompanies = ConnectedcompanyBase::findAll(['companyid' => $model->id]);
    	$titleList = BrainStaticList::titleList();
    	$title2List = BrainStaticList::title2List();
    	$reachabiltyList = BrainStaticList::reachabilityList();

    	$model->founddate = BrainHelper::dateAsGerman($model->founddate);   	
    	$personalEntscheiderUser->bdate = BrainHelper::dateAsGerman($personalEntscheiderUser->bdate);
    	$stellVertreterUser->bdate = BrainHelper::dateAsGerman($stellVertreterUser->bdate);
    	$personalEntscheiderModel->reachability = explode(',', $personalEntscheiderModel->reachability);
    	$stellVertreterModel->reachability = explode(',', $stellVertreterModel->reachability);
    	
        return $this->render('update', [
            'model' 				=> $model,
			'companytypeList'		=> $companytype_array,
			'employeecountList'		=> $employeecount_array,
            'personalEntscheiderModel'	=> $personalEntscheiderModel,
            'stellVertreterModel'		=> $stellVertreterModel ,
            'personalEntscheiderUserModel'	=> $personalEntscheiderUser,
            'stellVertreterUserModel'		=> $stellVertreterUser,
            'connectedCompanies'	=> $connectedCompanies,
        	'logopath'				=> $logopath,
			'logoModel'				=> $logoModel,
            'titleList' 		=> $titleList,
            'title2List' 		=> $title2List,
            'reachabiltyList' 	=> $reachabiltyList,
        ]);
        
    }
    
    /**
     * Deletes an existing CompanyBase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$companyModel = $this->findModel($id);
    	$plist = $companyModel->personalDecisionMakerList();
        
    	foreach ($plist as $personal)
    	{
    		$personal->getUser()->delete();
    		$personal->delete();
    	}
    	
    	$companyModel->delete();

		//PersonaldecisionmakerBase::
        //UsersBase::deleteAll(['id' => $id]);
        
        return $this->redirect(['index']);
    }

    public function actionSetlogo()
    {
        
    	$companyid = $_REQUEST['cid'];

    	
    	if(isset($_GET['ac']))
    	{
    		$file = $this->company_logo($companyid);
    	    if($_GET['ac'] == 'ok')
    		{
    			$upid = $_REQUEST['uid'];
    			UploadedfilesBase::deleteAll(['id' => $upid]);
    		}
    		
    	    if($_GET['ac'] == 'del')
    		{
    			$rpath = $this->company_logo_real($companyid);
    			UploadedfilesBase::deleteAll(['file' => $file]);
    			unlink($rpath);
    		}
    	}
    	
    	if(count($_FILES) && isset($_FILES['company_logo']))
    	{
    		$ufile = $_FILES['company_logo'];
    		
    		$info = pathinfo($ufile['name']);
    		
    		$rpath = self::photo_path() . '/' . $companyid . '.' . $info['extension'];
    		if(file_exists($rpath))
    		{
    			unlink($rpath);
    		}
    		copy($ufile['tmp_name'], $rpath);
    		
    	}
    	
        return $this->redirect(Yii::getAlias('@web') . '/company/update?id=' . $companyid);
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
     * Finds the CompanyBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function photo_path()
    {
    	return dirname(dirname(dirname(__FILE__))) . '/frontend/web/company_logo';
    }

    public function company_logo($id)
    {
    	$photopath = false;
    	$list = glob(self::photo_path() . '/' . $id . '.*', GLOB_BRACE);
    	if(count($list))
    	{
    
    		$file = $list[0];
    		$info = pathinfo($file);
    		$photopath = dirname(Yii::getAlias('@web')) . '/frontend/web/company_logo/' . $info['basename'];
    	}
    	 
    	return $photopath;
    
    }
    
    public function company_logo_real($id)
    {
    	$photopath = false;
    	$list = glob(self::photo_path() . '/' . $id . '.*', GLOB_BRACE);
    	if(count($list))
    	{
    		
    		$file = $list[0];
    		$photopath = $file;
    	}
    	
    	return $file;
    	 
    }
    
    public function createPersonaldecisionmaker($deputy = false)
    {
        $model = new PersonaldecisionmakerBase();
        $model->companyid = 0;
        $model->isdeputy = $deputy ? 1 : 0;
        
        $reachability = $model->reachability;
        $reachability = explode(',', $reachability);
        $reachabilitArray = array();
        foreach ($reachability as $reach)
        {
            $reach = trim($reach);
            if($reach == '') continue;
            $reachabilitArray[] = $reach;
        }
        $model->reachability = $reachabilitArray;
        
        return $model;
    }
    
    public function createCompanyUser()
    {        
        $userModel = new UsersBase();
        $userModel->bdate = '2000-01-01';
        $userModel->status = UsersBase::UserStatusActive;
        $userModel->usertype = UsersBase::UserTypeCompany;
        
        return $userModel;
    }
}
