<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
