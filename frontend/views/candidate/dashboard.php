<?php

/* @var $this yii\web\View */
/* @var $subpageContent string */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

// $this->registerCssFile("@web/web/css/regbewerbungresp.css", [], 'css-bewerbungresp');

?>

<?php

$this->beginContent('@app/views/layouts/candidate_dashboard.php',
    [
        'photopath' => $photopath,
        'photo_approved' => $photo_approved,
        'percentTotal' => $percentTotal,
        'percentCalc' => $percentCalc
    ]);
?>

<?php
echo $subpageContent;
?>

<?php

$this->endContent();
?>

<?php

if ($after_verify) {
    ?>
<div id="showprofilemsg">
	<div class="text-msg">
		<?php

echo Yii::t('app', 'Willkommen auf Job2Job!');
    ?>
		<br><br>
		<?php

echo Yii::t('app',
        'Um als Bewerber gefunden zu werden und schnell auf sich aufmerksam zu machen, benötigen Sie ein ausgefülltes Profil. Sie können jetzt sofort damit beginnen ihr Profil zu vervollständigen. <br>Job2Job wünscht Ihnen viel Erfolg!');
    ?>
		<br>
		<div style="margin-top: 10px;">
			<a href="javascript:void" onclick="$('#showprofilemsg').hide();"><?php

echo Yii::t('app', 'abbrechen');
    ?></a>
			<a href="<?php

echo Yii::getAlias('@web/candidate/dashboard/myprofile')?>" class="j2jgreenback"><?php

echo Yii::t('app', 'Profil vervollständigen');
    ?></a>
		</div>
	</div>

</div>
<?php

}
?>

<script type="text/javascript">
var cityurl = "<?php

echo Yii::getAlias('@web/site/allcities');
?>";
var postcodeurl = "<?php

echo Yii::getAlias('@web/site/allpostcodes');
?>";
var placesurl = "<?php

echo Yii::getAlias('@web/site/allplaces');
?>";
</script>
