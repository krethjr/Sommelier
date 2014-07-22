<?php
/* @var $this VarietalsController */
/* @var $data Varietals */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('common_flg')); ?>:</b>
	<?php echo CHtml::encode($data->common_flg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('varietal_type')); ?>:</b>
	<?php echo CHtml::encode($data->varietal_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>