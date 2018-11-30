<?php

namespace backend\controllers;

use Yii;
use common\lib\CompanyBase;
use common\lib\CompanySearchBase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helper\BrainStaticList;
use yii\web\UploadedFile;
use common\lib\UploadedfilesBase;
use common\helper\BrainHelper;
use common\lib\PersonaldecisionmakerBase;
use common\lib\ConnectedcompanyBase;
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
        $model->founddate = '2015-01-01';
        $model->status = 1;
        $model->isjob2job = 0;
        
        $postdata = Yii::$app->request->post();
        
        $drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";
        
        if(isset($postdata['CompanyBase']['founddate']))
        {
        	$postdata['CompanyBase']['founddate'] = BrainHelper::dateGermanToEnglish($postdata['CompanyBase']['founddate']);
        	//print_r($postdata);exit;
        }
        if(isset($postdata['CompanyBase']))
        {
        	$postdata['CompanyBase']['createdate'] = date('Y-m-d H:i:s');
        	$postdata['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
        	//print_r($postdata);exit;
        }
        if ($model->load($postdata) && $model->save(false)) {

        	if(isset($postdata['petid']) && intval($postdata['petid']) > 0)
        	{
        		$pmodel = PersonaldecisionmakerBase::findOne(['userid' => $postdata['petid']]);
        		$pdata = array('PersonaldecisionmakerBase' => array('companyid' => $model->id));
        		$pmodel->load($pdata);
        		$pmodel->save(false);
        	}

        	if(isset($postdata['svid']) && intval($postdata['svid']) > 0)
        	{
        		$pmodel = PersonaldecisionmakerBase::findOne(['userid' => $postdata['svid']]);
        		$pdata = array('PersonaldecisionmakerBase' => array('companyid' => $model->id));
        		$pmodel->load($pdata);
        		$pmodel->save(false);
        	}
        	 
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
        	
        	$listurl = ['index'];
        	if(!$drawmenu)
        	{
        		$listurl['nomenu'] = 1;
        	}
        	
        	return $this->redirect($listurl);
        	 
        } else {
        	
        	$companytype_array = BrainStaticList::companyTypeList();
        	$employeecount_array = BrainStaticList::employeeCountList();
        	$connectedCompanies = ConnectedcompanyBase::findAll(['companyid' => $model->id]);
        	 
            return $this->render('create', [
                'model' 				=> $model,
    			'companytypeList'		=> $companytype_array,
    			'employeecountList'		=> $employeecount_array,
    			'personalEntscheider'	=> false,
    			'stellVertreter'		=> false,
            	'connectedCompanies'	=> $connectedCompanies,
            	'logopath'				=> false,
            	'logoModel'				=> null,
            ]);
        }
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

        $postdata = Yii::$app->request->post();
        if(isset($postdata['CompanyBase']['founddate']))
        {
        	$postdata['CompanyBase']['founddate'] = BrainHelper::dateGermanToEnglish($postdata['CompanyBase']['founddate']);
        	//print_r($postdata);exit;
        }
        if(isset($postdata['CompanyBase']))
        {
        	$postdata['CompanyBase']['updatedate'] = date('Y-m-d H:i:s');
        }
        
        if ($model->load($postdata) && $model->save(false)) {
        
        	if(isset($postdata['petid']) && intval($postdata['petid']) > 0)
        	{
        		$pmodel = PersonaldecisionmakerBase::findOne(['userid' => $postdata['petid']]);
        		$pdata = array('PersonaldecisionmakerBase' => array('companyid' => $model->id));
        		$pmodel->load($pdata);
        		$pmodel->save(false);
        	}

        	if(isset($postdata['svid']) && intval($postdata['svid']) > 0)
        	{
        		$pmodel = PersonaldecisionmakerBase::findOne(['userid' => $postdata['svid']]);
        		$pdata = array('PersonaldecisionmakerBase' => array('companyid' => $model->id));
        		$pmodel->load($pdata);
        		$pmodel->save(false);
        	}

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
        	
        	return $this->redirect(['index']);
        	
        } else {
        	
        	$companytype_array = BrainStaticList::companyTypeList();
        	$employeecount_array = BrainStaticList::employeeCountList();
        	$logopath = $this->company_logo($id);
        	$logoModel = UploadedfilesBase::findOne(['file' => $logopath]);
        	$connectedCompanies = ConnectedcompanyBase::findAll(['companyid' => $model->id]);
        	 
        	$plist = $model->personalDecisionMakerList();
        	$plist[0] = isset($plist[0]) ? $plist[0] : false;
        	$plist[1] = isset($plist[1]) ? $plist[1] : false;
        	 
            return $this->render('update', [
                'model' 				=> $model,
    			'companytypeList'		=> $companytype_array,
    			'employeecountList'		=> $employeecount_array,
    			'personalEntscheider'	=> $plist[0],
    			'stellVertreter'		=> $plist[1],
            	'connectedCompanies'	=> $connectedCompanies,
            	'logopath'				=> $logopath,
    			'logoModel'				=> $logoModel,
            ]);
        }
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
}
