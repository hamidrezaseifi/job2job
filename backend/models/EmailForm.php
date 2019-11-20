<?php
namespace backend\models;

use Yii;
use yii\base\Model;

use common\lib\BackendUserModel;
use common\lib\UsersBase;

/**
 * Login form
 */
class EmailForm extends Model
{
    public $receiver;
    public $title;
    public $body;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['receiver', 'title', 'body'], 'required'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'receiver' => Yii::t('app', 'Empfänger'),
            'title' => Yii::t('app', 'Titel'),
            'body' => Yii::t('app', 'Inhalt'),
            
        ];
    }

}
