<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\BackMessageBase */

$this->title = Yii::t('app', 'Create Back Message Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Back Message Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="back-message-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
