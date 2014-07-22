<?php
/* @var $this CellarWinesController */
/* @var $data CellarWines */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellar_id')); ?>:</b>
	<?php echo CHtml::encode($data->cellar_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wine_id')); ?>:</b>
	<?php echo CHtml::encode($data->wine_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<?php 
		$this->widget('CStarRating',array(
                        'model'=>$data,
                        'attribute'=>'rating',
                        'minRating'=>80,
                        'maxRating'=>100,
                        'starCount'=>10,
                        'readOnly'=>true,
        ));	?> <br>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_dt')); ?>:</b>
	<?php echo CHtml::encode($data->create_dt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('update_dt')); ?>:</b>
	<?php echo CHtml::encode($data->update_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost); ?>
	<br />

	*/ ?>

</div>