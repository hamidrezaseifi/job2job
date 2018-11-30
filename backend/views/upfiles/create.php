<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\UploadedfilesBase */

$this->title = Yii::t('app', 'Create Uploadedfiles Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Uploadedfiles Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadedfiles-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
