<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\ContactForm;
use common\lib\SkillsBase;
use common\lib\UsersBase;
use common\lib\JobpositionBaseSearch;
use common\lib\PostcodeBase;
use common\lib\CityBase;
use common\helper\BrainHelper;
use common\lib\WorktimemodelBase;
use common\lib\CandidateBase;
use common\lib\FrontlogBase;
use common\lib\CompanyBase;
use common\lib\PersonaldecisionmakerBase;
use common\lib\BranchBase;
use common\lib\JobpositionBase;
use common\lib\VacancyBase;
use common\lib\CandidatefavoriteBase;
use common\lib\CandidatejobapplyBase;
use common\lib\RecommendationBase;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     *
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'logout',
                    'signup'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'signup'
                        ],
                        'allow' => true,
                        'roles' => [
                            '?'
                        ]
                    ],
                    [
                        'actions' => [
                            'logout'
                        ],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [ 
                    'jobcount' => ['post'],
                    'dosearchjobs' => ['post'],
                ]
            ],
           
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
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
        $jobModels = $this->lastNJob(- 1, 4, $isfinished, $total);

        $recommendations = [];
        $recommendationsCandidate = RecommendationBase::find()->where(['iscandidate' => 1])->orderBy(['updated' => SORT_DESC])->limit(4)->all();
        $recommendationsCompany = RecommendationBase::find()->where(['iscandidate' => 0])->orderBy(['updated' => SORT_DESC])->limit(4)->all();
        
        $companyIndex = 0;
        $candidateIndex = 0;
        while(count($recommendations) < 4 && ($candidateIndex < 4 || $companyIndex < 4)){
            
            if(count($recommendationsCandidate) > $candidateIndex){
                $recommendations[] = $recommendationsCandidate[$candidateIndex];
                $candidateIndex++;
            }
            
            if(count($recommendationsCompany) > $companyIndex){
                $recommendations[] = $recommendationsCompany[$companyIndex];
                $companyIndex ++;
            }
            
        }
        
        
        return $this->render('index', [
            'jobModels' => $jobModels,
            'recommendations' => $recommendations,
            
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionCandidate()
    {
        //$isfinished = false;
        //$total = 0;
        //$jobModels = $this->lastNJob(- 1, 4, $isfinished, $total);

        $branches = BranchBase::find()->where(['status' => 1])->all();
        
        $searchModel = new JobpositionBaseSearch();
        $searchModel->status = 1;
        
        $recommendations = RecommendationBase::find()->where(['iscandidate' => 1])->orderBy(['updated' => SORT_DESC])->limit(4)->all();
        
        $jobs = array();
        foreach($branches as $branch){
            $allJobModels = $searchModel->searchBranches($branch->id, 3);
            
            //$allJobModels = $dataProvider->getModels();
            
            $jobs[] = count($allJobModels) > 0 ? $allJobModels[0] : false;
        }
        return $this->render('candidate', [
            "jobs" => $jobs,
            'branches' => $branches,
            'recommendations' => $recommendations,
            
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionCompany()
    {
        $branches = BranchBase::find()->where(['status' => 1])->all();
        $vacancies = VacancyBase::find()->where(['status' => 1])->all();
        
        $recommendations = RecommendationBase::find()->where(['iscandidate' => 0])->orderBy(['updated' => SORT_DESC])->limit(4)->all();        
        
        return $this->render('company', [
            'vacancies' => $vacancies,
            'branches' => $branches,
            'recommendations' => $recommendations,
            
        ]);
    }

    /**
     * Displays about.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about', [
            'isindex' => false
        ]);
    }

    /**
     * Displays about.
     *
     * @return mixed
     */
    public function actionCarrier()
    {
        $searchModel = new JobpositionBaseSearch();
        $searchModel->status = 1;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, array(
            'createdate' => SORT_DESC
        ), true, true);
        $allJobModels = $dataProvider->getModels();
        
        return $this->render('carrier', [
            'jobModels' => $allJobModels,
        ]);
    }

    /**
     * Displays certificates.
     *
     * @return mixed
     */
    public function actionCertificates()
    {
        $pdfList = array();
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert1.png',
            'title' => 'title 1',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert1.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert2.png',
            'title' => 'title 2',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert2.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert3.png',
            'title' => 'title 3',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert3.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert4.png',
            'title' => 'title 4',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert4.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert5.png',
            'title' => 'title 5',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert5.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert6.png',
            'title' => 'title 6',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert6.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert7.png',
            'title' => 'title 7',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert7.pdf'
        );
        $pdfList[] = array(
            'image' => Yii::getAlias('@web') . '/web/certificates/cert8.png',
            'title' => 'title 8',
            'desc' => 'description 1',
            'file' => Yii::getAlias('@web') . '/web/certificates/cert8.pdf'
        );

        return $this->render('certificates', [
            'pdfList' => $pdfList

        ]);
    }

    /**
     * Displays brachs detail.
     *
     * @return mixed
     */
    public function actionBranchview($t, $b)
    {
        $branchModel = BranchBase::findFromShortcut($b);

        $searchModel = new JobpositionBaseSearch();
        $searchModel->status = 1;

        $jobModels = $t == 'candidate' ? $searchModel->searchBranches($branchModel->id, 4) : false;
        
        return $this->render('branch-' . $b . '-' . $t, [
            "jobModels" => $jobModels,
            "shortCut" => $b,
            
        ]);
    }

    /**
     * Displays lastjobs.
     *
     * @return mixed
     */
    public function actionSearchjobs()
    {
        $skills = SkillsBase::find()->where([
            'status' => 1
        ])->orderBy('title')->all();
        $regins = JobpositionBase::allRegions();
        
        $skills = BrainHelper::mapTranslate($skills, 'id', 'title');
        $vacances = VacancyBase::find()->all();
        $branches = BranchBase::find()->where(['status' => 1])->all();
        
        
        $searchText = isset($_POST["searchedText"]) ? $_POST["searchedText"] : "";
        $searchBranchShortcut = isset($_POST["searchBranch"]) ? $_POST["searchBranch"] : false;
        $searchBranch = $searchBranchShortcut ? BranchBase::findOne(['shortcut' => $searchBranchShortcut]) : false;
        $searchBranch = $searchBranch ? $searchBranch->id : false;
        
        return $this->render('searchjobs', [
            'skills' => $skills,
            'regins' => $regins,
            'vacances' => $vacances,
            'branches' => $branches,
            'searchText' => $searchText,
            'searchBranch' => $searchBranch,
        ]);
    }

    /**
     * Displays Whyjob2job.
     *
     * @return mixed
     */
    public function actionWhyjob2job()
    {
        return $this->render('whyjob2job', []);
    }

    /**
     * Displays freelance.
     *
     * @return mixed
     */
    public function actionFreelance()
    {
        return $this->render('freelance', []);
    }

    /**
     * Displays Impressum.
     *
     * @return mixed
     */
    public function actionImpressum()
    {
        return $this->render('impressum', []);
    }

    /**
     * Displays Whoweare.
     *
     * @return mixed
     */
    public function actionPersonaladoption()
    {
        return $this->render('personaladoption');
    }
    
    public function actionPersonalrecruitment()
    {
        return $this->render('personalrecruitment');
    }
    
    public function actionTemporarywork()
    {
        return $this->render('temporarywork');
    }
    
    /**
     * Displays Whoweare.
     *
     * @return mixed
     */
    public function actionWhoweare()
    {
        return $this->render('whoweare', []);
    }

    /**
     * Displays Whoweare.
     *
     * @return mixed
     */
    public function actionWhatwedo()
    {
        return $this->render('whatwedo', [
            'part' => 0
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if (Yii::$app->request->post()) {
            // print_r(Yii::$app->request->post()); exit;
        }

        if (self::doLogin(Yii::$app->request->post(), $model)) {
            $this->redirect('index');
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionRegister()
    {
        if (! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (count($_POST) > 0) {

            $model = new UsersBase();
            $model->bdate = '1980-01-01';

            $_POST['UsersBase']['uname'] = $_POST["data"]['email'];
            $_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST["data"]['password']);
            $_POST['UsersBase']['fname'] = $_POST["data"]['fname'];
            $_POST['UsersBase']['lname'] = $_POST["data"]['lname'];
            $_POST['UsersBase']['usertype'] = $_POST["data"]["regtype"] == 1 ? UsersBase::UserTypeCandidate : UsersBase::UserTypeCompany;
            $_POST['UsersBase']['group'] = 2;
            $_POST['UsersBase']['permission'] = 2;
            $_POST['UsersBase']['status'] = UsersBase::UserStatusApprove;
            $_POST['UsersBase']['bdate'] = date("Y-m-d");
            $_POST['UsersBase']['createdate'] = date("Y-m-d H:i:s");

            $model->load($_POST);
            $model->save(false);

            $userid = $model->id;

            if ($_POST["data"]["regtype"] == 1) {
                $candidateModel = new CandidateBase();

                $_POST['CandidateBase']['userid'] = $userid;
                $_POST['CandidateBase']['email'] = $_POST["data"]['email'];
                $_POST['CandidateBase']['pcode'] = $_POST["data"]['postcode'];
                $_POST['CandidateBase']['city'] = $_POST["data"]['city'];
                $_POST['CandidateBase']['homenumber'] = $_POST["data"]['homenumber'];
                $_POST['CandidateBase']['street'] = $_POST["data"]['street'];
                $_POST['CandidateBase']['address1'] = "";
                $_POST['CandidateBase']['tel'] = $_POST["data"]['tel'];
                $_POST['CandidateBase']['branch'] = $_POST["data"]['branch'];
                $_POST['CandidateBase']['jobtype'] = $_POST["data"]['jobtype'];
                $_POST['CandidateBase']['title'] = $_POST["data"]['gender'] == "m" ? "Herr" : "Frau";

                $candidateModel->load($_POST);
                $candidateModel->save(false);
            }

            if ($_POST["data"]["regtype"] == 2) {
                $companyModel = new CompanyBase();
                $pdmModel = new PersonaldecisionmakerBase();

                $_POST['CompanyBase']['companyname'] = $_POST["data"]['companyname'];
                $_POST['CompanyBase']['founddate'] = '2000-01-01';
                $_POST['CompanyBase']['companytype'] = 0;
                $_POST['CompanyBase']['steueid'] = '';
                $_POST['CompanyBase']['employeecount'] = 0;
                $_POST['CompanyBase']['pcode'] = $_POST["data"]['postcode'];
                $_POST['CompanyBase']['city'] = $_POST["data"]['city'];
                $_POST['CompanyBase']['homenumber'] = $_POST["data"]['homenumber'];
                $_POST['CompanyBase']['street'] = $_POST["data"]['street'];
                $_POST['CompanyBase']['address1'] = "";
                $_POST['CompanyBase']['status'] = 1;

                $companyModel->load($_POST);
                $companyModel->save(false);

                $companyid = $companyModel->id;

                $_POST['PersonaldecisionmakerBase']['userid'] = $userid;
                $_POST['PersonaldecisionmakerBase']['companyid'] = $companyid;
                $_POST['PersonaldecisionmakerBase']['title'] = $_POST["data"]['gender'] == "m" ? "Herr" : "Frau";
                $_POST['PersonaldecisionmakerBase']['isdeputy'] = 0;
                $_POST['PersonaldecisionmakerBase']['email'] = $_POST['UsersBase']['uname'];
                $_POST['PersonaldecisionmakerBase']['createdate'] = date('Y-m-d');
                $_POST['PersonaldecisionmakerBase']['tel'] = $_POST["data"]['tel'];
                $pdmModel->load($_POST);
                $pdmModel->save(false);
            }

            $verifydata = array();
            $verifydata['uid'] = $userid;
            $verifydata['utp'] = $_POST['UsersBase']['usertype'];

            $verifydataa = serialize($verifydata);
            $verifydataa = base64_encode($verifydataa);

            $verifydata['checkubd'] = $_POST['UsersBase']['bdate'];
            $verifydata['checkuca'] = $_POST['UsersBase']['createdate'];

            $verifydatab = serialize($verifydata);
            $verifydatab = base64_encode($verifydatab);

            $verifyurl = "http://" . $_SERVER['HTTP_HOST'] . str_replace('/site/register', '/' . ($_POST["data"]["regtype"] == 1 ? 'candidate' : 'company') . '/verify', $_SERVER['REDIRECT_URL']);
            $verifyurl .= '?a=' . urlencode($verifydataa) . '&b=' . urlencode($verifydatab);
            $verifytextfile = dirname(__DIR__) . '/views/site/verifytext.php';
            $emailbody = file_get_contents($verifytextfile);
            $emailbody = str_replace('%link', $verifyurl, $emailbody);

            $empfaenger = $_POST["data"]['email'];
            $betreff = Yii::$app->params['registerresponse_sender_title'];

            $header = 'From: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" . 'Reply-To: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" . 'Content-Type: text/html; charset=UTF-8\r\n' . 'X-Mailer: PHP/' . phpversion();

            mail($empfaenger, $betreff, $emailbody, $header);

            FrontlogBase::addLog('Register:' . $userid, $userid, true);

            return $this->redirect("registered"); // >render('register_resp', []);

            exit();
        }

        return $this->render('register', [
            // 'model' => $model,
            'workModels' => WorktimemodelBase::allActive(),
            'emailMessage' => "Das E-Mail ist ungültig. Bitte geben Sie ihr E-Mail an!",
            'emailExistsMessage' => "Das E-Mail existiert in unserem Datenbank. Bitte geben Sie anderes E-Mail an!",
            'passwordMessage' => "Kennwort Muss mindestens eine Zahl und einen Groß- und Kleinbuchstaben und mindestens 6 oder mehr Zeichen enthalten!",
            'password2Message' => "Die Passwörter stimmen nicht überein!",
            'acceptMessage' => "Bitte stimmen Sie die Nutzungsbedingungen und die Datenschutzerklärung!",
            'fnameMessage' => "Bitte geben Sie ihre Vorname an!",
            'lnameMessage' => "Bitte geben Sie ihre Vorname an!",
            'emptypeMessage' => "Bitte geben Sie ihre gewünschte Anstellungart an!",
            'branchMessage' => "Bitte geben Sie ihre gewünschte Branche an!",
            'companynameMessage' => "Bitte geben Sie den Firmenname an!"
        ]);
    }

    public function actionRegistered()
    {
        return $this->render('register_resp', []);
    }

    public function actionEmailcheck($email)
    {
        $model = UsersBase::findAll([
            'uname' => $email
        ]);

        print(count($model) > 0 ? 'ok' : 'no');
        exit();
    }
    
    public function actionJobcount()
    {
        header('Content-type: application/json');
        $this->layout=false;
        
        $params = Yii::$app->getRequest()->getBodyParams();
                
        $search = new JobpositionBaseSearch();
        $out = $search->searchCount($params);
        
        
         echo json_encode($out);
        exit();
    }
    
    public function actionDosearchjobs()
    {
        header('Content-type: application/json');
        $this->layout=false;
        
        $params = Yii::$app->getRequest()->getBodyParams();
                
        $search = new JobpositionBaseSearch();
        
        $results = $search->searchInPage($params, $params["selectedSortOption"]);
        
        
        $totalLoaded = $params["loadedCount"];
        
        $count = count($results);
        
        $results = array_slice($results, $totalLoaded, 8); 
        
        $results = ['data' => $results, 'count' => $count, 'isMoreJobs' => $totalLoaded + count($results) < $count];
        
        echo json_encode($results);
        exit;
    }
    
    public function actionJobview($id)
    {
        $job = JobpositionBase::findOne(['id' => $id]);
        $isFavorite = (isset(Yii::$app->user->identity))? CandidatefavoriteBase::isFavorite(Yii::$app->user->identity->id, $id) : false;
        $isApplied = (isset(Yii::$app->user->identity))? CandidatejobapplyBase::isApplied(Yii::$app->user->identity->id, $id) : false;
        
        
        return $this->render('jobview', [
            'jobModel' => $job,
            'isFavorite' => $isFavorite,
            'isApplied' => $isApplied,
            
        ]);
    }
    
    public function actionTest()
    {
        return $this->render('test', []);
    }
    
    public function actionTestshape()
    {
        return $this->render('testshape', []);
    }
    
    public function actionRegisterresponse()
    {
        return $this->render('register_resp', []);
    }
    
    public function actionOurcommitment()
    {
        return $this->render('ourcommitment', []);
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
                'model' => $model
            ]);
        }
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
        foreach ($postcodes as $name => $name) {

            $allcodes[] = [
                'value' => $name,
                'label' => $name
            ];
        }
        echo 'angular.callbacks._0(';
        echo json_encode($allcodes);
        echo ');';
        exit();
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
        foreach ($postcodes as $postcode => $city) {

            $allcodes[] = [
                'value' => $postcode,
                'label' => $city . ' - ' . $postcode,
                'city' => $city
            ];
        }

        echo 'angular.callbacks._0(';
        echo json_encode($allcodes);
        echo ');';

        exit();
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
        foreach ($postcodes as $postcode => $city) {

            if ($lastCity != $city && $lastCity != '') {
                $allcodes[] = [
                    'value' => $city,
                    'label' => $city
                ];
            }
            $allcodes[] = [
                'value' => $postcode,
                'label' => $city . ' - ' . $postcode,
                'city' => $city
            ];

            $lastCity = $lastCity != $city ? $city : $lastCity;
        }

        echo 'angular.callbacks._0(';
        echo json_encode($allcodes);
        echo ');';

        exit();
    }

    private function createSearchQuery($params, $getCount){
        
        
        $searchTextList = array_filter(explode(" ", $params["searchText"]), create_function('$value', 'return $value !== "";'));
        
        //print_r($params["region"]) . PHP_EOL;
        //print_r($params["skills"]) . PHP_EOL;
        //print_r($params["vacancies"]) . PHP_EOL;
        //print_r($params["branches"]) . PHP_EOL;
        //print_r($searchTextList) . PHP_EOL;
        //print_r(count($searchTextList)) . PHP_EOL;
        
        $countries = array_keys($params["region"]);
        
        $query = JobpositionBase::find();
        if($getCount){
            $query->select(['count(DISTINCT id) as jobCount']);
        }
        else{
            $query->select(['j2j_jobposition.*']);
        }
        $query->leftJoin('j2j_jobpositionskill', 'j2j_jobpositionskill.jobid = j2j_jobposition.id')
        ->Where(['status' => 1]);
        $textFilterArray = false;
        
        foreach ($searchTextList as $searchText){
            $likeSearchText = '%' . trim($searchText) . '%';
            $orItem = ['or', ['like', 'title' , trim($searchText)], ['like', 'subtitle' , trim($searchText)]];
            if($textFilterArray){
                $textFilterArray = ['or', $textFilterArray, $orItem];
            }
            else{
                $textFilterArray = $orItem;
            }
            
            //echo $likeSearchText . ', '. PHP_EOL;
        }
        
        if($textFilterArray){
            $query->andWhere($textFilterArray);
        }
        
        if(count($params["vacancies"])){
            $query->andWhere(['in', 'vacancy', $params["vacancies"]]);
        }
        if(count($params["branches"])){
            $query->andWhere(['in', 'branch', $params["branches"]]);
        }
        
        if(count($params["skills"])){
            $query->andWhere(['in', 'skill', $params["skills"]]);
        }
        
        $regionFilterArray = false;
        foreach ($countries as $country){
            
            
            if(isset($params["region"][$country])){
                
                $countryList = $params["region"][$country];
                $cities = array_keys($countryList);
                foreach ($cities as $city){
                    if($countryList[$city]){
                        $orItem = $city == 'self' ? ['or', ['country' => $country]] : ['or', ['city' => $city]];
                        
                        if($regionFilterArray){
                            $regionFilterArray = ['or', $regionFilterArray, $orItem];
                        }
                        else{
                            $regionFilterArray = $orItem;
                        }
                    }
                }
            }
            
            //echo $likeSearchText . ', '. PHP_EOL;
        }
        
        if($regionFilterArray){
            $query->andWhere($regionFilterArray);
        }
        
        return $query;
    }
    
    /**
     *
     * @param int $last
     * @param int $count
     * @param boolean $isfinished
     * @param int $total
     */
    private function lastNJob($last, $count, &$isfinished, &$total)
    {
        $searchModel = new JobpositionBaseSearch();
        $searchModel->status = 1;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, array(
            'createdate' => SORT_DESC
        ));
        $allJobModels = $dataProvider->getModels();
        $total = count($allJobModels);

        $jobModels = array();
        $i = $last + 1;
        while (count($jobModels) < $count && count($allJobModels) > $i) {
            $jobModels[$i] = $allJobModels[$i];
            $i ++;
        }

        $isfinished = count($jobModels) < $count;

        return $jobModels;
    }

    public static function doLogin($loginData, $model = false)
    {
        $model = $model ? $model : new LoginForm();

        if (count($loginData) > 0) {
            if ($model->load($loginData)) {

                if ($model->login()) {
                    return true;
                }
            }
        }
        return false;
    }
}
