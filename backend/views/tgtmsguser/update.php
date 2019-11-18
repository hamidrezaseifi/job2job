<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\TargetMessageUsersBase */
/* @var $userlist array */

$this->title = Yii::t('app', 'Nachricht Benutzer Bearbeiten');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nachricht Benutzer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'id' => $model->userid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Bearbeiten');
?>
<div class="target-message-users-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userlist' => $userlist,
    ]) ?>

</div>
