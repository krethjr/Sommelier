<?php
/* @var $this SystemconfigController */
/* @var $model Systemconfig */
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
		<?php echo $form->label($model,'systemName'); ?>
		<?php echo $form->textField($model,'systemName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'version'); ?>
		<?php echo $form->textField($model,'version',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wineOfTheDay_id'); ?>
		<?php echo $form->textField($model,'wineOfTheDay_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wineOfTheDay_dt'); ?>
		<?php echo $form->textField($model,'wineOfTheDay_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->