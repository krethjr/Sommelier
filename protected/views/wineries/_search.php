<?php
/* @var $this WineriesController */
/* @var $model Wineries */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'winery_name'); ?>
		<?php echo $form->textField($model,'winery_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'default_appellation_id'); ?>
		<?php echo $form->textField($model,'default_appellation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proprietor_name'); ?>
		<?php echo $form->textField($model,'proprietor_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'winemaker_name'); ?>
		<?php echo $form->textField($model,'winemaker_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>70)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'create_dt'); ?>
		<?php echo $form->textField($model,'create_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_dt'); ?>
		<?php echo $form->textField($model,'update_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->