<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\EmailtextBase */

$this->title = Yii::t('app', 'Create Emailtext Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtext Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailtext-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
