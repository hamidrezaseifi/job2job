<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\EmailtextBase */

$this->title = 'Email-Inhalt Anzeigen';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email-Inhalt'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Email-Inhalt');
?>
<div class="emailtext-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/emailtext/delete?id=' . $model->id]); ?>
    		
    	<?php ActiveForm::end(); ?>     
    	
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Möchten Sie diesen Artikel wirklich löschen?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
        	'title',
            'text:ntext',
            //'texttype',
            [
        		'label' => 	Yii::t('app', 'Status'),
        		'value' => ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Inaktiv')),
        	],
        ],
    ]) ?>

</div>
