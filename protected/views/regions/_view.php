<?php
/* @var $this RegionsController */
/* @var $data Regions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('region_name')); ?>:</b>
	<?php echo CHtml::encode($data->region_name); ?>
	<br />


</div>