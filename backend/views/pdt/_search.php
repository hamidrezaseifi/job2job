<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\PersonaldecisionmakerBaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaldecisionmaker-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'companyid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title2') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'cellphone') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'reachability') ?>

    <?php // echo $form->field($model, 'contacttime') ?>

    <?php // echo $form->field($model, 'isdeputy') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
