<?php
/* @var $columns array */
/* @var $headerattr string */
/* @var $headerclass string */
/* @var $headerstyle string */


?>
<thead>
<?php 
	foreach ($columns as $column)
	{
		?>
	<th<?php
	if(isset($column['attribute']) && is_array($column['attribute']))
	{
		foreach ($column['attribute'] as $key => $attribute)
		{
			echo ' ' . $key . '="' . $attribute . '" ';
		}
	}
	?> ><?=((isset($column['label']))? $column['label'] : '') ?></th>
		<?php 
	}

?>
</thead>