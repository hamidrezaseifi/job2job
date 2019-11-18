<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\TargetMessageUsersBase */
/* @var $userlist array */

$this->title = Yii::t('app', 'Nachricht Benutzer Erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nachricht Benutzer Erstellen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-message-users-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'userlist' => $userlist,
    ]) ?>

</div>
