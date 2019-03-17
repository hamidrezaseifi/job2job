<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\lib\SkillsBase;
use common\lib\UsersBase;
use common\lib\CandidateBase;
use common\lib\NationalityBase;
use common\lib\CountryBase;
use common\lib\DistanceBase;
use common\lib\WorktimemodelBase;
use common\helper\BrainHelper;
use common\lib\CandidateskillBase;
use common\lib\ContantsBase;
use common\lib\UploadedfilesBase;
use common\helper\BrainStaticList;
use common\lib\PostcodeBase;
use common\lib\CityBase;
use common\lib\CandidatefavoriteBase;
use common\lib\CandidatejobapplyBase;
use common\lib\JobpositionBaseSearch;
use common\lib\CandidatejobapplyBaseSearch;
use common\lib\FrontlogBase;

/**
 * Site controller
 */
class CandidateController extends Controller
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
                'except' => [
                    'register', 'verify', 'response', 'check'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [
                            '@'
                        ],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->usertype ==
                            UsersBase::UserTypeCandidate; // return boolean
                        }
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ]
            ]
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
        return $this->render('index');
    }
    
    public function actionProfilejson()
    {
        $candidateModel = CandidateBase::findOne(['userid' => Yii::$app->user->identity->id]);
        
        
        //echo($this->asJson($candidateModel));
        echo json_encode($candidateModel->getAttributes(), true);
        exit;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDashboard($ac = 'index', $index = '')
    {
        $action = $ac; //isset($_GET['ac']) ? $_GET['ac'] : 'index';
        $after_verify = isset($index) && $index == 'ok' ? true : false;

        $subpageContent = '';

        $photopath = self::personal_photo();
        $docfiles = self::personal_documents();
        $docApproved = array();
        $docwebpathlist = array();
        $docappcount = 0;
        foreach ($docfiles as $doc) {
            $docApproved[$doc['web']] = array(
                'app' => true,
                'name' => $doc['name'],
                'web' => $doc['web']
            );
            $docwebpathlist[] = $doc['web'];
            $docappcount ++;
        }

        $filemodels = UploadedfilesBase::findAll([
            'file' => $docwebpathlist
        ]);
        foreach ($filemodels as $filemodel) {
            $docApproved[$filemodel->file]['app'] = false;
            $docappcount --;
        }

        $photo_approved = true;
        $filemodel = UploadedfilesBase::findOne([
            'file' => $photopath
        ]);
        if ($filemodel != null) {
            $photo_approved = false;
        }

        $model = Yii::$app->user->identity;
        // $candidateModel = CandidateBase::findOne(['userid' => $model->id]);
        $candidateModel = Yii::$app->user->identity->candidate();

        $skillModel = CandidateskillBase::findAll([
            'candidateid' => $candidateModel->userid
        ]);

        $postcodes = PostcodeBase::allPostcodes(true);
        $cities = CityBase::allCities(true);

        switch ($action) {
            case 'myprofile':

                if (isset($_POST['part'])) {
                    $this->update_profile($_POST['part'], $_POST);
                }

                $model->bdate = BrainHelper::dateEnglishToGerman($model->bdate);
                $candidateModel->workpermissionlimit = BrainHelper::dateEnglishToGerman($candidateModel->workpermissionlimit);
                
                $skills = SkillsBase::find()->where(
                    [
                        'parentid' => 1,
                        'status' => 1,
                    ])
                    ->orderBy('title')
                    ->all();

                $candidSkills = CandidateskillBase::findAll(
                    [
                        'candidateid' => $candidateModel->userid
                    ]);

                $skill_array = BrainHelper::mapTranslate($skills, 'id', 'title');

                $nationalities_array = BrainStaticList::nationalityList(true);
                $countries_array = BrainStaticList::countryList(true);
                $distances_temp = BrainStaticList::distanceList();
                $worktypes_array = BrainStaticList::workTypeList();
                $candidSkills_array = BrainHelper::mapTranslate($candidSkills, 'skill', 'skill');

                $distances_array = array();
                foreach ($distances_temp as $key => $dist) {
                    if ($key == 0 || $key == '')
                        continue;
                    $distances_array[$dist] = $dist . ' km';
                }

                if (strlen($candidateModel->tel) < 2) {
                    $candidateModel->tel = '--';
                }

                if (strlen($candidateModel->cellphone) < 2) {
                    $candidateModel->cellphone = '--';
                }
                
                $candidateModel->desiredjobcountry = 'Deutschland';

                $subpageContent = $this->renderPartial('dashbaord_profile',
                    [
                        'model' => $model,
                        'candidateModel' => $candidateModel,
                        'skills' => $candidSkills_array,
                        'allskills' => $skill_array,
                        'nationalities' => $nationalities_array,
                        'countries' => $countries_array,
                        'distances' => $distances_array,
                        'worktypes' => $worktypes_array,
                        'cellphoneList' => explode('-', $candidateModel->cellphone),
                        'telList' => explode('-', $candidateModel->tel),
                        'reachabilityList' => BrainStaticList::reachabilityList(),
                        'accessableList' => BrainStaticList::accessableList(),
                        'after_verify' => $after_verify,
                        'photopath' => $photopath,
                        'photo_approved' => $photo_approved,
                        'docFiles' => $docApproved,
                        'cities' => $cities,
                        'postcodes' => $postcodes
                    ]);

                break;

            case 'markedjob':
                $searchModel = new JobpositionBaseSearch();

                $dataProvider = $searchModel->searchFavoriteJob(Yii::$app->request->queryParams,
                    $model->id);

                $subpageContent = $this->renderPartial('dashbaord_marked_adv',
                    [
                        'model' => $model,
                        'candidateModel' => $candidateModel,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'jobadvList' => $dataProvider->getModels()
                    ]);

                break;

            case 'deletemarkedjob':
                // echo $_GET['id']; exit;

                if (isset($_GET['id'])) {
                    CandidatefavoriteBase::deleteAll(
                        [
                            'userid' => Yii::$app->user->identity->id,
                            'jobposid' => $_GET['id']
                        ]);
                }

                return $this->redirect([
                    'candidate/dashboard/markedjob'
                ]);
                break;

            case 'applyjob':
                $searchModel = new CandidatejobapplyBaseSearch();
                $searchModel->userid = Yii::$app->user->identity->id;
                $searchModel->companyid = 0;

                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $subpageContent = $this->renderPartial('dashbaord_apply_adv',
                    [
                        'model' => $model,
                        'candidateModel' => $candidateModel,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'jobadvList' => $dataProvider->getModels()
                    ]);

                break;

            case 'deleteapplyjob':
                // echo $_GET['id']; exit;

                if (isset($_GET['id'])) {
                    CandidatejobapplyBase::deleteAll(
                        [
                            'userid' => Yii::$app->user->identity->id,
                            'jobposid' => $_GET['id']
                        ]);
                }

                return $this->redirect([
                    'candidate/dashboard/applyjob'
                ]);
                break;
        }

        $percentTotal = 28;
        $percentCalc = 0;

        $percentCalc += $model->uname != null && $model->uname != '' ? 1 : 0;
        $percentCalc += $model->password_hash != null && $model->password_hash != '' ? 1 : 0;
        $percentCalc += $model->fname != null && $model->fname != '' ? 1 : 0;
        $percentCalc += $model->lname != null && $model->lname != '' ? 1 : 0;
        $percentCalc += $model->bdate != null && $model->bdate != '' ? 1 : 0;

        $percentCalc += $candidateModel->title != null && $candidateModel->title != '' ? 1 : 0;
        $percentCalc += $candidateModel->nationality != null && $candidateModel->nationality != '' ? 1 : 0;
        $percentCalc += $photopath && $photo_approved ? 1 : 0;
        $percentCalc += $candidateModel->pcode != null && $candidateModel->pcode != '' ? 1 : 0;
        $percentCalc += $candidateModel->city != null && $candidateModel->city != '' ? 1 : 0;
        $percentCalc += $candidateModel->country != null && $candidateModel->country != '' ? 1 : 0;
        $percentCalc += $candidateModel->street != null && $candidateModel->street != '' ? 1 : 0;
        $percentCalc += $candidateModel->cellphone != null && $candidateModel->cellphone != '' ? 1 : 0;
        $percentCalc += $candidateModel->tel != null && $candidateModel->tel != '' ? 1 : 0;
        $percentCalc += $candidateModel->reachability != null && $candidateModel->reachability != '' ? 1 : 0;
        $percentCalc += $candidateModel->contacttime != null && $candidateModel->contacttime != '' ? 1 : 0;
        $percentCalc += $candidateModel->employment != null ? 1 : 0;
        $percentCalc += $candidateModel->availability != null && $candidateModel->availability != '' ? 1 : 0;

        $percentCalc += $candidateModel->desiredjobpcode != null &&
            $candidateModel->desiredjobpcode != '' ? 1 : 0;
        $percentCalc += $candidateModel->desiredjobcity != null &&
            $candidateModel->desiredjobcity != '' ? 1 : 0;
        $percentCalc += $candidateModel->desiredjobcountry != null &&
            $candidateModel->desiredjobcountry != '' ? 1 : 0;
        $percentCalc += $candidateModel->desiredjobregion != null &&
            $candidateModel->desiredjobregion != '' ? 1 : 0;
        $percentCalc += $candidateModel->coverletter != null && $candidateModel->coverletter != '' ? 1 : 0;

        $percentCalc += $docappcount > 0 ? 1 : 0;

        $percentCalc += $skillModel && is_array($skillModel) ? count($skillModel) : 0;

        return $this->render('dashboard',
            [
                'model' => $model,
                'candidateModel' => $candidateModel,
                'skillModel' => $skillModel,
                'action' => $action,
                'subpageContent' => $subpageContent,
                'after_verify' => $after_verify,
                'photopath' => $photopath,
                'photo_approved' => $photo_approved,
                'docFiles' => $docApproved,
                'percentTotal' => $percentTotal,
                'percentCalc' => $percentCalc
            ]);
    }

    private function update_profile($part, $data)
    {
        $message = 'ok';
        
        $data['CandidateBase']['updatedate'] = date('Y-m-d');
        $data['UsersBase']['updatedate'] = date('Y-m-d');

        if($data['CandidateBase']['workpermission'] == 2 && (!isset($data['CandidateBase']['workpermissionlimit']) || $data['CandidateBase']['workpermissionlimit'] == null)){
            echo "ungültige Arbeitserlaubnis-Frist";
            exit;
        }
        
        $model = UsersBase::findOne([
            'id' => Yii::$app->user->identity->id
        ]); // Yii::$app->user->identity;
        $candidateModel = CandidateBase::findOne([
            'userid' => $model->id
        ]);
        
        

        if ($part == "person") {
            $data['UsersBase']['bdate'] = isset($data['UsersBase']['bdate']) ? BrainHelper::dateGermanToEnglish($data['UsersBase']['bdate']) : date('Y-m-d');
            $model->load($data);
            $model->save(false);

            $data['CandidateBase']['workpermissionlimit'] = isset($data['CandidateBase']['workpermissionlimit']) ? BrainHelper::dateGermanToEnglish($data['CandidateBase']['workpermissionlimit']) : null;
            $candidateModel->load($data);
            $candidateModel->save(false);
        }

        if ($part == "candidate_photo") {
            if (count($_FILES) > 0 && isset($_FILES['candidate_photo'])) {
                $upload_path = self::photo_path();
                if (! file_exists($upload_path)) {
                    mkdir($upload_path);
                }

                $name = $_FILES['candidate_photo']['name'];
                $tmp_name = $_FILES['candidate_photo']['tmp_name'];

                $srcname = '/' . $upload_path . $name;
                $info = pathinfo($srcname);
                $upload_path = $upload_path . '/' . Yii::$app->user->identity->id . '.' .
                    $info['extension'];
                if (file_exists($upload_path)) {
                    unlink($upload_path);
                }
                copy($tmp_name, $upload_path);

                $photo_web_path = Yii::getAlias('@web') . '/web/candidate_photo/' .
                    Yii::$app->user->identity->id . '.' . $info['extension'];
                $filemodel = UploadedfilesBase::findOne([
                    'file' => $photo_web_path
                ]);
                if ($filemodel != null) {
                    $filemodel->upload_date = date('Y-m-d H:i:s');
                } else {
                    $filemodel = new UploadedfilesBase();
                    $filemodel->file = $photo_web_path;
                    $filemodel->userid = Yii::$app->user->identity->id;
                    $filemodel->status = 0;
                    $filemodel->upload_date = date('Y-m-d H:i:s');
                }
                $filemodel->save();
            }
        }

        if ($part == "contact") {

            if (! isset($data['CandidateBase']['email']) || $data['CandidateBase']['email'] == '') {
                echo Yii::t('app', 'Fehler : Üngultiges E-Mail!');
                exit();
            }

            $data['UsersBase']['uname'] = $data['CandidateBase']['email'];

            $data['CandidateBase']['cellphone'] = $data['ctel1'] . '-' . $data['ctel2'] . '-' .
                $data['ctel3'];
            $data['CandidateBase']['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

            $data['reachability'] = isset($data['reachability']) && is_array($data['reachability']) ? $data['reachability'] : array();
            $data['CandidateBase']['reachability'] = '';
            $ar = BrainStaticList::reachabilityList();
            foreach ($data['reachability'] as $reach) {
                $data['CandidateBase']['reachability'] .= $ar[$reach] . ', ';
            }

            $model->load($data);
            $model->save(false);

            $candidateModel->load($data);
            $candidateModel->save(false);

            $data['CandidateBase']['country'] = isset($data['CandidateBase']['country']) ? $data['CandidateBase']['country'] : false;
            $data['CandidateBase']['city'] = isset($data['CandidateBase']['city']) ? $data['CandidateBase']['city'] : false;
            $data['CandidateBase']['pcode'] = isset($data['CandidateBase']['pcode']) ? $data['CandidateBase']['pcode'] : false;
        }

        if ($part == "cur-job-situation") {

            $candidateModel->load($data);
            $candidateModel->save(false);

            $skills = SkillsBase::find()->where(
                [
                    'parentid' => 1,
                    'status' => 1,
                ])->all();
            $skill_array = BrainHelper::mapTranslate($skills, 'title', 'title');

            $data['skills'] = isset($data['skills']) && is_array($data['skills']) ? $data['skills'] : array();
            $createdate = date('Y-m-d H:i:s');
            CandidateskillBase::deleteAll([
                'candidateid' => $candidateModel->userid
            ]);
            foreach ($data['skills'] as $skill) {
                $sdata = array();
                $sdata['CandidateskillBase']['candidateid'] = $candidateModel->userid;
                $sdata['CandidateskillBase']['skill'] = $skill;
                $sdata['CandidateskillBase']['created'] = $createdate;
                $skillModel = new CandidateskillBase();
                $skillModel->load($sdata);
                $skillModel->save(false);

                if (! isset($skill_array[$skill])) {
                    $sdata = array();
                    $sdata['SkillsBase']['parentid'] = 1;
                    $sdata['SkillsBase']['title'] = $skill;
                    $sdata['SkillsBase']['status'] = 0;
                    $sdata['SkillsBase']['createdate'] = $createdate;
                    $sdata['SkillsBase']['updatedate'] = $createdate;

                    $skillModel = new SkillsBase();
                    $skillModel->load($sdata);
                    $skillModel->save(false);
                }
            }
            echo $message;
            exit();
        }

        if ($part == "job-vision") {
            // print_r($data);

            $candidateModel->load($data);
            $candidateModel->save(false);

            $data['CandidateBase']['desiredjobcountry'] = isset(
                $data['CandidateBase']['desiredjobcountry']) ? $data['CandidateBase']['desiredjobcountry'] : false;
            $data['CandidateBase']['desiredjobcity'] = isset(
                $data['CandidateBase']['desiredjobcity']) ? $data['CandidateBase']['desiredjobcity'] : false;
            $data['CandidateBase']['desiredjobpcode'] = isset(
                $data['CandidateBase']['desiredjobpcode']) ? $data['CandidateBase']['desiredjobpcode'] : false;
        }

        if ($part == "job-cover") {
            // print_r($data);

            $candidateModel->load($data);
            $candidateModel->save(false);
        }

        if ($part == "candidate_doc") {

            if (count($_FILES) > 0 && isset($_FILES['candidate_doc'])) {
                $upload_path = self::doc_path();
                if (! file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $name = $_FILES['candidate_doc']['name'];
                $tmp_name = $_FILES['candidate_doc']['tmp_name'];

                $upload_path .= $name;
                if (file_exists($upload_path)) {
                    unlink($upload_path);
                }
                copy($tmp_name, $upload_path);

                $doc_web_path = Yii::getAlias('@web') . '/web/candidate_doc/' .
                    Yii::$app->user->identity->id . '/' . $name;
                $filemodel = UploadedfilesBase::findOne([
                    'file' => $doc_web_path
                ]);
                if ($filemodel != null) {
                    $filemodel->upload_date = date('Y-m-d H:i:s');
                } else {
                    $filemodel = new UploadedfilesBase();
                    $filemodel->file = $doc_web_path;
                    $filemodel->userid = Yii::$app->user->identity->id;
                    $filemodel->status = 0;
                    $filemodel->upload_date = date('Y-m-d H:i:s');
                }
                $filemodel->save();
            }
        }

        echo $message;
        exit();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionResponse()
    {
        return $this->render('register_resp');
    }

    /**
     * Displays register page.
     *
     * @return mixed
     */
    public function actionRegister()
    {
        $model = new UsersBase();
        $model->bdate = '1980-01-01';
        $candidateModel = new CandidateBase();

        if (count($_POST) && isset($_POST['checkcondition'])) {
            $_POST['CandidateBase']['createdate'] = date('Y-m-d');

            $_POST['UsersBase']['bdate'] = (isset($_POST['UsersBase']['bdate'])) ? BrainHelper::dateGermanToEnglish($_POST['UsersBase']['bdate']) : '';
            $_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
            $_POST['UsersBase']['password_hash'] = '';
            $_POST['UsersBase']['usertype'] = UsersBase::UserTypeCandidate;
            $_POST['UsersBase']['createdate'] = date('Y-m-d');
            $_POST['UsersBase']['group'] = 2;
            $_POST['UsersBase']['permission'] = 2;
            $_POST['UsersBase']['status'] = UsersBase::UserStatusApprove;

            $model->load($_POST);
            $model->save(false);

            $userid = $model->id;
            $_POST['CandidateBase']['userid'] = $userid;
            $candidateModel->load($_POST);
            $candidateModel->save(false);

            if (isset($_POST['skill']) && is_array($_POST['skill'])) {
                foreach ($_POST['skill'] as $skillitem) {
                    $skillModel = new CandidateskillBase();
                    $skillModel->userid = $userid;
                    $skillModel->skill = $skillitem;
                    $skillModel->save(false);
                }
            }

            $verifydata = array();
            $verifydata['uid'] = $userid;
            $verifydata['utp'] = UsersBase::UserTypeCandidate;

            $verifydataa = serialize($verifydata);
            $verifydataa = base64_encode($verifydataa);

            $verifydata['checkubd'] = $_POST['UsersBase']['bdate'];
            $verifydata['checkuca'] = $_POST['UsersBase']['createdate'];

            $verifydatab = serialize($verifydata);
            $verifydatab = base64_encode($verifydatab);

            $verifyurl = "http://" . $_SERVER['HTTP_HOST'] .
                str_replace('/register', '/verify', $_SERVER['REDIRECT_URL']);
            $verifyurl .= '?a=' . urlencode($verifydataa) . '&b=' . urlencode($verifydatab);
            $verifytextfile = dirname(__DIR__) . '/views/candidate/verifytext.php';
            $emailbody = file_get_contents($verifytextfile);
            $emailbody = str_replace('%link', $verifyurl, $emailbody);

            $empfaenger = $_POST['CandidateBase']['email'];
            $betreff = Yii::$app->params['registerresponse_sender_title'];

            $header = 'From: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
                'Reply-To: ' . Yii::$app->params['registerresponse_sender_email'] . "\r\n" .
                'Content-Type: text/html; charset=UTF-8\r\n' . 'X-Mailer: PHP/' . phpversion();

            mail($empfaenger, $betreff, $emailbody, $header);

            FrontlogBase::addLog('Register:' . $userid, $userid, true);

            return $this->render('register_resp', []);
        }

        return $this->render('register',
            [
                'model' => $model,
                'candidateModel' => $candidateModel
            ]);
    }

    /**
     * Displays verify data page.
     *
     * @return mixed
     */
    public function actionVerify()
    {
        if (count($_POST) && isset($_POST['ac']) && $_POST['ac'] == 'vr' && isset($_POST['ui']) &&
            intval($_POST['ui']) > 0) {
            $userid = intval($_POST['ui']);

            $model = UsersBase::findOne($userid);
            $candidateModel = CandidateBase::findOne($userid);

            $_POST['CandidateBase']['updatedate'] = date('Y-m-d');
            $_POST['UsersBase']['updatedate'] = date('Y-m-d');

            // $_POST['CandidateBase']['availablefrom'] = isset($_POST['CandidateBase']['availablefrom']) ? $_POST['CandidateBase']['availablefrom'] : null;

            $password_original = $_POST['UsersBase']['password_hash'];
            $_POST['UsersBase']['bdate'] = (isset($_POST['UsersBase']['bdate'])) ? BrainHelper::dateGermanToEnglish(
                $_POST['UsersBase']['bdate']) : '';
            $_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
            $_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash(
                $_POST['UsersBase']['password_hash']);
            $_POST['UsersBase']['status'] = UsersBase::UserStatusActive;

            $model->load($_POST);
            $model->save(false);

            $userid = $model->id;
            $_POST['CandidateBase']['userid'] = $userid;
            $candidateModel->load($_POST);
            $candidateModel->save(false);

            $loginData = array();
            $loginData['_csrf-frontend'] = $_POST['_csrf-frontend'];
            $loginData['LoginForm']['username'] = $_POST['UsersBase']['uname'];
            $loginData['LoginForm']['password'] = $password_original;
            $loginData['LoginForm']['rememberMe'] = 1;

            if (SiteController::doLogin($loginData)) {
                FrontlogBase::addLog('Verify', $userid, true);

                return $this->redirect('dashboard?verify=ok');
            }
        }

        $a = isset($_GET['a']) ? $_GET['a'] : false;
        $b = isset($_GET['b']) ? $_GET['b'] : false;

        if (! $a || ! $b) {
            return $this->redirect('../site/invalidpage?msg=1111');
        }

        $verifydatab = base64_decode($b);
        $verifydataa = base64_decode($a);

        if (! $verifydatab || ! $verifydataa) {
            return $this->redirect('../site/invalidpage?msg=22222');
        }

        $verifydatab = unserialize($verifydatab);
        $verifydataa = unserialize($verifydataa);

        if (! $verifydatab || ! $verifydataa) {
            return $this->redirect('../site/invalidpage?msg=3333');
        }

        if (intval($verifydataa['uid']) <= 0 || $verifydataa['uid'] != $verifydatab['uid']) {
            return $this->redirect('../site/invalidpage?msg=4444');
        }

        if (intval($verifydataa['utp']) != UsersBase::UserTypeCandidate) {
            return $this->redirect('../site/invalidpage?msg=5555');
        }

        $date = date_create_from_format('Y-m-d', $verifydatab['checkuca']);
        if (! $date) {
            // echo $verifydatab['checkuca'];
            return $this->redirect('../site/invalidpage?msg=6666');
        }
        $interval = date_diff($date, date_create());

        if (intval($interval->format('%a')) > 1) {
            // $this->redirect(['/site/invalidpage' , 'msg' => urlencode(Yii::t('app', 'ungültige verifikation link!'))] );
        }

        $userid = intval($verifydataa['uid']);

        $model = UsersBase::find()->where([
            'id' => $userid
        ])->one();
        $candidateModel = CandidateBase::find()->where([
            'userid' => $userid
        ])->one();

        if (! $model) {
            return $this->redirect('../site/invalidpage?msg=' . $userid . ' : u');
        }

        if (! $candidateModel) {
            return $this->redirect('../site/invalidpage?msg=' . $userid . ' : c');
        }

        $dbdate = $model->bdate;
        $dbdate = trim(str_replace('00:00:00', '', $dbdate));
        // $model->bdate = $dbdate;
        $model->bdate = BrainHelper::dateEnglishToGerman($model->bdate);

        $chkdate = trim(str_replace('00:00:00', '', $verifydatab['checkubd']));

        if ($dbdate != $chkdate) {
            return $this->redirect('../site/invalidpage');
        }

        if ($model->status != 4) {
            // $this->redirect(['site/invalidpage', 'msg' => urlencode(Yii::t('app', 'ungültige verifikation link!<br>Benutzer ist aktuell verifikatet!'))]);
        }

        return $this->render('verify',
            [
                'model' => $model,
                'candidateModel' => $candidateModel,
                'mode' => 'verify1'
            ]);
    }

    /**
     * Displays profile page.
     *
     * @return mixed
     */
    public function actionMyprofile()
    {
        $model = new UsersBase();
        $candidateModel = new CandidateBase();

        $skills = SkillsBase::allTree();
        $skills = SkillsBase::find()->where([
            'parentid' => 1,
            'status' => 1
        ])
            ->orderBy('title')
            ->all();

        if (count($_POST) && isset($_POST['checkcondition'])) {
            $_POST['CandidateBase']['tel'] = $_POST['tel1'] . $_POST['tel2'] . $_POST['tel3'];
            $_POST['CandidateBase']['cellphone'] = $_POST['ctel1'] . $_POST['ctel2'] .
                $_POST['ctel3'];
            $reachtel = isset($_POST['reachtel']) ? 'tel,' : '';
            $reachemail = isset($_POST['reachemail']) ? 'email,' : '';
            $_POST['CandidateBase']['reachability'] = $reachtel . $reachemail;
            $_POST['CandidateBase']['createdate'] = date('Y-m-d');

            // $_POST['CandidateBase']['availablefrom'] = isset($_POST['CandidateBase']['availablefrom']) ? $_POST['CandidateBase']['availablefrom'] : null;

            $_POST['UsersBase']['uname'] = $_POST['CandidateBase']['email'];
            $_POST['UsersBase']['password_hash'] = '';
            $_POST['UsersBase']['usertype'] = 3;
            $_POST['UsersBase']['createdate'] = date('Y-m-d');
            $_POST['UsersBase']['group'] = 2;
            $_POST['UsersBase']['permission'] = 2;
            $_POST['UsersBase']['status'] = 4;

            $model->load($_POST);
            $model->save(false);

            $userid = $model->id;
            $_POST['CandidateBase']['userid'] = $userid;
            $candidateModel->load($_POST);
            $candidateModel->save(false);

            if (isset($_POST['skill']) && is_array($_POST['skill'])) {
                foreach ($_POST['skill'] as $skillitem) {
                    $skillModel = new CandidateskillBase();
                    $skillModel->userid = $userid;
                    $skillModel->skill = $skillitem;
                    $skillModel->save(false);
                }
            }

            $this->redirect([
                'site/index'
            ]);
        }

        $nationalities = NationalityBase::findAll([
            'status' => 1
        ]);
        $countries = CountryBase::findAll([
            'status' => 1
        ]);
        $distances = DistanceBase::findAll([
            'status' => 1
        ]);
        $titles = ContantsBase::findAll([
            'const_type' => 'title2'
        ]);
        $worktypes = WorktimemodelBase::findAll([
            'status' => 1
        ]);
        

        $skill_array = BrainHelper::mapTranslate($skills, 'id', 'title');
        $nationalities_array = array(
            '' => ''
        );
        $nationalities_array = array_merge($nationalities_array,
            BrainHelper::mapTranslate($nationalities, 'title', 'title'));
        $countries_array = array(
            '' => ''
        );
        $countries_array = array_merge($countries_array,
            BrainHelper::mapTranslate($countries, 'title', 'title'));
        $distances_array = array(
            '' => ''
        );
        $distances_array = array_merge($distances_array,
            BrainHelper::mapTranslate($distances, 'title', 'title'));
        $titles_array = array(
            '' => ''
        );
        $titles_array = array_merge($titles_array,
            BrainHelper::mapTranslate($titles, 'value', 'value'));
        $worktypes_array = array(
            0 => ''
        );
        $worktypes_array = array_merge($worktypes_array,
            BrainHelper::mapTranslate($worktypes, 'id', 'title'));

        return $this->render('myprofile',
            [
                'model' => $model,
                'candidateModel' => $candidateModel,
                'skills' => $skill_array,
                'nationalities' => $nationalities_array,
                'countries' => $countries_array,
                'distances' => $distances_array,
                'titles' => $titles_array,
                'worktypes' => $worktypes_array,
            ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSkills()
    {
        $skills = SkillsBase::find()->where([
            'parentid' => 0,
            'status' => 1,
        ])->one();
        $parentid = 0;
        if (! $skills) {
            echo 'alert("Error!2")';
            exit();
        }

        $parentid = $skills->id;

        $skills = SkillsBase::find()->where(
            [
                'parentid' => $parentid,
                'status' => 1,
            ])
            ->orderBy('title')
            ->all();
        $skill_array = BrainHelper::mapTranslate($skills, 'id', 'title');

        echo 'skills = ' . json_encode($skill_array) . ';' . PHP_EOL;
        echo 'skills_title = ' . json_encode(array_values($skill_array)) . ';' . PHP_EOL;
        echo 'skills_id = ' . json_encode(array_keys($skill_array)) . ';' . PHP_EOL;

        // echo 'alert(skills_title);';
        exit();
    }

    public function actionCheck()
    {
        $params = $_POST;

        if (! isset($params['mode']) || $params['mode'] == '') {
            echo 'invalid mode!';
            exit();
        }

        $mode = $params['mode'];

        $output = '';
        switch ($mode) {
            case 'email_exists':
                $checkemail = isset($params['data']) ? $params['data'] : false;
                $currentid = isset($params['data1']) ? $params['data1'] : false;
                if ($checkemail) {
                    $output = 'no';

                    $query = CandidateBase::find()->select([
                        'userid',
                        'email'
                    ])
                        ->where([
                        'like',
                        'email',
                        $checkemail
                    ])
                        ->andWhere([
                        '=',
                        'userid',
                        $currentid
                    ]);

                    $hasOne = $query->asArray()->all();
                    // print_r($hasOne); exit;

                    if (count($hasOne) > 0) {
                        $output = 'no';
                    } else {
                        $query = CandidateBase::find()->select([
                            'userid',
                            'email'
                        ])->where([
                            'like',
                            'email',
                            $checkemail
                        ]);
                        if ($currentid && intval($currentid) > 0) {
                            $query->andWhere([
                                '!=',
                                'userid',
                                $currentid
                            ]);
                        }
                        $candidateDataModel = $query->all();

                        foreach ($candidateDataModel as $item) {
                            if (trim($checkemail) == trim($item->email)) {
                                $output = 'ok' . $item->userid . ' : ' . $currentid;
                                break;
                            }
                        }
                    }
                } else {
                    $output = 'error-input' . PHP_EOL . serialize($params);
                }
        }

        echo $output;
        exit();
    }

    /**
     * add jobposition to favorite.
     *
     * @return mixed
     */
    public function actionJobfav($id)
    {
        // return Yii::$app->user->identity->id . ' , ' . $id;
        $favModel = CandidatefavoriteBase::findOne(
            [
                'userid' => Yii::$app->user->identity->id,
                'jobposid' => $id
            ]);

        if ($favModel) {
            $favModel->delete();
        } else {
            $favModel = new CandidatefavoriteBase();
            $data = array(
                'CandidatefavoriteBase' => array()
            );
            $data['CandidatefavoriteBase']['userid'] = Yii::$app->user->identity->id;
            $data['CandidatefavoriteBase']['jobposid'] = $id;
            $data['CandidatefavoriteBase']['createdate'] = date('Y-m-d H:i:s');
            $favModel->load($data);
            $favModel->save(false);

            FrontlogBase::addLog('JobFav:' . $id, Yii::$app->user->identity->id, true);
        }
        return $this->redirect([
            'site/jobview',
            'id' => $id
        ]);
    }

    /**
     * add jobposition to favorite.
     *
     * @return mixed
     */
    public function actionJobapply($id)
    {
        // return Yii::$app->user->identity->id . ' , ' . $id;
        $favModel = CandidatejobapplyBase::findOne(
            [
                'userid' => Yii::$app->user->identity->id,
                'jobposid' => $id
            ]);

        if ($favModel) {} else {
            $favModel = new CandidatejobapplyBase();
            $data = array(
                'CandidatefavoriteBase' => array()
            );
            $data['CandidatejobapplyBase']['userid'] = Yii::$app->user->identity->id;
            $data['CandidatejobapplyBase']['jobposid'] = $id;
            $data['CandidatejobapplyBase']['createdate'] = date('Y-m-d H:i:s');
            $favModel->load($data);
            $favModel->save(false);

            FrontlogBase::addLog('JobApply:' . $id, Yii::$app->user->identity->id, true);
        }
        return $this->redirect([
            'site/jobview',
            'id' => $id
        ]);
    }

    public function actionMarkedjoblistjson()
    {
        $model = Yii::$app->user->identity;

        $searchModel = new JobpositionBaseSearch();

        $dataProvider = $searchModel->searchFavoriteJob(Yii::$app->request->queryParams, $model->id);
        $formatter = \Yii::$app->formatter;

        $jobadvList = $dataProvider->getModels();
        $list = [];
        foreach ($jobadvList as $jobadv) {
            $jobtitle = strlen($jobadv->title) > 42 ? substr($jobadv->title, 0, 40) . ' ...' : $jobadv->title;
            $item = [];
            $item['id'] = $jobadv->id;
            $item['jobtitle'] = $jobtitle;
            $item['id'] = $jobadv->id;
            $item['status'] = $jobadv->status;
            $item['jobstartdate'] = $formatter->asDate($jobadv->jobstartdate, 'php:d.m.Y');
            $item['country'] = $jobadv->country;
            $item['city'] = $jobadv->city;
            $list[] = $item;
        }

        echo 'angular.callbacks._0(';
        echo json_encode($list);
        echo ');';
        exit();
    }

    public function actionApplyjoblistjson()
    {
        $model = Yii::$app->user->identity;

        $searchModel = new CandidatejobapplyBaseSearch();
        $searchModel->userid = Yii::$app->user->identity->id;
        $searchModel->companyid = 0;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $formatter = \Yii::$app->formatter;

        $jobadvList = $dataProvider->getModels();
        $list = [];
        foreach ($jobadvList as $jobadv) {
            $jobtitle = strlen($jobadv->getJobpos()->title) > 42 ? substr(
                $jobadv->getJobpos()->title, 0, 40) . ' ...' : $jobadv->getJobpos()->title;
            $item = [];
            $item['id'] = $jobadv->getJobpos()->id;
            $item['jobtitle'] = $jobtitle;
            $item['status'] = $jobadv->getJobpos()->status;
            $item['jobstartdate'] = $formatter->asDate($jobadv->getJobpos()->jobstartdate,
                'php:d.m.Y');
            $item['country'] = $jobadv->getJobpos()->country;
            $item['city'] = $jobadv->getJobpos()->city;
            $list[] = $item;
        }

        echo 'angular.callbacks._0(';
        echo json_encode($list);
        echo ');';
        exit();
    }

    public static function photo_path()
    {
        return dirname(dirname(__FILE__)) . '/web/candidate_photo';
    }

    public static function doc_path()
    {
        return dirname(dirname(__FILE__)) . '/web/candidate_doc/' . Yii::$app->user->identity->id .
            '/';
    }

    public static function personal_photo($checkapproved = false)
    {
        $photopath = false;
        $list = glob(self::photo_path() . '/' . Yii::$app->user->identity->id . '.*', GLOB_BRACE);
        if (count($list)) {
            $file = $list[0];
            $photopath = Yii::getAlias('@web') . str_replace(dirname(dirname(__FILE__)), '', $file);
        }

        if ($checkapproved) {
            $filemodel = $photopath ? UploadedfilesBase::findOne([
                'file' => $photopath
            ]) : NULL;
            if ($filemodel != null && $photopath) {
                $photopath = false;
            }
        }

        return $photopath;
    }

    public static function personal_documents()
    {
        $list = glob(self::doc_path() . '*.*', GLOB_BRACE);
        $files = array();
        foreach ($list as $docfile) {
            $info = pathinfo($docfile);
            $files[] = array(
                'web' => Yii::getAlias('@web') . '/web/candidate_doc/' .
                Yii::$app->user->identity->id . '/' . $info['basename'],
                'name' => $info['basename'],
                'path' => $docfile
            );
        }

        return $files;
    }
}
