<?php
/* @var $this SystemconfigController */
/* @var $data Systemconfig */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('systemName')); ?>:</b>
	<?php echo CHtml::encode($data->systemName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('version')); ?>:</b>
	<?php echo CHtml::encode($data->version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wineOfTheDay_id')); ?>:</b>
	<?php echo CHtml::encode($data->wineOfTheDay_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wineOfTheDay_dt')); ?>:</b>
	<?php echo CHtml::encode($data->wineOfTheDay_dt); ?>
	<br />


</div>