<?php
/* @var $this CellarsController */
/* @var $model Cellars */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cellars-form',
        'focus'=>'input[type="text"]:first',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    )); 
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'cellar_name'); ?>
    <?php echo $form->textField($model,'cellar_name',array('size'=>45,'maxlength'=>45)); ?>
    <?php echo $form->error($model,'cellar_name'); ?>
</div>

<?php
    if ($this->getAction()->id == "update")
    {
        $dd_list = CHtml::listData(CellarLocation::model()->findAllByAttributes(array('cellar_id'=>$model->id)), 'cellar_loc_id', 'location');
        asort($dd_list);
        echo '<div class="row">';
        echo $form->labelEx($model,'default_cellar_loc_id');
        echo $form->dropDownList($model, 'default_cellar_loc_id', $dd_list, array('empty'=>'(Select a Location)')); 
	echo $form->error($model,'default_cellar_loc_id');
	echo '</div>';
    }
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->