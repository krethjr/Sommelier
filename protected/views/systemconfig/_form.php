<?php
/* @var $this SystemconfigController */
/* @var $model Systemconfig */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'systemconfig-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'systemName'); ?>
		<?php echo $form->textField($model,'systemName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'systemName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version'); ?>
		<?php echo $form->textField($model,'version',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wineOfTheDay_id'); ?>
		<?php echo $form->textField($model,'wineOfTheDay_id'); ?>
		<?php echo $form->error($model,'wineOfTheDay_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wineOfTheDay_dt'); ?>
		<?php echo $form->textField($model,'wineOfTheDay_dt'); ?>
		<?php echo $form->error($model,'wineOfTheDay_dt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->