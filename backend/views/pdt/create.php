<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\PersonaldecisionmakerBase */

$this->title = Yii::t('app', 'Neuen Personalentscheider erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personalentscheider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personaldecisionmaker-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        		'model' => $model,
                'userModel' 		=> $userModel,
                'titleList' 		=> $titleList,
                'title2List' 		=> $title2List,
                'reachabiltyList' 	=> $reachabiltyList,
    ]) ?>

</div>
