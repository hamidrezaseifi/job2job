<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\UsersBase */
/* @var $groups_list array */
/* @var $permissions_list array */
/* @var $status_list array */
/* @var $usertype_list array */
/* @var $message string */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if($message != '')
	$message = '<h6 class="error_message">' . $message . '</h6>';
?>
<div class="users-base-create">

    <h1><?= Html::encode($this->title) . $message ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'groups_list' => $groups_list,
    	'permissions_list' => $permissions_list,
        'status_list' 		=> $status_list,
        'usertype_list' 	=> $usertype_list,
        'message' => $message,
    	]) ?>

</div>
