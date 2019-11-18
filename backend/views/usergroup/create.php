<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\UsergroupBase */
/* @var $status_list array */

$this->title = Yii::t('app', 'Benutzergruppe Erstellen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benutzergruppen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status_list' 		=> $status_list,
    ]) ?>

</div>
