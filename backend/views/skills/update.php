<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Skills */
/* @var $parentpath string */
/* @var $ajax boolean */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Skills',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="skills-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    	'parentpath' => $parentpath,
    	'ajax' => $ajax,
    ]) ?>

</div>
