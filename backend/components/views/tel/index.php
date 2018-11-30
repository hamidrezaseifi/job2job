<?php
/* @var $telephonParts array */
/* @var $name string */
/* @var $id string */
/* @var $class string */
/* @var $label string */

$idstr = $id ? ' id="' . $id . '" ' : '';
$namestr = $name ? ' name="' . $name . '" ' : '';

?>

<div class="form-group field-<?=$id ?>">
	<?php if($label){?><label><?php echo $label;?></label><?php } ?>
	<div style="height: 30px;">
		<div style="width: 20%; float: left; margin-right: 5px;"><input value="<?=$telephonParts[0] ?>" type="text" id="<?=$id ?>telpart1" onchange="var p = $(this).parent().parent(); var inp = p.children('div'); p.children('input[type=\'hidden\']').val($(inp[0]).children().val() + '-' + $(inp[1]).children().val() + '-' + $(inp[2]).children().val());" class="form-control" maxlength="10"></div>
		<div style="width: 20%; float: left; margin-right: 5px;"><input value="<?=$telephonParts[1] ?>" type="text" id="<?=$id ?>telpart2" onchange="var p = $(this).parent().parent(); var inp = p.children('div'); p.children('input[type=\'hidden\']').val($(inp[0]).children().val() + '-' + $(inp[1]).children().val() + '-' + $(inp[2]).children().val());" class="form-control" maxlength="10"></div>
		<div style="width: 59%; float: left; "><input value="<?=$telephonParts[2] ?>" type="text" id="<?=$id ?>telpart3" onchange="var p = $(this).parent().parent(); var inp = p.children('div'); p.children('input[type=\'hidden\']').val($(inp[0]).children().val() + '-' + $(inp[1]).children().val() + '-' + $(inp[2]).children().val());" class="form-control" maxlength="10"></div>
		<input type="hidden" <?php echo $idstr . $namestr; ?> value="<?=$telephonParts[0] . '-' . $telephonParts[1] . '-' . $telephonParts[2] ?>" />
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">

$(document)
</script>

