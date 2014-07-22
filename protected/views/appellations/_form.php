<?php
/* @var $this AppellationsController */
/* @var $model Appellations */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'appellations-form',
        'focus'=>'input[type="text"]:first',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->textField($model,'country',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>
    <div class="row">
        <?php 
            echo $form->labelEx($model,'region_id');
            $region_list = CHtml::listData(Regions::model()->findAll(array('order'=>'country ASC, region_name ASC')), 'id', 'countryRegion');
            echo $form->dropDownList($model, 'id', $region_list, array('empty'=>'(Select an Region)'));
            echo $form->error($model,'region_id'); 
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'appellation'); ?>
        <?php echo $form->textField($model,'appellation',array('size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'appellation'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'common_flg'); ?>
        <?php echo $form->textField($model,'common_flg',array('size'=>1,'maxlength'=>1)); ?>
        <?php echo $form->error($model,'common_flg'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->