<?php
namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\lib\SkillsBase;
use common\lib\UsersBase;
use common\lib\JobpositionBaseSearch;
use common\lib\JobpositionBase;
use common\lib\PostcodeBase;
use common\lib\CityBase;
use common\lib\CountryBase;
use common\helper\BrainStaticList;
use common\helper\BrainHelper;
use common\lib\CandidatefavoriteBase;
use common\lib\CandidatejobapplyBase;
use common\lib\CallrequestBase;
use common\lib\JobpositionseenBase;

/**
 * Site controller
 */
class SiteControllerOld extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
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
    	 
    	$isfinished = false;
    	$total = 0;
    	$jobModels = $this->lastNJob(-1, 3, $isfinished, $total);
    	 
    	$jobitems = $this->renderPartial('index_job_item', [
    			'jobpositionModels'		=> $jobModels,
    			'isfinish'				=> $isfinished,
    	]);
    	 
    	$postcodes = PostcodeBase::allPostcodes();
    	$cities = CityBase::allCities();
    	//$countries = CountryBase::allCountries();
    
    	//$places = array_merge($postcodes, $cities, $countries);
    	$places = array_merge($postcodes, $cities);
    
    	return $this->render('index', [
    			'jobitems'				=> $jobitems,
    			'places'				=> $places,
    	]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndexold()
    {
    	 
    	$isfinished = false;
    	$total = 0;
    	$jobModels = $this->lastNJob(-1, 3, $isfinished, $total);
    	 
    	$jobitems = $this->renderPartial('index_job_item', [
    			'jobpositionModels'		=> $jobModels,
    			'isfinish'				=> $isfinished,
    	]);
    	 
    	$postcodes = PostcodeBase::allPostcodes();
    	$cities = CityBase::allCities();
    	//$countries = CountryBase::allCountries();
    
    	//$places = array_merge($postcodes, $cities, $countries);
    	$places = array_merge($postcodes, $cities);
    
    	return $this->render('index-old', [
    			'jobitems'				=> $jobitems,
    			'places'				=> $places,
    	]);
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionBranch($type)
    {
    
    	/*$isfinished = false;
    	$total = 0;
    	$jobModels = $this->lastNJob(-1, 3, $isfinished, $total);
    
    	$jobitems = $this->renderPartial('index_job_item', [
    			'jobpositionModels'		=> $jobModels,
    			'isfinish'				=> $isfinished,
    	]);
    
    	$postcodes = PostcodeBase::allPostcodes();
    	$cities = CityBase::allCities();
    	//$countries = CountryBase::allCountries();
    
    	//$places = array_merge($postcodes, $cities, $countries);
    	$places = array_merge($postcodes, $cities);*/
    
    	$file = 'branch-' . $type;
    	
    	return $this->render($file, [
    			//'jobitems'				=> $jobitems,
    			//'places'				=> $places,
    	]);
    }
    
    /**
     * Displays lastjobs.
     *
     * @return mixed
     */
    public function actionLastjobs()
    {
    	
    	$isfinished = false;
    	$total = 0;
    	$jobModels = $this->lastNJob(-1, 8, $isfinished, $total);
    	
    	$jobitems = $this->renderPartial('index_job_item', [
    			'jobpositionModels'		=> $jobModels,
    			'isfinish'				=> $isfinished,
    	]);
    	
    	return $this->render('lastjobs', [
    			'jobpositionModels'		=> $jobModels,
    			'jobitems'				=> $jobitems,
    	]);
    }
    
    /**
     * Displays lastjobs.
     *
     * @return mixed
     */
    public function actionSearchjobs()
    {
        
        $skills = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1])->orderBy('title')->all();
        $skills = BrainHelper::mapTranslate($skills, 'id', 'title');
        
        $postcodes = PostcodeBase::allPostcodes();
        $cities = CityBase::allCities();
        //$countries = CountryBase::allCountries();
        
        //$places = array_merge($postcodes, $cities, $countries);
        $places = array_merge($postcodes, $cities);
        
        $worktypes_array = BrainStaticList::workTypeList(true, Yii::t('app', '   kein Beschäftigungsart   '));
        $jobypes_array = BrainStaticList::jobTypeList(true, Yii::t('app', '   keine Branche   '));
        $vacancy_array = BrainStaticList::vacancyList(true, Yii::t('app', '   keine Beschäftigungsverhältnis   '));
        
        
        $jobModels = false;
        $jobitems = false;
        $itemstitle = false;
        $ort = false;
        $text = false;
        $jobtype = false;
        $worktype = false;
        $vacancy = false;
        $advanced = false;
        $isfinished = false;
        
        
        return $this->render('searchjobs', [
            'jobpositionModels'		=> $jobModels,
            'jobitems'				=> $jobitems,
            'itemstitle'			=> $itemstitle,
            'ort'					=> $ort,
            'text'					=> $text,
            'jobtype'				=> $jobtype,
            'worktype'				=> $worktype,
            'vacancy'				=> $vacancy,
            'places'				=> $places,
            'advanced'				=> $advanced,
            'worktypes'				=> $worktypes_array,
            'jobypes'				=> $jobypes_array,
            'vacancies'				=> $vacancy_array,
            'isfinish'				=> $isfinished,
            'skills'				=> $skills,
        ]);
    }
    
        /**
     * Displays lastjobs.
     *
     * @return mixed
     */
    public function actionSearchjobitems()
    {
        
        $data = ['finish' => true, 'title' => Yii::t('app', 'Keine Ergebnisse'), 'items' => false];
        
        if(isset($_GET['dosearch']))
        {
        	$ort = isset($_GET['so']) ? $_GET['so'] : false;
        	$text = isset($_GET['st']) ? $_GET['st'] : false;
        	$jobtype = isset($_GET['jt']) ? $_GET['jt'] : false;
        	$worktype = isset($_GET['wt']) ? $_GET['wt'] : false;
        	$vacancy = isset($_GET['vk']) ? $_GET['vk'] : false;
        	 
        	$isfinished = false;
        	$total = 0;
        	$jobModels = $this->lastNJob(-1, 8, $isfinished, $total);
        	 
        	$itemstitle = '';
        	
        	$itemstitle = ($total > 0 ? $total : Yii::t('app', 'Keine ')) . ' ' . Yii::t('app', 'Ergebnisse ') . '<br>' . Yii::t('app', 'für Ihre Suche ');
    	    if($text)
    		{
    			$itemstitle .= Yii::t('app', 'nach ') . '"' . $text . '" ';
    		}
    	    if($ort)
    		{
    			$itemstitle .= Yii::t('app', 'in ') . '"' . $ort . '" ';
    		}
        	
        	
        	$jobItemTemplate = $this->renderPartial('job_item');
        	
        	$items = [];
        	foreach ($jobModels as $jobindex => $jobpositionModel) {
        	    $jobtitle = strlen($jobpositionModel->title) > 32 ? substr($jobpositionModel->title , 0 , 30) . ' ...' : $jobpositionModel->title;
        	    $items[] = ['id' => $jobpositionModel->id, 'title' => $jobtitle, 'index' => $jobindex , 'city' => $jobpositionModel->city, 'country' =>$jobpositionModel->country]; 
        	}
        	
        	$data = ['finish' => $isfinished, 'title' => $itemstitle, 'items' => $items, 'itemTemplate' => $jobItemTemplate];
		
        	
        }
        
        //$data = array($data);
        
        //echo 'angular.callbacks._0(';
        echo json_encode($data);
        //echo ');';
        exit;
    }
    
    /**
     * render next $count job.
     *
     * @return mixed
     */
    public function actionNextjob($last, $count)
    {
    	$isfinished = false;
    	$total = 0;
    	$jobModels = $this->lastNJob($last, $count, $isfinished, $total);
    	
    	return $this->renderPartial('index_job_item', [
    			'jobpositionModels'		=> $jobModels,
    			'isfinish'				=> $isfinished,
    	]);
    }
    
    private function lastNJob($last, $count, &$isfinished, &$total)
    {
    	$searchModel = new JobpositionBaseSearch();
    	$searchModel->status = 1;        

    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams , array('createdate' => SORT_DESC));
    	$allJobModels = $dataProvider->getModels();
    	$total = count($allJobModels);
    	
    	$jobModels = array();
    	$i = $last + 1;
    	while(count($jobModels) < $count && count($allJobModels) > $i)
    	{
    		$jobModels[$i] = $allJobModels[$i];
    		$i ++;
    	}
    	
    	$isfinished = count($jobModels) < $count;
    	
    	return $jobModels;
    }
    
    /**
     * Displays job details.
     *
     * @return mixed
     */
    public function actionJobview($id)
    {
    	//print_r($_SERVER); exit;
    	
    	$jobModel = JobpositionBase::findOne(['id' => $id]);
    	$favModel = (isset(Yii::$app->user->identity))? CandidatefavoriteBase::findOne(['userid' => Yii::$app->user->identity->id, 'jobposid' => $id]) : false;
    	$applyModel = (isset(Yii::$app->user->identity))? CandidatejobapplyBase::findOne(['userid' => Yii::$app->user->identity->id, 'jobposid' => $id]) : false;
    	 
    	$seen = new JobpositionseenBase();
    	$seen->jobpos = $id;
    	$seen->createdate = date('Y-m-d H:i:s');
    	$seen->seenuserid = Yii::$app->user->isGuest == false && Yii::$app->user->identity ? Yii::$app->user->identity->id : 0;
    	$seen->ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-');
    	$seen->save(false);
    	
    	return $this->render('jobview.php', [
    			'id'				=> $id,
    			'jobModel'			=> $jobModel,
    			'favModel'			=> $favModel,
    			'applyModel'		=> $applyModel,
    			 
    	]);
    }
    
    
    /**
     * Displays Personal pages.
     *
     * @return mixed
     */
    public function actionEmleasing()
    {
    	return $this->render('emleasing');
    }

    /**
     * Displays Personal pages.
     *
     * @return mixed
     */
    public function actionEmadopte()
    {
    	return $this->render('emadopte');
    }

    /**
     * Displays Personal pages.
     *
     * @return mixed
     */
    public function actionEmrecruitment()
    {
    	return $this->render('emrecruitment');
    }

    /**
     * Displays Personal pages.
     *
     * @return mixed
     */
    public function actionEmmedical()
    {
    	return $this->render('emmedical');
    }
    
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInvalidpage()
    {
    	return $this->render('invalidpage');
    }
    
    public function actionTest()
    {
        return $this->render('test');
    }

	/**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
  
        if(self::doLogin(Yii::$app->request->post() , $model))
        {
        	$this->redirect('index');
        }
        
        return $this->render('login', [
        		'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionRegisterbew()
    {
        return $this->render('registerbew');
    }
    
    public function actionCallrequest()
    {
    	//$name = $_POST['name'];
    	//$tel = $_POST['tel'];
    	//$message = $_POST['message'];
    	//echo $name. ', ' . $tel . ', ' . $message;
    	$_POST['CallrequestBase']['createdate'] = date('Y-m-d H:i:s');
    	
    	$req = new CallrequestBase();
    	$req->load($_POST);
    	if($req->save(false))
    	{
    		echo 'ok';
    	}
    	else 
    	{
    		echo 'fail';
    	}
    	
    	
    	exit;
    }
    
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionRegisterunter()
    {
    	return $this->render('registerunter');
    }

    /**
     * Displays What we do page.
     *
     * @return mixed
     */
    public function actionWhatwedo()
    {
    	return $this->render('whatwedo', ['part' => 0, ]);
    }

    /**
     * Displays What we do page.
     *
     * @return mixed
     */
    public function actionTemporarywork()
    {
    	return $this->render('temporarywork');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
    	 
    
    	return $this->render('about', ['isindex' => false]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAboutnew()
    {
    	 
    
    	return $this->render('aboutnew', ['isindex' => false]);
    }
    
     /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAllbranches()
    {
    	

    	return $this->render('allbranches', ['isindex' => false]);
    }
    
	/**
     * Displays carrier page.
     *
     * @return mixed
     */
    public function actionCarrier()
    {
    	$searchModel = new JobpositionBaseSearch();
    	$searchModel->status = 1;
    	
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams , array('createdate' => SORT_DESC), true, true);
    	$allJobModels = $dataProvider->getModels();

    	return $this->render('carrier', [
    			'jobModels' => $allJobModels
    	]);
    }
    
/**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionNewpassword()
    {
        if(!isset($_GET['a']) || !isset($_GET['a']))
        {
        	return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage');	
        }
        
        $dataa = $_GET['a'];
        $datab = $_GET['b'];
        
            $dataa = base64_decode($dataa);
        $datab = base64_decode($datab);
        
        if(!$dataa || !$datab)
        {
        	return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage');
        }
        
        $dataa = unserialize($dataa);
        $datab = unserialize($datab);
        
        if(!$dataa || !$datab)
        {
        	return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage');
        }
        
        if(!isset($dataa['uid']) || intval($dataa['uid']) == 0 || !isset($datab['checkuca']))
        {
        	return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage');
        }
        
        $ichkdate = strtotime($datab['checkuca']);
        
        if(!$ichkdate)
        {
        	return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage');
        }
        
        $diff = strtotime(date('Y-m-d H:i:s')) - $ichkdate;
        
        if($diff > 24 * 60 * 60)
        {
        	//return $this->redirect(Yii::getAlias('@web') . '/site/invalidpage?msg=diff' . $diff);
        }
        
        
        $message = '';
        $model = UsersBase::findOne(['id' => $dataa['uid']]);
        
        
        
        if (count($_POST) && isset($_POST['UsersBase']['password_hash']))
        {
        	$_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST['UsersBase']['password_hash']);
        	
        	$model->load($_POST);
        	$model->save(false);
        	
        	return $this->redirect(Yii::getAlias('@web') . '/site/login');
        }

        return $this->render('newpassword', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetpassword()
    {
        
        $model = new UsersBase();
        
//Leider ist die von Ihnen eingegebene Email-Adresse nich bekannt
		$message = '';
		//print_r($_POST);
        if (count($_POST) && isset($_POST['UsersBase']['uname'])) {
            //Yii::$app->session->setFlash('success', 'New password was saved.');
        	$model = UsersBase::findOne(['uname' => $_POST['UsersBase']['uname']]);
        	if($model == null)
        	{
        		$model = new UsersBase();
        		$message = Yii::t('app', 'Leider ist die von Ihnen eingegebene Email-Adresse nich bekannt');
        	}
        	else 
        	{
        		$verifydata = array();
        		$verifydata['uid'] = $model->id;
        		$verifydata['uem'] = $model->uname;
        		
        		$verifydataa = serialize($verifydata);
        		$verifydataa = base64_encode($verifydataa);
        		
        		$verifydata['checkubd'] = $model->bdate;
        		$verifydata['checkuca'] = date('Y-m-d');
        		
        		$verifydatab = serialize($verifydata);
        		$verifydatab = base64_encode($verifydatab);
        		
        		$verifyurl =  "http://" . $_SERVER['HTTP_HOST'] . str_replace('/resetpassword' , '/newpassword' , $_SERVER['REDIRECT_URL']);
        		$verifyurl .= '?a=' . urlencode($verifydataa) . '&b=' . urlencode($verifydatab);
        		$verifytextfile = dirname(__DIR__). '/views/candidate/newpasswordtext.php';
        		$emailbody = file_get_contents($verifytextfile);
        		$emailbody = str_replace('%link', $verifyurl, $emailbody);
        		
        		$empfaenger = $model->uname;
        		$betreff = 'Job2Job Passwort anfordern ...';
        		$nachricht = 'Hallo';
        		$header = 'From: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
        				'Reply-To: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
        				'Content-Type: text/html; charset=UTF-8\r\n'.
        				'X-Mailer: PHP/' . phpversion();
        		
        		mail($empfaenger, $betreff, $emailbody, $header);
        		
        		
        		//return $this->goHome();
        		$message = Yii::t('app', 'Ein E-Mail wird nach %em geschickt. Drin gibt ein link Ihr Passwort zu ändern.');
        		$message = str_replace('%em' , '<b>' . $model->uname . '</b>', $message);
        	}
            
        }

        return $this->render('resetPassword', [
            'model' => $model,
            'message' => $message,
        ]);
    }
    /**
     * Displays job details.
     *
     * @return mixed
     */
    public function actionCertificates()
    {
    	$pdfList = array();
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert1.png' , 'title' => 'title 1', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert1.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert2.png' , 'title' => 'title 2', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert2.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert3.png' , 'title' => 'title 3', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert3.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert4.png' , 'title' => 'title 4', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert4.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert5.png' , 'title' => 'title 5', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert5.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert6.png' , 'title' => 'title 6', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert6.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert7.png' , 'title' => 'title 7', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert7.pdf', );
    	$pdfList[] = array('image' => Yii::getAlias('@web') . '/web/certificates/cert8.png' , 'title' => 'title 8', 'desc' => 'description 1', 'file' => Yii::getAlias('@web') . '/web/certificates/cert8.pdf', );
    	
    	return $this->render('certificates', [
    			'pdfList'		=> $pdfList,
    			
    	]);
    }
    

    /**
     * All Postcodes as json.
     *
     * @return mixed
     */
    public function actionAllcities()
    {
    
    	$postcodes = CityBase::allCities(true);
    	 
    	$allcodes = array();
    	foreach ($postcodes as $name => $name){
    
    		$allcodes[] = ['value' => $name, 'label' => $name];
    
    	}
    	echo 'angular.callbacks._0(';
    	echo json_encode($allcodes);
    	echo ');';
    	exit;
    }

    /**
     * All Postcodes as json.
     *
     * @return mixed
     */
    public function actionAllpostcodes()
    {
    
    	$postcodes = PostcodeBase::allPostcodes(true);
    
    	$allcodes = array();
    	foreach ($postcodes as $postcode => $city){
    
    		$allcodes[] = ['value' => $postcode, 'label' => $city . ' - ' . $postcode, 'city' => $city];
    
    	}
    
    	echo 'angular.callbacks._0(';
    	echo json_encode($allcodes);
    	echo ');';
    	 
    	exit;
    }

    /**
     * All places as json.
     *
     * @return mixed
     */
    public function actionAllplaces()
    {
    
    	$postcodes = PostcodeBase::allPostcodes(true);
    	    	
    	$allcodes = array();
    	$lastCity = '';
    	foreach ($postcodes as $postcode => $city){
    	    
    	    
    	    if($lastCity != $city && $lastCity != '')
    	    {
    	        $allcodes[] = ['value' => $city, 'label' => $city];
    	    }
    	    $allcodes[] = ['value' => $postcode, 'label' => $city . ' - ' . $postcode, 'city' => $city];
    	    
    	    $lastCity = $lastCity != $city ? $city : $lastCity;
    	}
    	
    	
    	
    	echo 'angular.callbacks._0(';
    	echo json_encode($allcodes);
    	echo ');';
    	 
    	exit;
    }
    
    public static function doLogin($loginData , $model = false)
    {
    	$model = $model ? $model : new LoginForm();
    
    	if(count($loginData) > 0)
    	{
    		if ($model->load($loginData)) {
    
    			if($model->login())
    			{
    				return true;
    			}
    		}
    	}
    	return false;
    }
}
