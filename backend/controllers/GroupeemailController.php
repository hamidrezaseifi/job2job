<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\EmailForm;
use common\lib\CandidateBase;
use common\lib\CompanyBase;
use common\lib\EmailtextBase;

/**
 * ApplyController implements the CRUD actions for CandidatejobapplyBase model.
 */
class GroupeemailController extends Controller
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
    
    public function actionIndex()
    {
        
        $model = new EmailForm();
        return $this->render('index', [
            'model' => $model,
            'errmsg' => isset($_GET['errmsg']) ? $_GET['errmsg'] : false,
            'okmsg' => isset($_GET['okmsg']) ? $_GET['okmsg'] : false,
        ]);
    }
    
    public function actionMail()
    {
        //header('Content-type: application/json');
        //$this->layout=false;
        
        $model = new EmailForm();
        if($model->load($_POST) && $model->sendMail()){
            return $this->redirect('index?okmsg=Die E-Mails wurde erfolgreich Versendet');
        }
        
        
        return $this->redirect('index?errmsg=Fehler beim Senden den E-Mails');
        //print_r($model); exit;
    }
    
    
    
    public function actionLoadusers()
    {
        header('Content-type: application/json');
        $this->layout=false;
        
        $results = ['status' => 'ok'];
        
        $models = CandidateBase::find()->select(['userid', 'email'])->all();
        $list = [];
        foreach($models as $model){
            $list[] = ['email' => $model->email, 'name' => $model->user()->fullname(), 'status' => $model->user()->statusTitle()];
        }
        
        $results['candidates'] = $list;
        
        $models = CompanyBase::find()->select(['id', 'companyname', 'status', 'isjob2job'])->all();
        $list = [];
        foreach($models as $model){
            if($model->isjob2job == 1){
                continue;
            }
            $company = ['name' => $model->companyname, 'status' => $model->statusTitle(), 'users' => []];
            $persons = $model->personalDecisionMakerList();
            foreach($persons as $person){
                $company['users'][] = ['email' => $person->email, 'name' => $person->getUser()->fullname(), 'status' => $person->getUser()->statusTitle(), 'position' => $person->isdeputy ? 'Stellvertreter' : 'Personalentscheider'];
            }
            $list[] = $company;
        }
        
        $results['companies'] = $list;
        
        
        echo json_encode($results);
        exit;
    }
    
    public function actionLoademailtexts()
    {
        header('Content-type: application/json');
        $this->layout=false;
        
        $results = ['status' => 'ok'];
        
        $models = EmailtextBase::find()->where(['status' => 1])->all();
        $list = [];
        foreach($models as $model){
            $list[$model->id] = ['title' => $model->title, 'text' => \Yii::$app->formatter->asNtext($model->text), 'html' => \Yii::$app->formatter->asNtext($model->text), 'id' => $model->id];
        }
        
        $results['texts'] = $list;
        
        echo json_encode($results);
        exit;
    }
    
}
