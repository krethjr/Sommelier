<?php
/* @var $this WineriesController */
/* @var $model Wineries */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'wineries-form',
    'focus'=>'input[type="text"]:first',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	)
); 
?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
            <?php echo $form->labelEx($model,'winery_name'); ?>
            <?php echo $form->textField($model,'winery_name',array('size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'winery_name'); ?>
    </div>

    <div class="row">
        <?php 
            echo $form->labelEx($model,'default_appellation_id');
            $criteria = new CDbCriteria();
            $criteria->with = array('region');
            $criteria->compare('t.common_flg','Y');
            $criteria->order = 'region.region_name ASC, t.appellation ASC';
            $appellation_list = CHtml::listData(Appellations::model()->findAll($criteria), 'id', 'regionAppellation');
            echo $form->dropDownList($model, 'default_appellation_id', $appellation_list, array('empty'=>'(Select an Appellation)'));
            echo $form->error($model,'default_appellation_id'); 
        ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone',array('size'=>12,'maxlength'=>12)); ?>
            <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'proprietor_name'); ?>
            <?php echo $form->textField($model,'proprietor_name',array('size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'proprietor_name'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'winemaker_name'); ?>
            <?php echo $form->textField($model,'winemaker_name',array('size'=>45,'maxlength'=>45)); ?>
            <?php echo $form->error($model,'winemaker_name'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>70)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

    <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->