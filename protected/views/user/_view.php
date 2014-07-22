<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('username')) . ': </b>';
	    echo CHtml::encode($data->username) . '      '; 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('email')) . ': </b>';
	    echo CHtml::encode($data->email);
	?>
	<br />

	<b><?php echo CHtml::encode('Name'); ?>:</b>
	<?php echo CHtml::encode($data->first_name . ' ' . $data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profile')); ?>:</b>
	<?php echo CHtml::encode($data->profile); ?>
	<br />

	<?php 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('country')) . ': </b>';
	    echo CHtml::encode($data->country) . '      '; 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('state')) . ': </b>';
	    echo CHtml::encode($data->state);
	?>
	<br />

	<?php 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('user_role')) . ': </b>';
	    echo CHtml::encode($data->user_role) . '      '; 
	    echo '<b>' . CHtml::encode($data->getAttributeLabel('account_status_cd')) . ': </b>';
	    echo CHtml::encode($data->account_status_cd);
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_region_id')); ?>:</b>
	<?php echo CHtml::encode($data->favoriteRegion->region_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_dt')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_dt')); ?>:</b>
	<?php echo CHtml::encode($data->create_dt); ?>
	<br />

</div>