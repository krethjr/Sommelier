<?php
/* @var $this CellarLocationController */
/* @var $data CellarLocation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->location), array('view', 'id'=>$data->cellar_loc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_desc')); ?>:</b>
	<?php echo CHtml::encode($data->location_desc); ?>
	<br />


</div>