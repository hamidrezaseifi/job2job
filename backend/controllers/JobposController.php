<?php

namespace backend\controllers;

use Yii;
use common\lib\JobpositionBase;
use common\lib\JobpositionBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helper\BrainStaticList;
use common\lib\CityBase;
use common\helper\BrainHelper;
use common\lib\PostcodeBase;
use common\lib\CandidateBase;
use common\lib\CandidateSearchBase;
use common\lib\CandidateskillBase;
use common\lib\CandidatejobapplyBase;
use common\lib\BranchBase;
use common\lib\VacancyBase;
use common\lib\WorktimemodelBase;
use common\lib\CompanyBase;
use common\lib\SkillsBase;
use common\lib\JobpositionskillBase;
use common\lib\JobpositiontasksBase;

/**
 * JobpositionController implements the CRUD actions for JobPositionBase model.
 */
class JobposController extends Controller
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
     * Lists all JobPositionBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobpositionBaseSearch();
        $dataProvider = $searchModel->searchBackend(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobPositionBase model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$fromcompany = false;
    	if(isset($_GET['fromcompany']) && intval($_GET['fromcompany']) > 0)
    	{
    		$fromcompany = $_GET['fromcompany'];
    	}
    	 
    	$branchs = BranchBase::allActiveKeyList(true);
    	$vacancies = VacancyBase::allActiveKeyList(true);
    	$worktypes =  WorktimemodelBase::allActiveKeyList(true);
    	
        return $this->render('view', [
            'model' 		=> $this->findModel($id),
            'fromcompany' 	=> $fromcompany,
            'branchs' 	    => $branchs,
            'vacancies' 	=> $vacancies,
            'worktypes' 	=> $worktypes,
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
    		$query = JobpositionBase::find()->select(['id', 'title', 'status'])->where(['status' => 1])->andWhere(['like' , 'title', $name])
    		->orderBy(['title' => SORT_ASC]);
    		//echo $query->createCommand()->sql; exit;
    		$list = $query->all();
    	}
    	else {
    		echo 'no name!';
    	}
    	 
    	if(count($list) == 0)
    	{
    		echo Yii::t('app', 'keine Ergebnisse');
    		exit;
    	}
    	 
    	foreach ($list as $item)
    	{
    		echo '<li data-id="' . $item->id . '">' . $item->title . '</li>';
    	}
    	exit;
    }
    
    /**
     * Creates a new JobPositionBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $job2jobComp = CompanyBase::findJob2job();        
        $model = new JobpositionBase();

        $model->createdate = date('Y-m-d H:i:s');
        $model->updatedate = $model->createdate;
        $model->status = 1;
        $model->country = 'Deutschland';
        $model->companyid = $job2jobComp->id;
        $model->duration = 0;

        $fromcompany = false;
        if(isset($_GET['fromcompany']) && intval($_GET['fromcompany']) > 0)
        {
        	$model->companyid = $_GET['fromcompany'];
        	$fromcompany = $_GET['fromcompany'];
        }
        
        $postdata = Yii::$app->request->post();
        if(isset($postdata['JobpositionBase']))
        {
        	$postdata['JobpositionBase']['jobstartdate'] = '01' . substr($postdata['JobpositionBase']['jobstartdate'], 2); //echo $postdata['JobpositionBase']['jobstartdate']; exit;
        	$postdata['JobpositionBase']['jobstartdate'] = BrainHelper::dateGermanToEnglish($postdata['JobpositionBase']['jobstartdate']);
        	$postdata['JobpositionBase']['userid'] = Yii::$app->user->identity->id;
        	$postdata['JobpositionBase']['subtitle'] = isset($postdata['JobpositionBase']['subtitle']) ? $postdata['JobpositionBase']['subtitle'] : '';
        	$postdata['JobpositionBase']['showdate'] = isset($postdata['JobpositionBase']['showdate']) ? $postdata['JobpositionBase']['showdate'] : date('Y-m-d');
        	$postdata['JobpositionBase']['expiredate'] = BrainHelper::dateGermanToEnglish($postdata['JobpositionBase']['expiredate']);
 
        }
        
        
        if ($model->load($postdata) && $model->save(false)) {
            
            if(isset($postdata['JobpositionSkills']))
            {
                $allskills = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1])->all();
                $allskills = BrainHelper::mapTranslate($allskills, 'title', 'title');
                
                JobpositionskillBase::deleteAll(['jobid' => $model->id]);
                
                $skilldata = array();
                $skilldata['JobpositionskillBase']['jobid'] = $model->id;
                
                foreach ($postdata['JobpositionSkills'] as $skill){
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
                        $sdata['SkillsBase']['status'] = $model->branch;
                        
                        $skillModel = new SkillsBase();
                        $skillModel->load($sdata);
                        $skillModel->save(false);
                        
                    }
                }
            }
            
            if(isset($postdata['JobpositionTasks']))
            {
                JobpositiontasksBase::deleteAll(['jobid' => $model->id]);
                
                $taskdata = array();
                $taskdata['JobpositiontasksBase']['jobid'] = $model->id;
                foreach ($postdata['JobpositionTasks'] as $task)
                {
                    $skill = trim($task);
                    if($task == '') continue;
                    $taskdata['JobpositiontasksBase']['task'] = $task;
                    
                    $jobtask = new JobpositiontasksBase();
                    $jobtask->load($taskdata);
                    $jobtask->save(false);
                    
                }
                
            }
            
        	return $this->redirect(['view', 'id' => $model->id, 'fromcompany' => $fromcompany]);
        } else {
        	
        	$countries_array = array('' => '' , 'Deutschland' => 'Deutschland' , );
        	$worktypes = BrainStaticList::workTypeList();
        	
        	$branchs = BranchBase::allActiveKeyList(true);
        	$vacancies = VacancyBase::allActiveKeyList(true);
        	$worktypes =  WorktimemodelBase::allActiveKeyList(true);
        	$skills = SkillsBase::allChilds(1);
        	$companies = CompanyBase::find()->where(['status' => 1])->orderBy('companyname')->all();
        	
            return $this->render('create', [
                'model' 				=> $model,
                'branchs' 				=> $branchs,
				'countries' 			=> $countries_array,
                'vacancies'				=> $vacancies,
                'worktypes'				=> $worktypes,
                'job2jobComp'			=> $job2jobComp,
                'skills' 				=> $skills,
                'companies' 			=> $companies,
            ]);
        }
    }

    /**
     * Updates an existing JobPositionBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updatedate = date('Y-m-d H:i:s');

        $fromcompany = false;
        if(isset($_GET['fromcompany']) && intval($_GET['fromcompany']) > 0)
        {
        	$model->companyid = $_GET['fromcompany'];
        	$fromcompany = $_GET['fromcompany'];
        }
        
        $postdata = Yii::$app->request->post();
        if(isset($postdata['JobpositionBase']['jobstartdate']))
        {
        	$postdata['JobpositionBase']['jobstartdate'] = '01.' . substr($postdata['JobpositionBase']['jobstartdate'], 3);
        	$postdata['JobpositionBase']['jobstartdate'] = BrainHelper::dateGermanToEnglish($postdata['JobpositionBase']['jobstartdate']);
        	
        	
        }
        
        if(isset($postdata['JobpositionBase']['expiredate']))
        {
            $postdata['JobpositionBase']['expiredate'] = BrainHelper::dateGermanToEnglish($postdata['JobpositionBase']['expiredate']);
        }
        
        if(isset($postdata['JobpositionBase']))
        {
            //print_r($postdata); exit;
        }
        
        
        if ($model->load($postdata) && $model->save(false)) {
            
            if(isset($postdata['JobpositionSkills']))
            {
                $allskills = SkillsBase::find()->where(['parentid' => 1 , 'status' => 1])->all();
                $allskills = BrainHelper::mapTranslate($allskills, 'title', 'title');
                
                JobpositionskillBase::deleteAll(['jobid' => $model->id]);
                
                $skilldata = array();
                $skilldata['JobpositionskillBase']['jobid'] = $model->id;
                
                foreach ($postdata['JobpositionSkills'] as $skill){
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
                        $sdata['SkillsBase']['status'] = $model->branch;
                        
                        $skillModel = new SkillsBase();
                        $skillModel->load($sdata);
                        $skillModel->save(false);
                        
                    }
                }
            }
            
            if(isset($postdata['JobpositionTasks']))
            {
                JobpositiontasksBase::deleteAll(['jobid' => $model->id]);
                
                $taskdata = array();
                $taskdata['JobpositiontasksBase']['jobid'] = $model->id;
                foreach ($postdata['JobpositionTasks'] as $task)
                {
                    $skill = trim($task);
                    if($task == '') continue;
                    $taskdata['JobpositiontasksBase']['task'] = $task;
                    
                    $jobtask = new JobpositiontasksBase();
                    $jobtask->load($taskdata);
                    $jobtask->save(false);
                    
                }
                
            }
                
            return $this->redirect(['view', 'id' => $model->id, 'fromcompany' => $fromcompany]);
        } else {

        	$cities = CityBase::allCities();
        	$vacancy_array = BrainStaticList::vacancyList();
        	$countries = BrainStaticList::countryList();
        	unset($countries['Deutschland']);
        	$countries_array = array('' => '' , 'Deutschland' => 'Deutschland' , );
        	$countries_array = array_merge($countries_array , $countries);
        	$worktypes = BrainStaticList::workTypeList();
        	$branchs = BranchBase::allActiveKeyList(true);
        	$job2jobComp = CompanyBase::findJob2job();
        	$skills = SkillsBase::allChilds(1);
        	$companies = CompanyBase::find()->where(['status' => 1])->orderBy('companyname')->all();
        	
        	$model->expiredate = BrainHelper::dateAsGerman($model->expiredate);
        	$model->jobstartdate = BrainHelper::dateAsGerman($model->jobstartdate);
        	 
            return $this->render('update', [
        		'model' 				=> $model,
                'branchs' 				=> $branchs,
				'countries' 			=> $countries_array,
				'cities'				=> $cities,
				'vacancies'				=> $vacancy_array,
				'worktypes'				=> $worktypes,
                'job2jobComp'			=> $job2jobComp,
                'skills' 				=> $skills,
                'companies' 			=> $companies,
            ]);
        }
    }

    /**
     * Deletes an existing JobPositionBase model.
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
     * Lists all CompanyBase models.
     * @return mixed
     */
    public function actionMatch($id)
    {
    	$jobposModel = $this->findModel($id);
    	$skillsModelList = $jobposModel->getSkills();
    	$skills = array();
    	foreach ($skillsModelList as $sk)
    	{
    		$skills[] = $sk->skill;
    	}
    	$title = $jobposModel->title;
    	$title = $this->properSearchTitle($title);
    	     	
    	$usersModels = CandidateskillBase::find()->where(['in', 'skill', $skills])->all();
    	
    	$users = [];
    	
    	foreach($usersModels as $user)
    	{
    		$users[$user->candidateid] = $user->candidateid;
    	}

    	$usersModels = CandidatejobapplyBase::find()->where(['jobposid' => $id])->all();
    	
    	foreach($usersModels as $user)
    	{
    		$users[$user->userid] = $user->userid;
    	}

    	/*$usersModels = CandidateBase::find()->where(['jobposid' => $id])->all();
    	
    	foreach($usersModels as $user)
    	{
    		$users[$user->userid] = $user->userid;
    	}*/
    	$searchModel = new CandidateSearchBase();
    	$dataProvider = $searchModel->searchList($users);
    	
    	return $this->render('findcandidate', [
    			'jobposModel' => $jobposModel,
    			'dataProvider' => $dataProvider,
    	]);
    	 
    	 
    	//print_r($dataProvider);
    	//exit;

    	
    }
    
    private function properSearchTitle($title)
    {
    	$searchList = [':', ',', ';', '(', ')', '?', '/', '&', '!', ':'];
    	foreach($searchList as $search)
    	{
    		$title = str_replace($search, ' ', $title);
    	}
    	
    	return $title;
    }
    
    /**
     * Finds the JobPositionBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobPositionBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobpositionBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
