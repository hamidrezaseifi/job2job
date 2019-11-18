<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\UsergroupSearchBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Benutzergruppen');
$this->params['breadcrumbs'][] = $this->title;


$helper = new HtmlHelper([
    'visibleButtons' => [
        'update' => function ($model, $key, $index) {
        return $model->id > 2;
        },
        'delete' => function ($model, $key, $index) {
        return $model->id > 2;
        },
        'view' => function ($model, $key, $index) {
        return true;
        },
        ]
        ]);


?>
<div class="user-group-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Benutzergruppe Erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
        	[
        		'label' => Yii::t('app', 'Status'),
        		'value' => function($model){ return ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', Inaktiv));}
    		],
            'createdate',
            'updatedate',

            $helper->render(),
        ],
    ]); ?>
</div>
