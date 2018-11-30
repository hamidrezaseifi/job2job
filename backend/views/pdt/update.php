<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\PersonaldecisionmakerBase */

$this->title = Yii::t('app', 'Personalentscheider bearbeiten');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personalentscheider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Personalentscheider bearbeiten');
?>
<div class="personaldecisionmaker-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        		'model' => $model,
                'userModel' 		=> $userModel,
                'titleList' 		=> $titleList,
                'title2List' 		=> $title2List,
                'reachabiltyList' 	=> $reachabiltyList,
    ]) ?>

</div>
