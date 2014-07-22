<?php
/* @var $this ApiAccessController */
/* @var $model ApiAccess */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'api_id'); ?>
		<?php echo $form->textField($model,'api_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'api_key_desc'); ?>
		<?php echo $form->textField($model,'api_key_desc',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'api_key_id'); ?>
		<?php echo $form->textField($model,'api_key_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'api_key_secret'); ?>
		<?php echo $form->textField($model,'api_key_secret',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_dt'); ?>
		<?php echo $form->textField($model,'update_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsible_user_id'); ?>
		<?php echo $form->textField($model,'responsible_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->