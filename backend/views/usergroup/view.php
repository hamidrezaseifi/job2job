<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\NavigationAccessTreeView;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $model common\lib\UsergroupBase */ 

$this->title = 'Benutzergruppe Anzeigen';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benutzergruppen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?php if($model->id != 1) {
        echo Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . ' &nbsp; ';
        echo Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Möchten Sie diesen Artikel wirklich löschen?'),
                'method' => 'post',
            ],
        ]);
        } else { echo '<br>';}?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
        	[
        		'label' => 	Yii::t('app', 'Status'),
        		'value' => ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', Inaktiv)),
    		],
            'createdate',
            'updatedate',
        ],
    ]) ?>

</div>

<div class="user-group-base-view">
<?php 
	echo NavigationAccessTreeView::widget(['viewid' => 'trwnavihation' , 'allow_edit' => false ,
		'viewclass' => 'table table-striped table-bordered' , 'viewstyle' => '' , 
		'groupid' => $model->id,
	]);
?>
</div>

