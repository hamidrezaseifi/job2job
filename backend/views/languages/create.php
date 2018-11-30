<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\lib\LanguagesBase */

$this->title = Yii::t('app', 'Create Languages Base');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="languages-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
