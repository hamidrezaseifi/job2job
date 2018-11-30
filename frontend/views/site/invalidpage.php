<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


?>
<div class="site-index" style="padding-left: 50px;">
    <h1><?php echo Yii::t('app', 'Ungültige Seite!'); ?></h1>

    <p><?php echo (isset($_GET['msg']) ? urldecode($_GET['msg']) : Yii::t('app', 'Ungültige Seite!')); ?></p>

</div>
