<?php
/* @var $this AppellationsController */
/* @var $data Appellations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('appelation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<?php echo Chtml::link(CHtml::encode($data->appellation), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
	<?php echo CHtml::encode($data->region_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('common_flg')); ?>:</b>
	<?php echo CHtml::encode($data->common_flg); ?>
	<br />


</div>