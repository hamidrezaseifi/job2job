<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $candidateModel common\models\CandidateBase */
/* @var $userModel common\models\UsersBase */

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
        		'countryList' 		=> $countryList,
        		'reachabiltyList' 	=> $reachabiltyList,
        		'employeementList' 	=> $employeementList,
        		'accessableList' 	=> $accessableList,
        		'worktypeList' 		=> $worktypeList,
    			'distanceList' 		=> $distanceList,
    ]) ?>

</div>
