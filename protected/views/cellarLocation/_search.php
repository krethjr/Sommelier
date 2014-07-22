<?php
/* @var $this CellarLocationController */
/* @var $model CellarLocation */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cellar_loc_id'); ?>
		<?php echo $form->textField($model,'cellar_loc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cellar_id'); ?>
		<?php echo $form->textField($model,'cellar_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_desc'); ?>
		<?php echo $form->textField($model,'location_desc',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->