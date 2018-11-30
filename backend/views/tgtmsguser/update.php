<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\TargetMessageUsersBase */
/* @var $userlist array */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Target Message Users Base',
]) . $model->userid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Target Message Users Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'id' => $model->userid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="target-message-users-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userlist' => $userlist,
    ]) ?>

</div>
