<?php
/* @var $this WineCommentsController */
/* @var $data WineComments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->user->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode('Wine'); ?>:</b>
	<?php echo CHtml::encode($data->wine->winery->winery_name) . '  ' . 
                        CHtml::encode($data->wine->wine_year) . '  ' .
                        CHtml::encode($data->wine->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_dt')); ?>:</b>
	<?php echo CHtml::encode($data->comment_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>