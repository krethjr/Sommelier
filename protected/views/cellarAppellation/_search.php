<?php
/* @var $this CellarAppellationController */
/* @var $model CellarAppellation */
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
		<?php echo $form->label($model,'cellar_id'); ?>
		<?php echo $form->textField($model,'cellar_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appellation_id'); ?>
		<?php echo $form->textField($model,'appellation_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->