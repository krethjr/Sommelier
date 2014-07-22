<?php
/* @var $this CellarWinesController */
/* @var $model CellarWines */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cellar-wines-form',
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
            <?php echo $form->labelEx($model->wine->winery,'winery_name'); ?>
            <?php echo $model->wine->winery->winery_name; ?>
            <br><br>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model->wine->appellation,'appelation'); ?>
            <?php echo $model->wine->appellation->appellation; ?>
            <br><br>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model->wine,'wine_name'); ?>
            <?php echo $model->wine->wine_name; ?>
            <br><br>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model->wine->wineVarietal,'name'); ?>
            <?php echo $model->wine->wineVarietal->name; ?>
            <br><br>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'quantity'); ?>
            <?php echo $form->textField($model,'quantity'); ?>
            <?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cellar_loc_id'); ?>
                <?php 
                    $wineries_list = CHtml::listData(
                        CellarLocation::model()->findAllByAttributes(
                            array('cellar_id'=>$model->cellar_id)),
                            'cellar_loc_id', 'location');
                    asort($wineries_list);
                    echo $form->dropDownList($model, 'cellar_loc_id', $wineries_list, array('empty'=>'(Select a Location)')); 
                ?>
		<?php echo $form->error($model,'cellar_loc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->