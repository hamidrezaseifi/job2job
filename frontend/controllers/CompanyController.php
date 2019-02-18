<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\lib\SkillsBase;
use common\lib\UsersBase;
use common\lib\CompanyBase;
use common\lib\CountryBase;
use common\lib\WorktimemodelBase;
use common\helper\BrainHelper;
use common\lib\BranchBase;
use common\lib\CandidateskillBase;
use common\lib\PersonaldecisionmakerBase;
use common\lib\JobpositionBase;
use common\lib\UploadedfilesBase;
use \common\lib\JobpositionBaseSearch;
use common\lib\JobpositionskillBase;
use common\lib\VacancyBase;
use common\helper\BrainStaticList;
use common\lib\PostcodeBase;
use common\lib\CityBase;
use common\lib\ConnectedcompanyBase;
use common\lib\FrontlogBase;


/**
 * Site controller
 */
class CompanyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            	'except' => ['register' , 'verify' , 'response' , 'check'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    		return Yii::$app->user->identity->usertype == UsersBase::UserTypeCompany;    // return boolean
                    	}
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionRegister()
    {
    	$model = new UsersBase();
    	$companyModel = new CompanyBase();
    	$pdmModel  = new PersonaldecisionmakerBase();
    	 
    
        if(count($_POST) && isset($_POST['checkcondition']))
    	{
    		
    		$_POST['UsersBase']['password_hash'] = '';
    		$_POST['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
    		$_POST['UsersBase']['createdate'] = date('Y-m-d');
    		$_POST['UsersBase']['bdate'] = '1980-01-01';
    		$_POST['UsersBase']['group'] = 2;
    		$_POST['UsersBase']['permission'] = 2;
    		$_POST['UsersBase']['status'] = UsersBase::UserStatusApprove;
    		
    		$model->load($_POST);
    		$model->save(false);
    
    		$userid = $model->id;
    		

    		$_POST['CompanyBase']['createdate'] = date('Y-m-d');
    		$_POST['CompanyBase']['founddate'] = '2000-01-01';
    		$_POST['CompanyBase']['companytype'] = 0;
    		$_POST['CompanyBase']['steueid'] = '';
    		$_POST['CompanyBase']['employeecount'] = 0;
    		$_POST['CompanyBase']['status'] = 1;
    		
    		$companyModel->load($_POST);
    		$companyModel->save(false);

    		$companyid = $companyModel->id;
    		
    		$_POST['PersonaldecisionmakerBase']['userid'] = $userid;
    		$_POST['PersonaldecisionmakerBase']['companyid'] = $companyid;
    		$_POST['PersonaldecisionmakerBase']['fname'] = '';
    		$_POST['PersonaldecisionmakerBase']['lname'] = '';
    		$_POST['PersonaldecisionmakerBase']['isdeputy'] = 0;
    		$_POST['PersonaldecisionmakerBase']['email'] = $_POST['UsersBase']['uname'];
    		$_POST['PersonaldecisionmakerBase']['createdate'] = date('Y-m-d');
    		$pdmModel->load($_POST);
    		$pdmModel->save(false);
    		
    		if(isset($_POST['skill']) && is_array($_POST['skill']))
    		{
    			foreach ($_POST['skill'] as $skillitem)
    			{
    				$skillModel = new CandidateskillBase();
    				$skillModel->userid = $userid;
    				$skillModel->skill = $skillitem;
    				$skillModel->save(false);
    			}
    		}
    
    		$verifydata = array();
    		$verifydata['uid'] = $userid;
    		$verifydata['utp'] = UsersBase::UserTypeCompany;
    		
    		$verifydataa = serialize($verifydata);
    		$verifydataa = base64_encode($verifydataa);
    		
    		$verifydata['checkubd'] = '1970-01-01';
    		$verifydata['checkuca'] = $_POST['UsersBase']['createdate'];

    		$verifydatab = serialize($verifydata);
    		$verifydatab = base64_encode($verifydatab);
    		
    		$verifyurl =  "http://" . $_SERVER['HTTP_HOST'] . str_replace('/register' , '/verify' , $_SERVER['REDIRECT_URL']);
    		$verifyurl .= '?a=' . urlencode($verifydataa) . '&b=' . urlencode($verifydatab);
    		$verifytextfile = dirname(__DIR__). '/views/candidate/verifytext.php';
    		$emailbody = file_get_contents($verifytextfile);
    		$emailbody = str_replace('%link', $verifyurl, $emailbody);
    		$emailbody = str_replace('%link', $verifyurl, $emailbody);
    		
    		
    		$empfaenger = $_POST['PersonaldecisionmakerBase']['email'];
    		$betreff = Yii::$app->params['registerresponse_sender_title'];

    		$header = 'From: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
    				'Reply-To: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
    				'Content-Type: text/html; charset=UTF-8\r\n'.
    				'X-Mailer: PHP/' . phpversion();

    		mail($empfaenger, $betreff, $emailbody, $header);
    		
    		FrontlogBase::addLog('Register:' . $userid . ':' . $companyModel->id, $userid, false);
    		
    		return $this->render('register_resp' , []);
    		
    		
    	}
    
    	return $this->render('register' , [
    			'model' 			=> $model,
    			'companyModel' 		=> $companyModel,
    			'pdmModel'	 		=> $pdmModel,
    	]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDashboard()
    {
    	$action = isset($_GET['ac']) ? $_GET['ac'] : 'index';
    	$after_verify = isset($_GET['verify']) && $_GET['verify'] == 'ok' ? true : false;
    	 
    	$subpageContent = '';
    	
    	
    	$model = Yii::$app->user->identity; 
    	$companyModel = $model->company();
    	$plist = $companyModel->personalDecisionMakerList();
    	
    	$pdmModel = isset($plist[0]) ? $plist[0] : new PersonaldecisionmakerBase();
    	$pdmModelSecond = isset($plist[1]) ? $plist[1] : new PersonaldecisionmakerBase();
    	
    	$model = $pdmModel->isNewRecord ? new UsersBase() : $pdmModel->getUser();
    	$modelSecond = $pdmModelSecond->isNewRecord ? new UsersBase() : $pdmModelSecond->getUser();
    	
    	$jobPositionModel = JobpositionBase::find()->select(["count(*) as jobCount"])->where(['companyid' => $companyModel->id])->all();
    	$jobPositionModel = count($jobPositionModel) > 0 ? $jobPositionModel[0] : $jobPositionModel;
     	 
    	$logopath = self::company_logo();    	
    	$logo_approved = true;
    	$filemodel = $logopath ? UploadedfilesBase::findOne(['file' => $logopath]) : NULL;
    	if($filemodel != null && $logopath)
    	{
    		$logo_approved= false;
    	}
    	
    	//$postcodes = PostcodeBase::allPostcodes(true);
    	//$cities = CityBase::allCities(true);
    	
    	switch ($action)
    	{
    		case 'myprofile' :
    			
    			if(isset($_POST['part']))
    			{
    				$this->update_profile($_POST['part'], $_POST);
    			}
    			
    			$connectedCompanies = $companyModel->connectedCompanies();
    			$connectedCompanies = BrainHelper::mapTranslate($connectedCompanies, 'id', 'name');
    			
    			$companyModel->founddate = BrainHelper::dateEnglishToGerman($companyModel->founddate);
    			$model->bdate = BrainHelper::dateEnglishToGerman($model->bdate);
    			$modelSecond->bdate = BrainHelper::dateEnglishToGerman($modelSecond->bdate);
    			    			
    			$nationalities_array = BrainStaticList::nationalityList();
    			$distances_array = BrainStaticList::distanceList();
    			$companytype_array = BrainStaticList::companyTypeList();
    			$employeecount_array = BrainStaticList::employeeCountList();
    			
    			if(strlen($pdmModel->tel) < 2)
    			{
    				$pdmModel->tel = '--';
    			}
    			
    			if(strlen($pdmModel->cellphone) < 2)
    			{
    				$pdmModel->cellphone = '--';
    			}
    			
    			if(strlen($pdmModelSecond->tel) < 2)
    			{
    				$pdmModelSecond->tel = '--';
    			}
    			
    			if(strlen($pdmModelSecond->cellphone) < 2)
    			{
    				$pdmModelSecond->cellphone = '--';
    			}
    			
    			$subpageContent = $this->renderPartial('dashbaord_profile' , [
    					'model' 				=> $model,
    					'modelSecond' 			=> $modelSecond,
    					'companyModel' 			=> $companyModel,
    					'pdmModel'	 			=> $pdmModel,
    					'pdmModelSecond'		=> $pdmModelSecond,
    					//'skills' 				=> $skill_array,
    					'nationalities' 		=> $nationalities_array,
    					'distances' 			=> $distances_array,
    					'companytypes'			=> $companytype_array,
    					'cellphoneList'			=> explode('-' , $pdmModel->cellphone),
    					'telList'				=> explode('-' , $pdmModel->tel),
    					'cellphoneList2'		=> explode('-' , $pdmModelSecond->cellphone),
    					'telList2'				=> explode('-' , $pdmModelSecond->tel),
    					'reachabilityList'		=> BrainStaticList::reachabilityList(),
    					'employeecountList'		=> $employeecount_array,
    					'connectedCompanies'	=> $connectedCompanies,
    					'photopath'				=> $logopath,
    					'photo_approved'		=> $logo_approved,
    			]);
    			
    			break;
    	
    		case 'jobs' :
    				 
    			$searchModel = new JobpositionBaseSearch();
    			$searchModel->companyid = $companyModel->id;
    			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    			//print_r($dataProvider->getModels()); exit;
    			
    			$subpageContent = $this->renderPartial('dashbaord_adv' , [
    					'model' 				=> $model,
    					'modelSecond' 			=> $modelSecond,
    					'companyModel' 			=> $companyModel,
    					'pdmModel'	 			=> $pdmModel,
    					'pdmModelSecond'		=> $pdmModelSecond,
    					'searchModel'			=> $searchModel,
    					'dataProvider'			=> $dataProvider,
    					'jobadvList'			=> $dataProvider->getModels(),
    					
    			]);
    				 
    			break;    
    			
    		case 'newjob' :
    				 
    			$jobModel = new JobpositionBase();
    			
    			if(isset($_POST['job']))
    			{
    			    print_r($_POST);
    			    exit;
    				$this->edit_jobadv($_POST , $jobModel);
    			}
    			    			
    			$skills = SkillsBase::allChilds(1);
    			$worktypes_array = BrainStaticList::workTypeList();
    			$vacancy_array = BrainStaticList::vacancyList();
    			$branchs = BranchBase::allActiveKeyList();
    			$vacancies = VacancyBase::allActiveKeyList();
    			
    			$jobModel->country = 'Deutschland';
     			
    			$subpageContent = $this->renderPartial('dashbaord_newadv' , [
    					'jobModel' 				=> $jobModel,
    					'userModel' 			=> $model,
    					'userModelSecond' 		=> $modelSecond,
    					'companyModel' 			=> $companyModel,
    					'pdmModel'	 			=> $pdmModel,
    					'pdmModelSecond'		=> $pdmModelSecond,
    					'skills' 				=> $skills,
    					'selectedSkills' 		=> array(),
    			        'vacancies'				=> $vacancies,
        			    'branchs'				=> $branchs,
    			    
    			]);
    				 
    			break;    	
    		case 'editjob' :
    			
    			$jobid = $_GET['id'];
    			$jobModel = JobpositionBase::findOne(['id' => $jobid]);
    			if($companyModel->id != $jobModel->companyid)
    			{
    				return $this->redirect(['site/invalidpage' , 'msg' => Yii::t('app', 'ungültig Stellenanzeige!')]);
    			}
    			
    			if(isset($_POST['job']))
    			{
    				$this->edit_jobadv($_POST , $jobModel);
    			}
    			
    			$countries = CountryBase::findAll(['status' => 1]);
    			$worktypes =  WorktimemodelBase::findAll(['status' => 1]);
    			$selectedJobskill = JobpositionskillBase::findAll(['jobid' => $jobid]); 
    			$skills1 = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1 , 'jobtype' => 1])->orderBy('title')->all();
    			$skills2 = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1 , 'jobtype' => 2])->orderBy('title')->all();
    			$skills3 = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1 , 'jobtype' => 3])->orderBy('title')->all();
    			
    			$skills1 = BrainHelper::mapTranslate($skills1, 'id', 'title');
    			$skills2 = BrainHelper::mapTranslate($skills2, 'id', 'title');
    			$skills3 = BrainHelper::mapTranslate($skills3, 'id', 'title');
    			
    			$skills = array(1 => $skills1 , 2 => $skills2, 3 => $skills3);
    			$worktypes_array = array(0 => '');
    			$worktypes_array = array_merge($worktypes_array , BrainHelper::mapTranslate($worktypes, 'id', 'title'));
    			$vacancy_array = BrainStaticList::vacancyList();
    			 
    			$subpageContent = $this->renderPartial('dashbaord_newadv' , [
    					'jobModel' 				=> $jobModel,
    					'userModel' 			=> $model,
    					'userModelSecond' 		=> $modelSecond,
    					'companyModel' 			=> $companyModel,
    					'pdmModel'	 			=> $pdmModel,
    					'pdmModelSecond'		=> $pdmModelSecond,
    					'skills' 				=> $skills,
    					'selectedSkills' 		=> $selectedJobskill,
    					'vacancies'				=> $vacancy_array,
    						
    			]);
    			
    			break;
    		case 'deletejob' :
    			
    			$jobid = $_GET['id'];
    			$jobModel = JobpositionBase::findOne(['id' => $jobid]);
    			
    			if(isset($_POST['delete']) && $_POST['delete'] == 'ok')
    			{
    				$jobModel->delete();
    				return $this->redirect(Yii::getAlias('@web') . '/company/dashboard/jobs');
    			}
    			    			
    			$subpageContent = $this->renderPartial('dashbaord_deladv' , [
    					'jobModel' 				=> $jobModel,
    					'userModel' 			=> $model,
    					'userModelSecond' 		=> $modelSecond,
    					'companyModel' 			=> $companyModel,
    					
    					
    			]);
    			
    			break;
    	}
    	
    	$percentTotal = 21;
    	$percentCalc = 0;
    	
    	$percentCalc += $model->uname != null && $model->uname != '' ? 1 : 0;
    	$percentCalc += $model->password_hash != null && $model->password_hash != '' ? 1 : 0;
    	$percentCalc += $model->fname != null && $model->fname != '' ? 1 : 0;
    	$percentCalc += $model->lname != null && $model->lname != '' ? 1 : 0;
    	$percentCalc += $model->bdate != null && $model->bdate != '' ? 1 : 0;
    	
    	$percentCalc += $companyModel->companytype != null && $companyModel->companytype != '' ? 1 : 0;
    	$percentCalc += count($companyModel->connectedCompanies()) != 0 ? 1 : 0;
    	$percentCalc += $companyModel->companyname != null && $companyModel->companyname != '' ? 1 : 0;
    	$percentCalc += $companyModel->founddate != null && $companyModel->founddate != '' ? 1 : 0;
    	$percentCalc += $companyModel->taxid != null && $companyModel->taxid != '' ? 1 : 0;
    	$percentCalc += $companyModel->homepage != null && $companyModel->homepage != '' ? 1 : 0;
    	$percentCalc += $companyModel->employeecountindex != null && $companyModel->employeecountindex > 0 ? 1 : 0;
    	$percentCalc += $companyModel->logo != null && $companyModel->logo != '' ? 1 : 0;
    	
    	$percentCalc += $jobPositionModel->jobCount < 5 ? $jobPositionModel->jobCount : 5;
    	
    	$percentCalc += $logopath && $logo_approved? 1 : 0;
    	
    	return $this->render('dashboard' , [
    			'model' 				=> $model,
    			'companyModel' 			=> $companyModel,
    			//'skillModel'	 		=> $skillModel,
    			'action'				=> $action,
    			'subpageContent'		=> $subpageContent,
    			'after_verify'			=> $after_verify,
    			'photopath'				=> $logopath,
    			'photo_approved'		=> $logo_approved,
    			'percentTotal'			=> $percentTotal,
    			'percentCalc'			=> $percentCalc,
    	]);
    }
    
    private function update_profile($part , $data)
    {
    	$message = 'ok';
    	
    	$data['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
    	$data['UsersBase']['updatedate'] = date('Y-m-d H:i:s');
    	$data['PersonaldecisionmakerBase']['updatedate'] = date('Y-m-d H:i:s');
    	
    	$model = Yii::$app->user->identity;
    	$companyModel = $model->company();
    	$plist = $companyModel->personalDecisionMakerList();
    	
    	$pdmModel = isset($plist[0]) ? $plist[0] : new PersonaldecisionmakerBase();
    	$pdmModelSecond = isset($plist[1]) ? $plist[1] : new PersonaldecisionmakerBase();
    	
    	$model = $pdmModel->isNewRecord ? new UsersBase() : $pdmModel->getUser();
    	$modelSecond = $pdmModelSecond->isNewRecord ? new UsersBase() : $pdmModelSecond->getUser();
    	
    	if($part == "company")
    	{
    		$data['CompanyBase']['founddate'] = isset($data['CompanyBase']['founddate']) ? BrainHelper::dateGermanToEnglish($data['CompanyBase']['founddate']) : date('Y-m-d');
    		
    		$companyModel->load($data);
    		$companyModel->save(false);
    		
    		$data['connectedcompanies'] = isset($data['connectedcompanies']) && is_array($data['connectedcompanies']) ? $data['connectedcompanies'] : array();
    		ConnectedcompanyBase::deleteAll(['companyid' => $companyModel->id]);
    		$condata = array('ConnectedcompanyBase' => array());
    		$condata['ConnectedcompanyBase']['companyid'] = $companyModel->id;
    		foreach ($data['connectedcompanies'] as $connected)
    		{
    			$condata['ConnectedcompanyBase']['name'] = $connected;
    			$conModel = new ConnectedcompanyBase();
    			$conModel->load($condata);
    			$conModel->save(false);
    		}
    	}
    	
    	if($part == "contact")
    	{
    		
    		$data['UsersBase']['bdate'] = isset($data['UsersBase']['bdate']) ? BrainHelper::dateGermanToEnglish($data['UsersBase']['bdate']) : date('Y-m-d');
    		
    		$data['reachability'] = isset($data['reachability']) && is_array($data['reachability']) ? $data['reachability'] : array();
    		
    		$data['PersonaldecisionmakerBase']['reachability'] = '';
    		$ar = BrainStaticList::reachabilityList();
    		foreach($data['reachability'] as $reach)
    		{
    			$data['PersonaldecisionmakerBase']['reachability'] .= $ar[$reach] . ', ';
    		}
    		
    		$data['PersonaldecisionmakerBase']['email'] = $data['UsersBase']['uname'];
    		$data['PersonaldecisionmakerBase']['cellphone'] = $data['ctel1'] . '-' . $data['ctel2'] . '-' . $data['ctel3'];
    		$data['PersonaldecisionmakerBase']['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];
    		
    		
    		$model->load($data);
    		$model->save(false);
    		
    		$pdmModel->load($data);
    		$pdmModel->save(false);
    		
    		
    		//$companyModel->load($data);
    		//$companyModel->save(false);
    		
    		if(isset($data['SecondPersonaldecisionmaker']))
    		{
    			$data['UsersBaseSV']['bdate'] = isset($data['UsersBaseSV']['bdate']) ? BrainHelper::dateGermanToEnglish($data['UsersBaseSV']['bdate']) : date('Y-m-d');
    			
    			$data['reachabilitySV'] = isset($data['reachabilitySV']) && is_array($data['reachabilitySV']) ? $data['reachabilitySV'] : array();
    			
    			$data['PersonaldecisionmakerBaseSV']['email'] = $data['UsersBaseSV']['uname'];
    			$data['PersonaldecisionmakerBaseSV']['cellphone'] = $data['ctel1SV'] . '-' . $data['ctel2SV'] . '-' . $data['ctel3SV'];
    			$data['PersonaldecisionmakerBaseSV']['tel'] = $data['tel1SV'] . '-' . $data['tel2SV'] . '-' . $data['tel3SV'];

    			$data['PersonaldecisionmakerBaseSV']['reachability'] = '';
    			$ar = BrainStaticList::reachabilityList();
    			foreach($data['reachabilitySV'] as $reach)
    			{
    				$data['PersonaldecisionmakerBaseSV']['reachability'] .= $ar[$reach] . ', ';
    			}

    			$secData = array();
    			$secData['PersonaldecisionmakerBase'] = $data['PersonaldecisionmakerBaseSV'];
    			$secData['UsersBase'] = $data['UsersBaseSV'];

    			$secData['UsersBase']['password_hash'] = '';
    			$secData['UsersBase']['usertype'] = UsersBase::UserTypeCompany;
    			$secData['UsersBase']['createdate'] = date('Y-m-d H:i:s');
    			$secData['UsersBase']['updatedate'] = date('Y-m-d H:i:s');
    			$secData['UsersBase']['group'] = 2;
    			$secData['UsersBase']['permission'] = 2;
    			$secData['UsersBase']['status'] = UsersBase::UserStatusActive;
    			
    			
    			$modelSecond->load($secData);  
    			$modelSecond->save(false);

    			$secData['PersonaldecisionmakerBase']['userid'] = $modelSecond->id;
    			$secData['PersonaldecisionmakerBase']['companyid'] = $companyModel->id;
    			$secData['PersonaldecisionmakerBase']['isdeputy'] = 1;
    			$secData['PersonaldecisionmakerBase']['createdate'] = $secData['UsersBase']['createdate'];
    			$secData['PersonaldecisionmakerBase']['updatedate'] = $secData['UsersBase']['createdate'];
    			 
    			$pdmModelSecond->load($secData);
    			$pdmModelSecond->save(false);
    			 
    		}
    		else 
    		{
    			if(!$modelSecond->isNewRecord)
    			{
    				$modelSecond->delete();
    			}
    			if(!$pdmModelSecond->isNewRecord)
    			{
    				$pdmModelSecond->delete();
    			}
    		}
    		
    		
    	}
    	
    	if($part == "company_logo")
    	{
    		if(count($_FILES) > 0 && isset($_FILES['company_logo']))
    		{
    			$upload_path = self::photo_path();
    			if(!file_exists($upload_path))
    			{
    				mkdir($upload_path);
    			}
    			
    			$name = $_FILES['company_logo']['name'];
    			$tmp_name = $_FILES['company_logo']['tmp_name'];
    			
    			$srcname = '/' . $upload_path . $name;
    			$info = pathinfo($srcname);
    			$upload_path = $upload_path . '/' . $companyModel->id . '.' . $info['extension'];
    			if(file_exists($upload_path))
    			{
    				unlink($upload_path);
    			}
    			copy($tmp_name, $upload_path);
    			
    			$photo_web_path = Yii::getAlias('@web') . '/web/company_logo/' . $companyModel->id . '.' . $info['extension'];
    			$filemodel = UploadedfilesBase::findOne(['file' => $photo_web_path]);
    			if($filemodel != null)
    			{
    				$filemodel->upload_date = date('Y-m-d H:i:s');
    			}
    			else
    			{
    				$filemodel = new UploadedfilesBase();
    				$filemodel->file = $photo_web_path;
    				$filemodel->userid = Yii::$app->user->identity->id;
    				$filemodel->status = 0;
    				$filemodel->upload_date = date('Y-m-d H:i:s');
    			}
    			$filemodel->save();
    		}
    		
    	}
    	
    	//SecondPersonaldecisionmaker
    	
    	echo $message;
    	exit;
    }

    private function edit_jobadv($data , $jobModel)
    {
    	$message = 'ok';
    	$isnew = $jobModel->isNewRecord;
    	
    	$model = Yii::$app->user->identity;
    	$companyModel = $model->company();
    	
    	if($isnew)
    	{
    		$data['JobpositionBase']['createdate'] = date('Y-m-d H:i:s');
    	}
    	$data['JobpositionBase']['updatedate'] = date('Y-m-d H:i:s');
    	$data['JobpositionBase']['companyid'] = $companyModel->id;
    	$data['JobpositionBase']['subtitle'] = isset($data['JobpositionBase']['subtitle']) ? $data['JobpositionBase']['subtitle'] : '';
    	$data['JobpositionBase']['postcode'] = isset($data['JobpositionBase']['postcode']) ? $data['JobpositionBase']['postcode'] : '';
    	$data['JobpositionBase']['showdate'] = isset($data['JobpositionBase']['showdate']) ? $data['JobpositionBase']['showdate'] : date('Y-m-d');
    	$data['JobpositionBase']['expiredate'] = isset($data['JobpositionBase']['expiredate']) ? BrainHelper::dateGermanToEnglish($data['JobpositionBase']['expiredate']) : date('Y-m-d');
    	if($isnew)
    	{
    		$data['JobpositionBase']['userid'] = Yii::$app->user->identity->id;
    	}
    	$data['JobpositionBase']['status'] = 2;
    	 
    	$allskills = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1])->all();
    	$allskills = BrainHelper::mapTranslate($allskills, 'title', 'title');
    	
    	$data['skills'] = isset($data['skills']) && is_string($data['skills']) ? $data['skills'] : '';
    	
    	$skills = explode(',' , $data['skills']);
    	
    	$jobModel->load($data); 
    	$jobModel->save(false);
    	JobpositionskillBase::deleteAll(['jobid' => $jobModel->id]);
    	
    	$skilldata = array();
    	$skilldata['JobpositionskillBase']['jobid'] = $jobModel->id;
    	$skilldata['JobpositionskillBase']['created'] = date('Y-m-d H:i:s');
    	foreach ($skills as $skill)
    	{
    		$skill = trim($skill);
    		if($skill == '') continue; 
    		$skilldata['JobpositionskillBase']['skill'] = $skill;
    		$jobskill = new JobpositionskillBase();
    		$jobskill->load($skilldata);
    		$jobskill->save(false);
    		
    		if(!isset($allskills[$skill]))
    		{
    			$sdata = array();
    			$sdata['SkillsBase']['parentid'] = 1;
    			$sdata['SkillsBase']['title'] = $skill;
     			$sdata['SkillsBase']['status'] = 0;
    			$sdata['SkillsBase']['createdate'] = $skilldata['JobpositionskillBase']['created'];
    			$sdata['SkillsBase']['updatedate'] = $skilldata['JobpositionskillBase']['created'];
    			
    			$skillModel = new SkillsBase();
    			$skillModel->load($sdata);
    			$skillModel->save(false);
    			
    		}
    		
    	}

    	$data['JobpositionBase']['country'] = isset($data['JobpositionBase']['country']) ? $data['JobpositionBase']['country'] : false;
    	$data['JobpositionBase']['city'] = isset($data['JobpositionBase']['city']) ? $data['JobpositionBase']['city'] : false;
    	$data['JobpositionBase']['postcode'] = isset($data['JobpositionBase']['postcode']) ? $data['JobpositionBase']['postcode'] : false;

    	PostcodeBase::add($data['JobpositionBase']['country'], $data['JobpositionBase']['city'], $data['JobpositionBase']['postcode']);

    	echo $message;
    	exit;
    }
    
    public function actionCheck()
    {
    	$params = $_POST;
    	 
    	if(!isset($params['mode']) || $params['mode'] == '')
    	{
    		echo 'invalid mode!';
    		exit;
    	}
    	 
    	$mode = $params['mode'];
    	 
    	$output = '';
    	switch ($mode)
    	{
    		case 'email_exists':
    			$checkemail = isset($params['data']) ? $params['data'] : false;
    			$currentid = isset($params['data1']) ? $params['data1'] : false;
    			if($checkemail)
    			{
    				$output = 'no';
    
    				$query = PersonaldecisionmakerBase::find()->select(['userid' , 'email'])->where(['like' , 'email' , $checkemail])->andWhere(['=' , 'userid' , $currentid]);
    				
    				$hasOne = $query->asArray()->all();
    				//print_r($hasOne); exit;
    				
    				if(count($hasOne) > 0)
    				{
    				    $output = 'no';
    				}
    				else 
    				{
    				    $query = PersonaldecisionmakerBase::find()->select(['userid' , 'email'])->where(['like' , 'email' , $checkemail]);
    				    if($currentid && intval($currentid) > 0)
    				    {
    				        $query->andWhere(['!=' , 'userid' , $currentid]);
    				    }
    				    $pdmDataModel = $query->all();
    				    
    				    foreach ($pdmDataModel as $item)
    				    {
    				        if(trim($checkemail) == trim($item->email))
    				        {
    				            $output = 'ok' . $item->userid;
    				            break;
    				        }
    				    }
    				}
    				
    				
    			}
    			else
    			{
    				$output = 'error-input' . PHP_EOL . serialize($params);
    			}
    	}
    	 
    	echo $output;
    	exit;
    }
    
    /**
     * Displays verify data page.
     *
     * @return mixed
     */
    public function actionVerify()
    {
    	if(count($_POST) && isset($_POST['ac']) && $_POST['ac'] == 'vr' && isset($_POST['ui']) && intval($_POST['ui']) > 0)
    	{
    		$userid = intval($_POST['ui']);
    		$companyid = intval($_POST['ci']);
    		
    		$model = UsersBase::findOne($userid);
    		$companyModel = CompanyBase::findOne($companyid);
    		$plist = $companyModel->personalDecisionMakerList();
    		 
    		$pdmModel = isset($plist[0]) ? $plist[0] : new PersonaldecisionmakerBase();
    		$pdmModelSecond = isset($plist[1]) ? $plist[1] : new PersonaldecisionmakerBase();
    		
    
    		$_POST['PersonaldecisionmakerBase']['updatedate'] = date('Y-m-d H:i:s');
    		$_POST['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
    		$_POST['UsersBase']['updatedate'] = date('Y-m-d H:i:s');
    		 
    		$password_original = $_POST['UsersBase']['password_hash'];
    		$_POST['CompanyBase']['founddate'] = (isset($_POST['CompanyBase']['founddate'])) ? BrainHelper::dateGermanToEnglish($_POST['CompanyBase']['founddate']) : '';
    		$_POST['PersonaldecisionmakerBase']['email'] = $_POST['UsersBase']['uname'];
    		$_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST['UsersBase']['password_hash']);
    		$_POST['UsersBase']['status'] = UsersBase::UserStatusActive;
    		 
    		$model->load($_POST);
    		$model->save(false);
    		 
    		$companyModel->load($_POST);
    		$companyModel->save(false);
    		 
    		$pdmModel->load($_POST);
    		$pdmModel->save(false);
    		 
    		$userid = $model->id;
    
    		$loginData = array();
    		$loginData['_csrf-frontend'] = $_POST['_csrf-frontend'];
    		$loginData['LoginForm']['username'] = $_POST['UsersBase']['uname'];
    		$loginData['LoginForm']['password'] = $password_original;
    		$loginData['LoginForm']['rememberMe'] = 1;
    
    		if(SiteController::doLogin($loginData))
    		{
    			FrontlogBase::addLog('Verify:' . $companyid, $userid, false);
    			 
    			return $this->redirect('dashboard?verify=ok');
    		}
    
    
    		 
    		 
    	}
    	 
    	$a = isset($_GET['a']) ? $_GET['a'] : false;
    	$b = isset($_GET['b']) ? $_GET['b'] : false;
    	 
    	if(!$a || !$b)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '1'] );
    	}
    	 
    	$verifydatab = base64_decode($b);
    	$verifydataa = base64_decode($a);
    
    	if(!$verifydatab || !$verifydataa)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '2'] );
    	}
    
    	$verifydatab = unserialize($verifydatab);
    	$verifydataa = unserialize($verifydataa);
    
    
    	if(!$verifydatab || !$verifydataa)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '3'] );
    	}
    	 
    	if(intval($verifydataa['uid']) <= 0 || $verifydataa['uid'] != $verifydatab['uid'])
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '4'] );
    	}
    
    	if(intval($verifydataa['utp']) != UsersBase::UserTypeCompany)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '5'] );
    	}
    
    	$date = date_create_from_format('Y-m-d', $verifydatab['checkuca']);
    	if(!$date)
    	{
    		//echo $verifydatab['checkuca'];
    		return $this->redirect(['/site/invalidpage' , 'msg' => '6'] );
    
    	}
    	$interval = date_diff($date, date_create());
    	 
    	if(intval($interval->format('%a')) > 1) {
    		$this->redirect(['/site/invalidpage' , 'msg' => urlencode(Yii::t('app', 'ungültige verifikation link!'))] );
    	}
    	 
    	$userid = intval($verifydataa['uid']);
    	 
    	$model = UsersBase::find()->where(['id' => $userid])->one();
    	$pdmModel = PersonaldecisionmakerBase::find()->where(['userid' => $userid])->one();
    	$companyModel = CompanyBase::find()->where(['id' => $pdmModel->companyid])->one();
    	
    	if(!$model || !$companyModel)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => 'u:' . $userid] );
    	}
    
    	//print_r($companyModel); exit;
    	/*$dbdate = $model->bdate;
    	$dbdate = trim(str_replace('00:00:00', '', $dbdate));
    	//$model->bdate = $dbdate;
    	$model->bdate = BrainHelper::dateEnglishToGerman($model->bdate);
    	 
    	$chkdate = trim(str_replace('00:00:00', '', $verifydatab['checkubd']));
    
    	if($dbdate != $chkdate)
    	{
    		return $this->redirect(['/site/invalidpage' , 'msg' => '9: ' . $dbdate. ' : ' . $chkdate] );
    	}*/
    
    	if($model->status != 4)
    	{
    		//$this->redirect(['site/invalidpage', 'msg' => urlencode(Yii::t('app', 'ungültige verifikation link!<br>Benutzer ist aktuell verifikatet!'))]);
    	}
    	 
    	$companyModel->founddate = BrainHelper::dateEnglishToGerman($companyModel->founddate);
    	 
    	return $this->render('verify' , [
    			'model' 			=> $model,
    			'companyModel' 		=> $companyModel,
    			'mode' 				=> 'verify1',
    	]);
    	 
    }
    
    public static function photo_path()
    {
    	return dirname(dirname(__FILE__)) . '/web/company_logo';
    }
    
    public static function company_logo($checkapproved = false)
    {
    	$model = Yii::$app->user->identity;
    	$companyModel = $model->company();
    	
    	$photopath = false;
    	$list = glob(self::photo_path() . '/' . $companyModel->id . '.*', GLOB_BRACE);
    	if(count($list))
    	{
    		$file = $list[0];
    		$photopath = Yii::getAlias('@web') . str_replace(dirname(dirname(__FILE__)), '', $file);
    	}
    	
    	if($checkapproved)
    	{
    		$filemodel = $photopath ? UploadedfilesBase::findOne(['file' => $photopath]) : NULL;
    		if($filemodel != null && $photopath)
    		{
    			$photopath = false;
    		}
    	}
    	return $photopath;
    }
    
    
}
