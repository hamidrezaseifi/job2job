<?php

use yii\bootstrap\ActiveForm;

//jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */

$this->title = yii::$app->params['sitetitle'] . ' | ' . Yii::t('app', 'Home Page');

$this->registerJsFile("@web/web/js/index.js", [], 'js-index');

?>

<div>
    <div class="rightnav">
    	<div onclick="scrol_page(0 , this)" class="scroll_circle_button_full scroll_circle_button pointer circle1" ></div><br>
    	<div onclick="scrol_page(600 , this)" class="scroll_circle_button_empty scroll_circle_button pointer circle2" ></div><br>
    	<div onclick="scrol_page(1292 , this)" class="scroll_circle_button_empty scroll_circle_button pointer circle3" ></div><br>
    </div>
    
    <div class="index-part-1">
    	<div class="index-jobsearch-box">
    		<div class="index-jobsearch-title"><?php echo Yii::t('app', 'Jetzt Top Jobs in Ihrer Nähe finden');?></div>
    		<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/searchjobs', 'id' => 'searchform', 'method' => 'get'])?>
    		<div class="index-jobsearch-box-in" style="height: 100px;">
    			<input type="text" id="searchtext" name="st" placeholder="<?php echo Yii::t('app', 'Beruf, Job, Qualifikation'); ?>" />
    			<input type="text" id="searchort" name="so" placeholder="<?php echo Yii::t('app', 'Ort, PLZ'); ?>" />
    			<input type="submit" id="searchbutton" onclick="startSearch(); return false;" value="<?php echo Yii::t('app', 'Suche starten'); ?>">
    		</div>
    		<?php ActiveForm::end()?>
    	</div>
    	<div class="index-werbung-box-parent-parent">
    		<div class="index-werbung-box-parent">
    			<div class="index-werbung-box box1">
    				<img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/Medal-3-icon.png" width="60" style="float:left; clear:all; margin-right: 15px; margin-top: 5px;">
    				<div><?php echo Yii::t('app', 'Ihre Jobvermittlung'); ?></div>
    				<p><?php echo Yii::t('app', 'Felder aufüllen.<br>Suche starten'); ?></p>
    			</div>
    			<div class="index-werbung-box box2">
    				<img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/time-icon.png" width="60" style="float:left; clear:all; margin-right: 15px; margin-top: 10px;">
    				<div><?php echo Yii::t('app', 'Schneller Service'); ?></div>
    				<p><?php echo Yii::t('app', 'Innerhalb von 48h<br> Jobangebote erhalten'); ?></p>
    			</div>
    			<div class="index-werbung-box box3">
    				<img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/Medal-3-icon.png" width="60" style="float:left; clear:all; margin-right: 15px; margin-top: 5px;">
    				<div><?php echo Yii::t('app', 'Leistungen mit Profil'); ?></div>
    				<p><?php echo Yii::t('app', 'Wir überzeugen alle<br> Kunden!'); ?></p>
    			</div>
    		
    		</div>
    	</div>
    </div>
    <div class="index-gray-part">
    	<div>Job2Job benötigt keine 10 Gründe.</div><br>
    	<div>Lassen Sie sich durch unsere exzellente Arbeit überzeugen.</div><br>
    	<div>Madeleine Mohr, Geschäftsführerin <span class="j2jgreentext">Job2Job</span></div>
    </div>
    
    <div class="index-part-2" id="index-part-2">
    	<div class="index-part-2-in">
    			
    		<div class="index-part-2-title" style=" "> <?php echo Yii::t('app', 'Jobs der Woche'); ?> </div>
    		
    		<div class="index-part-2-job_title" style=" "> <?php echo Yii::t('app', 'Bezeichnung'); ?> </div>
    		<div class="index-part-2-ort_title" style=" "> <?php echo Yii::t('app', 'Ort'); ?> </div>
    		
    		<?php echo $jobitems;?>
    		
    		<div style="height: 50px; clear: both;" id="afterlastjobpos"></div>
    		<div class="index-part-2-title" id="nextjoblinkcontainer" style=" "><a href="#" onclick="nextJob(this); return false;"> <?php echo Yii::t('app', 'weitere ...'); ?></a> 
    		<img src="<?php echo Yii::getAlias('@web')?>/web/images//loading.gif" width="70" id="nextjobloading" />
    		</div>
    
    				
    	</div>
    	<div class="clear"></div>
    </div>
    
    <div class="index-title-3 j2jgreentext">
    	Fair - Menschlich - Teamorientiert
    </div>
    
    <div class="index-part-3" id="index-part-3">
    	<div class="index-part-3-in index-part-3-in-1">
    		
    		<div class="flex" ><div class="circle-white">1</div></div>
    		<div class="flex" ><img class="index-part-3-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/face_phone.png"></div>
    		<div class="index-part-3-in-title-1"><?php echo Yii::t('app', 'Telefonische Bearbeitung'); ?></div>
    		<div class="index-part-3-in-title-2 j2jgreentext"><?php echo Yii::t('app', 'Wir sind für Sie da'); ?></div>
    		<div class="index-part-3-in-text"><?php echo Yii::t('app', 'Bei Fragen oder Anregungen können Sie uns auch gerne telefonisch kontaktieren.'); ?></div>
    	</div>
    	
    	<div class="index-part-3-in index-part-3-in-2">
    		<div class="circle-white">2</div>
    		<div class="flex" ><img class="index-part-3-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/1480613190_home.png"></div>
    		<div class="index-part-3-in-title-1"><?php echo Yii::t('app', 'Arbeiten mit Herz'); ?></div>
    		<div class="index-part-3-in-title-2 j2jgreentext"><?php echo Yii::t('app', 'Jahrelange Erfahrung'); ?></div>
    		<div class="index-part-3-in-text1"><?php echo Yii::t('app', 'Unsere langjährige Erfahrung und die Freunde an der Arbeit wird sich schnell bemerkbar machen.'); ?></div>
    	</div>
    	
    	<div class="index-part-3-in index-part-3-in-3">
    		<div class="circle-white">3</div>
    		<div class="flex" ><img class="index-part-3-in-image" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/meal_serv_green.png"></div>
    		<div class="index-part-3-in-title-1"><?php echo Yii::t('app', 'Dreams Come True'); ?></div>
    		<div class="index-part-3-in-title-2 j2jgreentext"><?php echo Yii::t('app', 'Appetit auf Arbeit'); ?></div>
    		<div class="index-part-3-in-text"><?php echo Yii::t('app', 'Wir servieren Ihnen ihren Job oder Ihr Personal auf dem Silbertablett.'); ?></div>
    	</div>
    	
    </div>
</div>


<script type="text/javascript">

var nextjoburl = "<?php echo Yii::getAlias('@web')?>/site/nextjob";
var nextjobcount = 2;
var part_2_showed = false;

function page_animation()
{
	$(".index-werbung-box").css({ opacity: 0.0 });;
	$(".index-part-3-in").css({ opacity: 0.0 });;
	
	setTimeout("start_page_animation(1);" , 500);
	setTimeout("start_page_animation(2);" , 650);
	setTimeout("start_page_animation(3);" , 800);
}

function start_page_animation(index)
{
	if(index > 3)
		return;
	
	$( ".box" + index).animate({
		opacity: "1.0"
	  }, 900, function() {
		  //start_page_animation(index + 1);
	  });	
}

$(window).scroll(function(){
	//alert(333);
	//window.document.title = $(window).scrollTop() ;
		
	$(".scroll_circle_button").removeClass("scroll_circle_button_full").addClass("scroll_circle_button_empty");
	if($(window).scrollTop() + $(window).height() > $("#index-part-3").offset().top + 100)
	{
		$(".circle3").removeClass("scroll_circle_button_empty").addClass("scroll_circle_button_full");

		if(!part_2_showed)
		{
			part_2_showed = true;
			
			setTimeout("start_patrt2_animation(1);" , 500);
			setTimeout("start_patrt2_animation(2);" , 650);
			setTimeout("start_patrt2_animation(3);" , 800);
		}	
	}
	else
	{
		if($(window).scrollTop() + $(window).height() > $("#index-part-2").offset().top + 100)
		{
			$(".circle2").removeClass("scroll_circle_button_empty").addClass("scroll_circle_button_full");
		}
		else
		{
			$(".circle1").removeClass("scroll_circle_button_empty").addClass("scroll_circle_button_full");
		}

	}
});

function start_patrt2_animation(index)
{
	if(index > 3)
		return;
	
	$( ".index-part-3-in-" + index).animate({
		opacity: "1.0"
	  }, 900, function() {
		  //start_page_animation(index + 1);
	  });	
}

function scrol_page(y , div)
{
	$("html, body").animate({ scrollTop: y }, 300);
	//$(".scroll_circle_button_full").removeClass("scroll_circle_button_full").addClass("scroll_circle_button_empty");
	//$(div).removeClass("scroll_circle_button_empty").addClass("scroll_circle_button_full");
}

var places = new Array();

<?php foreach ($places as $place){?>
places.push("<?php echo $place;?>");
<?php }?>
</script>


