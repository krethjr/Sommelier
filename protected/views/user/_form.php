<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'focus' => 'input[type="text"]:first',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model, 'password'); ?>
    <?php echo $form->hiddenField($model, 'password_repeat'); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
	<?php echo $form->textField($model, 'username', array('autocomplete' => "off", 'size' => 60, 'maxlength' => 128)); ?>
	<?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
	<?php echo $form->textField($model, 'email', array('autocomplete' => "off", 'size' => 60, 'maxlength' => 128)); ?>
	<?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'first_name'); ?>
	<?php echo $form->textField($model, 'first_name', array('size' => 45, 'maxlength' => 45)); ?>
	<?php echo $form->error($model, 'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'last_name'); ?>
	<?php echo $form->textField($model, 'last_name', array('size' => 45, 'maxlength' => 45)); ?>
	<?php echo $form->error($model, 'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'country'); ?>
	<?php echo $form->textField($model, 'country', array('size' => 45, 'maxlength' => 45)); ?>
	<?php echo $form->error($model, 'country'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'state'); ?>
	<?php echo $form->textField($model, 'state', array('size' => 2, 'maxlength' => 2)); ?>
	<?php echo $form->error($model, 'state'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'favorite_region_id'); ?>
        <?php $region_list = CHtml::listData(Regions::model()->findAll(array('order' => 'region_name ASC')), 'id', 'region_name'); ?>
	<?php echo $form->dropDownList($model, 'favorite_region_id', $region_list, array('empty' => '(Select an Region)')); ?>
	<?php echo $form->error($model, 'favorite_region_id'); ?>
    </div>

    <div class="row">
	<?php echo $form->labelEx($model, 'user_role'); ?>
	<?php echo $form->dropDownList($model, 'user_role', Yii::app()->params['user_roles']); ?>
	<?php echo $form->error($model, 'user_role'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'account_status_cd'); ?>
	<?php echo $form->dropDownList($model, 'account_status_cd', Yii::app()->params['user_status']); ?>
	<?php echo $form->error($model, 'account_status_cd'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'profile'); ?>
	<?php echo $form->textArea($model, 'profile', array('rows' => 3, 'cols' => 50)); ?>
	<?php echo $form->error($model, 'profile'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->