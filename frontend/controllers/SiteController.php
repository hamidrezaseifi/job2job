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
class SiteController extends Controller
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
        $jobModels = $this->lastNJob(-1, 4, $isfinished, $total);
        
        return $this->render('index', [
            "jobModels" => $jobModels,
            
        ]);
    }
    
    /**
     * Displays about.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        
        return $this->render('about', ['isindex' => false, ]);
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
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams , array('createdate' => SORT_DESC), true, true);
        $allJobModels = $dataProvider->getModels();
        
        return $this->render('carrier', [
            'jobModels' => $allJobModels
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
     * Displays brachs detail.
     *
     * @return mixed
     */
    public function actionBranchview($b)
    {
        
        return $this->render('branch-' . $b, ['isindex' => false, ]);
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
     * @param int $last
     * @param int $count
     * @param boolean $isfinished
     * @param int $total
     */
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
