<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;

/**
 * Site controller
 */
class UtilsController extends Controller
{
	public $layout = 'utils';
	public $enableCsrfValidation = false;
	
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**gethash
     * Displays homepage.
     *
     * @return string
     */
    public function actionGethash()
    {
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->post();
    		$text= $data['text'];
	    	echo Yii::$app->security->generatePasswordHash($text);
	    	exit;
    	}
    	return '';
    }
    
    
}
