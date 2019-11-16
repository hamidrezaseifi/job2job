<?php
namespace backend\components;

use Yii;
use yii\base\BaseObject;

class HtmlHelper extends BaseObject
{
    public $controllerName;
    public $visibleButtons;
    
    public function init()
    {
        parent::init();
        
        if ($this->controllerName === null) {
            $this->controllerName = 'test';
        }
        
        if ($this->visibleButtons === null) {
            $this->visibleButtons = [];
        }
    }
    
    public function run() {
        $actionmenu = [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width : 50px;'],
            'template' => '{view} {update} {delete}',
            'visibleButtons' => $this->visibleButtons,
            'buttons' => [
                'update' => function ($url, $model, $key) {
                return '<a title="' . Yii::t('app', 'Bearbeiten') . '" href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/update?id=' . $key . '" ><i class="fa fa-edit"></i></a>';
                },
                'view' => function ($url, $model, $key) {
                return '<a title="' . Yii::t('app', 'Anzeigen') . '" href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/view?id=' . $key . '" ><i class="fa fa-eye"></i></a>';
                },
                'delete' => function ($url, $model, $key) {
                return '<a href="' . Yii::getAlias('@web') . '/' . $this->controllerName . '/delete?id=' . $key . '" title="Löschen" aria-label="Delete" data-pjax="0" data-confirm="Möchten Sie diesen Artikel wirklich löschen?" data-method="post"><i class="fa fa-trash"></i></a>';
                },
                ],
                ] ;
        
        return $actionmenu;
    }
}

