<?php
/* @var $this CellarsController */
/* @var $data Cellars */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellar_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cellar_name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode('Celler Owner'); ?>:</b>
	<?php echo CHtml::encode($data->owner->first_name . " " . $data->owner->last_name); ?>
	<br />
        
	<b><?php echo CHtml::encode('Default Location'); ?>:</b>
	<?php 
            $temp_cellar_loc = CellarLocation::model()->findByPk($data->default_cellar_loc_id);
            echo CHtml::encode($temp_cellar_loc->location); 
        ?>
	<br />
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_dt')); ?>:</b>
	<?php echo CHtml::encode($data->create_dt); ?>
	<br />
</div>