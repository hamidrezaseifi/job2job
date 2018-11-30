<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CandidateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title2') ?>

    <?= $form->field($model, 'nationality') ?>

    <?= $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'pcode') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'cellphone') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'reachability') ?>

    <?php // echo $form->field($model, 'contacttime') ?>

    <?php // echo $form->field($model, 'employment') ?>

    <?php // echo $form->field($model, 'availability') ?>

    <?php // echo $form->field($model, 'jobtype') ?>

    <?php // echo $form->field($model, 'availablefrom') ?>

    <?php // echo $form->field($model, 'desiredjobpcode') ?>

    <?php // echo $form->field($model, 'desiredjobcity') ?>

    <?php // echo $form->field($model, 'desiredjobcountry') ?>

    <?php // echo $form->field($model, 'desiredjobregion') ?>

    <?php // echo $form->field($model, 'desiredjobtimetype') ?>

    <?php // echo $form->field($model, 'coverletter') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
