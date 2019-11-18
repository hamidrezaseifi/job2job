<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\BackMessageBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Back Message Bases');
$this->params['breadcrumbs'][] = $this->title;


$helper = new HtmlHelper([
    'template' => '{view} {delete}',
    
            
            ]);


?>
<div class="back-message-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Back Message Base'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'title',
            'message',
            'status',

            $helper->render(),
        ],
    ]); ?>
</div>
