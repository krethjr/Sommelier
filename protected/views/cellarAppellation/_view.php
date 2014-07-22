<?php
/* @var $this CellarAppellationController */
/* @var $data CellarAppellation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellar_id')); ?>:</b>
	<?php echo CHtml::encode($data->cellar_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appellation_id')); ?>:</b>
	<?php echo CHtml::encode($data->appellation_id); ?>
	<br />


</div>