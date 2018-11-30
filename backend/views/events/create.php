<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\FrontlogBase */

$this->title = Yii::t('app', 'Create Frontlog Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frontlog Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontlog-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
