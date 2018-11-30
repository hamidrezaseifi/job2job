<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\TargetMessageUsersBase */
/* @var $form yii\widgets\ActiveForm */
/* @var $userlist array() */

?>

<div class="target-message-users-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->dropDownList($userlist) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
