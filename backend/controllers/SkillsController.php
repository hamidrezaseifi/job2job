<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\lib\SkillsSearchBase;
use common\lib\SkillsBase;


/**
 * SkillsController implements the CRUD actions for Skills model.
 */
class SkillsController extends Controller
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
     * Lists all Skills models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SkillsSearchBase();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Skills model.
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
     * Creates a new Skills model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($partial = 0 , $pid = 0)
    {
        $model = new SkillsBase();
        $model->status = 1;
        
        $parentpath = '';
        if($pid != 0)
        {
        	$model->parentid = $pid;
        	$parentpath = SkillsBase::skillParentPath($model->parentid);
        	
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($partial)
        	{
        		echo 'ok';
        		exit;
        	}
        	else 
        	{
            	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } else {
        	
        	if($partial == 0)
        	{
	            return $this->render('create', [
	                'model' => $model,
	            	'parentpath' => $parentpath,
	            	'ajax' => false,
	            ]);
        	}
        	else 
        	{
        		return $this->renderPartial('create', [
        			'model' => $model,
        			'parentpath' => $parentpath,
	            	'ajax' => true,
        		]);
        		
        	}
        }
    }

    /**
     * Updates an existing Skills model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id , $partial = 0)
    {
        $model = $this->findModel($id);

        $parentpath = SkillsBase::skillParentPath($model->parentid);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($partial)
        	{
        		echo 'ok';
        		exit;
        	}
        	else 
        	{
            	return $this->redirect(['view', 'id' => $model->id]);
        	}
        } 
        else {
        	if($partial == 0)
        	{
	            return $this->render('update', [
	                'model' => $model,
	            	'parentpath' => $parentpath,
	            	'ajax' => false,
	            ]);
        	}
        	else 
        		{
        			return $this->renderPartial('update', [
        				'model' => $model,
        				'parentpath' => $parentpath,
        				'ajax' => true,
        			]);
        		}
        		
        }
    }

    /**
     * Deletes an existing Skills model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id = 0 , $partial = 0)
    {
    	if($partial)
    	{
    		$id = \Yii::$app->request->pos('id');
    	}
    	
    	$childs = SkillsBase::listChilds($id);
    	$childs[$id] = $id;
    	
    	SkillsBase::deleteAll('id in (' . implode(',', array_values($childs)) . ')');
    	
    	if($partial)
    	{
    		echo 'ok';
    		exit;
    	}
    	else
    	{
    		return $this->redirect(['index']);
    	}
    }
    
    public function actionListtree()
    {
    	$res = '';//'<ul><li class="jstree-open" skillid="0">root';
    	
    	$list = SkillsBase::allTree();
    	$res .= $this->render_tree($list);
    	
    	//$res .= '</li></ul>';

        return $res;
        //exit;
    }

    function render_tree($list)
    {
    	if(count($list) == 0)
    		return '';
    	$res = '<ul>';
    	foreach ($list as $item)
    	{
    		$res .= '<li class="jstree-open" skillid="' . $item['id'] . '">' . $item['title'];
    		$res .= $this->render_tree($item['childs']);
    		$res .= '</li>';
    	}
    	$res .= '</ul>';
    	
    	return $res;
    }
    
/**
     * Finds the Skills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Skills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SkillsBase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
