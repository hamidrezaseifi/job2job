<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $candidateModel common\lib\CandidateBase */
/* @var $userModel common\lib\UsersBase */
/* @var $titleList array */
/* @var $title2List array */
/* @var $nationalityList array */
/* @var $reachabiltyList array */
/* @var $employeementList array */
/* @var $accessableList array */
/* @var $distanceList array */
/* @var $branchs array */

$this->title = Yii::t('app', 'Bewerber erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bewerber'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'userModel' 		=> $userModel,
		'candidateModel' 	=> $candidateModel,
		'titleList' 		=> $titleList,
		'title2List' 		=> $title2List,
		'nationalityList' 	=> $nationalityList,
		'reachabiltyList' 	=> $reachabiltyList,
		'employeementList' 	=> $employeementList,
		'accessableList' 	=> $accessableList,
        'distanceList' 		=> $distanceList,
        'branchs' 		    => $branchs,
    ]) ?>

</div>
