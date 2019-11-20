<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\EmailForm;

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

    /**
     * Lists all CandidatejobapplyBase models.
     * @return mixed
     */
    public function actionIndex()
    {
    	
        $model = new EmailForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
