<?php
/* @var $this WinesController */
/* @var $model Wines */
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
		<?php echo $form->label($model,'wine_name'); ?>
		<?php echo $form->textField($model,'wine_name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'winery_id'); ?>
		<?php echo $form->textField($model,'winery_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appellation_id'); ?>
		<?php echo $form->textField($model,'appellation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wine_year'); ?>
		<?php echo $form->textField($model,'wine_year',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wine_varietal_id'); ?>
		<?php echo $form->textField($model,'wine_varietal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'overall_rating'); ?>
		<?php echo $form->textField($model,'overall_rating'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->