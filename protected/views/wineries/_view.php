<?php
/* @var $this WineriesController */
/* @var $data Wineries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('winery_name')); ?>:</b>
	<?php echo CHtml::encode($data->winery_name) . "    "; ?>
        </br>
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('proprietor_name')); ?>:</b>
	<?php echo CHtml::encode($data->proprietor_name); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('winemaker_name')); ?>:</b>
	<?php echo CHtml::encode($data->winemaker_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_appellation_id')); ?>:</b>
	<?php echo CHtml::encode($data->defaultAppellation->appellation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
    <?php echo CHtml::encode($data->website); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_dt')); ?>:</b>
	<?php echo CHtml::encode($data->create_dt); ?>
	<br />

</div>