<?php
/* @var $this ApiAccessController */
/* @var $data ApiAccess */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('api_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->api_id), array('view', 'id'=>$data->api_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('api_key_desc')); ?>:</b>
	<?php echo CHtml::encode($data->api_key_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('api_key_id')); ?>:</b>
	<?php echo CHtml::encode($data->api_key_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('api_key_secret')); ?>:</b>
	<?php echo CHtml::encode($data->api_key_secret); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_dt')); ?>:</b>
	<?php echo CHtml::encode($data->update_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsible_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->responsibleUser->username); ?>
	<br />


</div>