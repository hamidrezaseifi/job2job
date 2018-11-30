<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Skills */
/* @var $ajax boolean */
/* @var $parentpath string */

$this->title = Yii::t('app', 'Create Skills');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    	'parentpath' => $parentpath,
    	'ajax' => $ajax,
    ]) ?>

</div>
