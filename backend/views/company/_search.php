<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\CompanySearchBase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'companyname') ?>

    <?= $form->field($model, 'companytype') ?>

    <?= $form->field($model, 'founddate') ?>

    <?= $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'taxid') ?>

    <?php // echo $form->field($model, 'homepage') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'connectedcompanies') ?>

    <?php // echo $form->field($model, 'employeecountindex') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
