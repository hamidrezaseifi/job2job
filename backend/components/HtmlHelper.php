<?php
namespace backend\components;

use Yii;
use yii\base\BaseObject;

class HtmlHelper extends BaseObject
{
    public $controllerName;
    public $visibleButtons;
    public $extraButtons;
    public $template;
    public $buttons;
    public $header;
    
    public function init()
    {
        parent::init();
        
        if ($this->controllerName === null) {
            $this->controllerName = 'test';
        }
        
        if ($this->visibleButtons === null) {
            $this->visibleButtons = [];
        }
        
        if ($this->extraButtons === null) {
            $this->extraButtons = [];
        }
        
        if ($this->header === null) {
            $this->header = '';
        }
        
        if ($this->template === null) {
            $this->template = '{view} {update} {delete}';
        }
        
        $this->buttons = [
            'update' => function ($url, $model, $key) {
            return '<a title="' . Yii::t('app', 'Bearbeiten') . '" href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/update?id=' . $key . '" ><img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/edit.png" width="20"></a>';
            },
            'view' => function ($url, $model, $key) {
            return '<a title="' . Yii::t('app', 'Anzeigen') . '" href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/view?id=' . $key . '" ><img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/eye.png" width="20"></a>';
            },
            'delete' => function ($url, $model, $key) {
            return '<a href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/delete?id=' . $key . '" title="Löschen" aria-label="Delete" data-pjax="0" data-confirm="Möchten Sie diesen Artikel wirklich löschen?" data-method="post"><img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/trash.png" width="20"></a>';
            },
            ];
        
        foreach ($this->extraButtons as $button => $setting){
            $this->buttons[$button] = $setting;
        }
    }
    
    public function render() {
        $actionmenu = [
            'class' => 'yii\grid\ActionColumn',
            'header' => $this->header,
            'headerOptions' => ['style' => 'width : 50px;'],
            'template' => $this->template,
            'visibleButtons' => $this->visibleButtons,
            'buttons' => $this->buttons,
                ] ;
        
        return $actionmenu;
    }
}

