<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Yii::t('app', 'Job2Job - Backend') ?></h1>

        
    </div>

    <div class="body-content container">

        <div class="row">
            <div class="col-sm">
	            <div class="col-in">
	                <span class="head"><?=Yii::t('app', 'Statistiken') ?></span>
	
	                <p>
	                Hier stehen Ihnen neue Statistiken für einen beliebig wählbaren Zeitraum zur Verfügung:<br>
					- Wie oft wurde meine Website besucht?<br>
					- Mit welchem Browser wurde meine Website besucht?<br>
					...<br>
	                </p>
	            </div>
            </div>
            <div class="col-sm">
            	<div class="col-in">
	                <span class="head"><?=Yii::t('app', 'Matchmaking') ?></span>
	
	                <p>Hier finden Sie die neuesten Matches zwischen Bewerbern und Unternehmen. Zum späteren Zeitpunkt, können Sie manuell die vom System angezeigten Matches auf Ihre Richtigkeit überprüfen.</p>

                </div>
            </div>
            <div class="col-sm">
            	<div class="col-in">
	                <span class="head"><?=Yii::t('app', 'Messages') ?></span>
	
	                <p>Hier werden Ihnen die neuesten Nachrichten angezeigt. Hierbei kann es sich um Supportfragen, aber auch um neue Email-Messages handeln.</p>

                </div>
            </div>
        </div>

    </div>
</div>
