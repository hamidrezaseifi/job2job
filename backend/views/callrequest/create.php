<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\CallrequestBase */

$this->title = Yii::t('app', 'Create Callrequest Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Callrequest Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callrequest-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
