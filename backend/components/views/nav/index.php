<?php
/* @var $items array */
/* @var $navid string */
/* @var $navclass string */
/* @var $navstyle string */


use yii\helpers\Url;

function render_list($list , $id = '')
{
	$navidstr = '';
	if($id != '')
		$navidstr = ' id="' . $id . '" ';
	
	echo '<ul' . $navidstr . '>' . PHP_EOL;
	foreach($list as $navitem)
	{
		if(isset($navitem['label']))
		{
			echo '<li><div><a href="' . Yii::$app->urlManager->createUrl($navitem['url']) . '"><span class="glyphicon ' . (isset($navitem['image']) ? $navitem['image'] : 'nav_emptyimage') . '"></span>&nbsp;'. $navitem['label'] . '</a></div>';
			if(isset($navitem['childs']) && count($navitem['childs']))
			{
				echo PHP_EOL;
				render_list($navitem['childs']);
			}
			echo '</li>' . PHP_EOL;
		}
		else
		{
			if(is_string($navitem))
			{
				echo $navitem;
			}
		}
	}
	echo '</ul>' . PHP_EOL;
}

$navidstrdv = '';
if($navid != '')
{
	$navidstrdv = ' id="' . $navid . '_wrapper" ';
}

if($navclass != '')
	$navclass = ' class="' . $navclass . '" ';

if($navstyle != '')
	$navstyle = ' style="' . $navstyle . '" ';



			?>
<div <?=$navidstrdv ?> <?=$navclass ?> <?=$navstyle ?>>
<?php 

render_list($items , $navid);

?>
</div>

<script>
	$("#<?=$navid ?>").menu();
</script>