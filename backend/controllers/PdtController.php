<?php

namespace backend\controllers;

use Yii;
use common\lib\PersonaldecisionmakerBase;
use common\lib\PersonaldecisionmakerBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helper\BrainStaticList;
use common\lib\UsersBase;
use common\helper\BrainHelper;

/**
 * PetController implements the CRUD actions for PersonaldecisionmakerBase model.
 */
class PdtController extends Controller
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
     * Lists all PersonaldecisionmakerBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonaldecisionmakerBaseSearch();
        if(isset($_GET['sv']))
        {
        	$searchModel->isdeputy = intval($_GET['sv']);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonaldecisionmakerBase model.
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
     * Lists all PersonaldecisionmakerBase models.
     * @return mixed
     */
    public function actionSearch($name, $sv)
    {
    	$name = isset($name) ? $name : '';
    	$list = array();
    	$name = trim($name);
    	if($name != '')
    	{
    		$query = PersonaldecisionmakerBase::find()->innerJoinWith(['users'])->select(['id', 'userid', 'fname', 'lname', 'status', 'isdeputy'])
    		->where(['status' => 1, 'usertype' => UsersBase::UserTypeCompany, 'isdeputy' => $sv])
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
    		echo '<li data-id="' . $item->userid . '">' . $item->getUser()->fullname() . '</li>';
    	}
    	exit;
    }
    
    /**
     * Creates a new PersonaldecisionmakerBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";
    	 
        $model = new PersonaldecisionmakerBase();
        $model->companyid = 0;
        if(isset($_GET['sv']))
        {
        	$model->isdeputy = intval($_GET['sv']);
        }
        $userModel = new UsersBase();
        $userModel->bdate = '2000-01-01';
        $userModel->status = UsersBase::UserStatusActive;
        $userModel->usertype = UsersBase::UserTypeCompany;
        
        if(isset($_POST['UsersBase']['fname']) && isset($_POST['PersonaldecisionmakerBase']['email']))
        {
        	$_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST['UsersBase']['password_hash']);
        	$_POST['UsersBase']['uname'] = $_POST['PersonaldecisionmakerBase']['email'];
        	$_POST['UsersBase']['bdate'] = BrainHelper::dateGermanToEnglish($_POST['UsersBase']['bdate']);
        	$_POST['UsersBase']['group'] = 2;
        	$_POST['UsersBase']['permission'] = 2;
        	 
        	$userModel->load($_POST);
        	if($userModel->save(false))
        	{
        		$_POST['PersonaldecisionmakerBase']['userid'] = $userModel->id;
        		$model->load($_POST);
        		if($model->save(false))
        		{
        			$listurl = ['index'];
        			if(!$drawmenu)
        			{
        				$listurl['nomenu'] = 1;
        			}
        			if(isset($_GET['sv']))
        			{
        				$listurl['sv'] = $_GET['sv'];
        			}
        			return $this->redirect($listurl);
        		}
        	}
        	
        }
        
        $reachability = $model->reachability;
        $reachability = explode(',', $reachability);
        $reachabilitar = array();
        foreach ($reachability as $reach)
        {
        	$reach = trim($reach);
        	if($reach == '') continue;
        	$reachabilitar[] = $reach;
        }
        $model->reachability = $reachabilitar;
        $titleList = BrainStaticList::titleList();
        $title2List = BrainStaticList::title2List();
        $reachabiltyList = BrainStaticList::reachabilityList();
         
        return $this->render('create', [
        		'model' 			=> $model,
        		'userModel' 		=> $userModel,
        		'titleList' 		=> $titleList,
        		'title2List' 		=> $title2List,
        		'reachabiltyList' 	=> $reachabiltyList,
        ]);
        
    }

    /**
     * Updates an existing PersonaldecisionmakerBase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $userModel = $model->getUser();
        $userModel->usertype = UsersBase::UserTypeCompany;
        
		if(isset($_POST['UsersBase']['fname']) && isset($_POST['PersonaldecisionmakerBase']['email']))
		{
			//$_POST['UsersBase']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($_POST['UsersBase']['password_hash']);
        	$_POST['UsersBase']['uname'] = $_POST['PersonaldecisionmakerBase']['email'];
        	$_POST['UsersBase']['bdate'] = BrainHelper::dateGermanToEnglish($_POST['UsersBase']['bdate']);
        	$_POST['UsersBase']['group'] = 2;
        	$_POST['UsersBase']['permission'] = 2;
        	 
		    $_POST['PersonaldecisionmakerBase']['reachability'] = '';
        	$_POST['reachability'] = isset($_POST['reachability']) && is_array($_POST['reachability']) ? $_POST['reachability'] : array();
        	foreach ($_POST['reachability'] as $reach)
        	{
        		$_POST['PersonaldecisionmakerBase']['reachability'] .= $reach . ', ';
        	}

        	$userModel->load($_POST);
        	if($userModel->save(false))
        	{
        		$_POST['PersonaldecisionmakerBase']['userid'] = $userModel->id;
        		$model->load($_POST);
        		if($model->save(false))
        		{
        			return $this->redirect(['index']);
        		}
        	}
		}
		
        $reachability = $model->reachability;
        $reachability = explode(',', $reachability);
        $reachabilitar = array();
        foreach ($reachability as $reach)
        {
        	$reach = trim($reach);
        	if($reach == '') continue;
        	$reachabilitar[] = $reach;
        }
        $model->reachability = $reachabilitar;
        $titleList = BrainStaticList::titleList();
        $title2List = BrainStaticList::title2List();
        $reachabiltyList = BrainStaticList::reachabilityList();
        	
        return $this->render('update', [
             'model' 			=> $model,
             'userModel' 		=> $userModel,
             'titleList' 		=> $titleList,
             'title2List' 		=> $title2List,
             'reachabiltyList' 	=> $reachabiltyList,
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
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('password', [
            'model' 		=> $model,
            'message' 		=> $message,
        ]);
        
        
    }
    
    /**
     * Deletes an existing PersonaldecisionmakerBase model.
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
     * Finds the PersonaldecisionmakerBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonaldecisionmakerBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonaldecisionmakerBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
