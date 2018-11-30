<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->registerJsFile("@web/web/js/about.js", [], 'js-about');
$this->registerCssFile("@web/web/css/carrier.css", [], 'css-carrier');
$this->registerCssFile("@web/web/css/imageheader.css", [], 'css-imageheader');

?>
<div class="site-carrier">

    <div class="anim-image-header" style="background-image: url(<?=Yii::getAlias('@web') ?>/web/images/Gesundheitswesen.jpg);">
    
    		<div class="anim-image-title">
    			<?php echo Yii::t('app', 'Karriere Intern'); ?>
    		</div>
    </div>

	<br>
	
	<div class="staticpage-desc boxcontainer boxcontainer2">	
		<div class="title"><b><?php echo Yii::t('app', 'Karriere bei Job2Job'); ?></b></div>
		<div class="title2"><b><?php echo Yii::t('app', 'Join the team!'); ?></b></div>
		<div><center><?php echo Yii::t('app', 'Suchen Sie einen Job, der Ihnen Freude bereitet? Job2Job bietet die optimalen Voraussetzungen dafür. Wir sind überzeugt, dass Freude an der Arbeit und überdurchschnittliche Leistungen Hand in Hand gehen. Deshalb bieten wir Ihnen eine hohe Flexibilität und viele Freiheiten in einem dynamischen Umfeld, wo Sie wirklich etwas bewegen können. Kommen Sie in unser Team und werden Sie Teil der Job2Job Erfolgsstory!'); ?></center></div>
		
		
		<div class="box box1">
			<div class="title2"><b><?php echo Yii::t('app', 'Wer sind wir?'); ?></b></div>
			Wir sind ein junges Unternehmen mit einer steilen Wachstumskurve und grossen Zielen: Wir wollen die Job-Welt verändern!
			À propos jung: Das heisst für uns flexibel, unkompliziert, persönlich, innovativ und familiär und soll sich keineswegs auf das Alter beziehen. Wir pflegen bei uns flache Hierarchien und kurze Entscheidungswege.
			Unser Pioniergeist hat uns zum führenden Marktplatz für flexible Arbeit gemacht. Seit unserem Start im Jahr 2010 haben wir eine rasante Entwicklung hingelegt.
		
		</div>
		
		<div class="box box2">
			<div class="title2"><b><?php echo Yii::t('app', 'Was bieten wir?'); ?></b></div>
			Wir bieten Ihnen die optimalen Voraussetzungen, damit Ihnen Ihr Job Freude bereitet. In einer tollen Arbeitsatmosphäre genießen Sie bei uns viele Freiräume und können flexibel arbeiten. 
			Wir halten nichts von starren Strukturen, zu vielen Vorschriften oder Fixzeiten – Sie alleine wissen am besten, wie und wann Sie Ihre Bestleistungen abrufen können. Deshalb bieten wir flexible Arbeitsmodelle an.
			Außerdem ist es einfach ein tolles Gefühl, jeden Tag aufzustehen und die Zukunft des weltweit ersten Anbieters für Just-in-Time Personallösungen aktiv mitzugestalten!
		</div>
			
		<div class="box box3 box-last">
			<div class="title2"><b><?php echo Yii::t('app', 'Wen suchen wir?'); ?></b></div>
			Da wir ein starkes Wachstum verzeichnen, sind wir laufend auf der Suche nach motivierten Talenten, die mit ihrer Arbeit etwas bewegen möchten. 
			Ob Absolvent, Quereinsteiger oder Experte – wir suchen Menschen, die zu uns passen. Neben der beruflichen Qualifikation spielt bei uns die Persönlichkeit eine große Rolle. Unsere Mitarbeiter zeichnen sich durch eine hohe Leistungsbereitschaft, Verantwortungsbewusstsein, Kundenorientierung und Passion für ihre Aufgabe aus.
			Kommen Sie mit an Bord und werde Teil dieser Erfolgsgeschichte. Die Reise hat gerade erst begonnen.
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="staticpage-desc carrier-container">
	<?php if(count($jobModels) > 0) {?>
		<div class="title2"><b><?php echo Yii::t('app', 'Zur Zeit sind folgende Positionen offen'); ?> :</b></div>
		
		<ul>
			<?php foreach ($jobModels as $jobModel){?>
			<li> <a href="<?=Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobModel->id;?>"><?php echo $jobModel->title?></a></li>
			<?php } ?>
		</ul>
	<?php } else {?>
		<div class="title2"><b><?php echo Yii::t('app', 'Zur Zeit gibt keine Position offen!'); ?> </b></div>
	<?php } ?>
	</div>
</div>




