<?php


/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Object */

use yii\helpers\Html;

$name = $name == 'Not Found (#404)' ? '#404' : $name;

$this->title = $name;
?>
<div class="site-error" style="margin: 40px 20px">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php 
	$exception = Yii::$app->errorHandler->exception;
	if ($exception !== null) {
	    
	    if(isset($exception->statusCode) && $exception->statusCode == 404){
	        $message = '#404: Seite nicht gefunden.';
	    }
	    
	}
	?>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Der Fehler trat auf, während der Webserver Ihre Anforderung verarbeitete.
    </p>
    <p>
        Bitte kontaktieren Sie uns, wenn Sie glauben, dass dies ein Serverfehler ist. Vielen Dank.
    </p>

</div>
