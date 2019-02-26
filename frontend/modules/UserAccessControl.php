<?php
namespace frontend\modules;

use Yii;
use yii\base\ActionFilter;
use yii\di\Instance;
use yii\web\User;
use yii\web\ForbiddenHttpException;

class UserAccessControl extends ActionFilter
{
    public const CANDIDATE_USER = 'candidate';
    public const COMPANY_USER = 'company';
    public const GUEST_USER = 'guest';
    
    public $rules = [];
    public $user = 'user';
    public $ruleConfig = ['class' => 'yii\filters\AccessRule'];
    public $actions = [];
    
    public function init()
    {
        parent::init();
        if ($this->user !== false) {
            $this->user = Instance::ensure($this->user, User::className());
        }
        
        foreach ($this->rules as $rule) {
            foreach($rule['actions'] as $action){
                $this->actions[$action] = $rule['access'];
            }
            
        }
        
        //print_r($this->actions);
        //print_r($this->user->identity);
        
        //exit;
    }
    
    public function beforeAction($action)
    {
        $hasAccess = true;
        if(array_key_exists($action->id,$this->actions)){
            $access = $this->actions[$action->id]; 

            if($this->user->isGuest){
                $hasAccess = in_array(UserAccessControl::GUEST_USER, $access);
            }
            else{
                if($this->user->identity->isCandidate()){
                    $hasAccess = in_array(UserAccessControl::CANDIDATE_USER, $access);
                }
                
                if($this->user->identity->isCompany()){
                    $hasAccess = in_array(UserAccessControl::COMPANY_USER, $access);
                }
            }
            
            
        }
        if(!$hasAccess){
            Yii::$app->getResponse()->redirect(Yii::getAlias ('@web'));
        }
        return true;
    }
    
    
        
}

