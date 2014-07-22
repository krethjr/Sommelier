<?php
/* @var $this WinesController */
/* @var $model Wines */
/* @var $form CActiveForm */
?>

<div class="form">

<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wines-form',
        'focus'=>'input[type="text"]:first',
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
    )); 
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php 
    echo $form->errorSummary($model);
?>

    <div class="row">
	<?php echo $form->labelEx($model,'wine_name'); ?>
	<?php echo $form->textField($model,'wine_name',array('size'=>45,'maxlength'=>45)); ?>
	<?php echo $form->error($model,'wine_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'winery_id'); ?>
        <?php $wineries_list = CHtml::listData(Wineries::model()->findAll(array('order'=>'winery_name')), 'id', 'winery_name'); ?>
        <?php echo $form->dropDownList($model, 'winery_id', $wineries_list, array('empty'=>'(Select a Winery)')); ?>
        <?php echo $form->error($model,'winery_id'); ?>
    </div>

    <div class="row">
        <?php 
            echo $form->labelEx($model,'appellation_id');
            $criteria = new CDbCriteria();
            $criteria->with = array('region');
            $criteria->compare('t.common_flg','Y');
            $criteria->order = 'region.region_name ASC, t.appellation ASC';
            $appellation_list = CHtml::listData(Appellations::model()->findAll($criteria), 'id', 'regionAppellation');
            echo $form->dropDownList($model, 'appellation_id', $appellation_list, array('empty'=>'(Select an Appellation)'));
            echo $form->error($model,'appellation_id'); 
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'wine_year'); ?>
        <?php echo $form->textField($model,'wine_year',array('size'=>4,'maxlength'=>4)); ?>
        <?php echo $form->error($model,'wine_year'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'wine_varietal_id'); ?>
        <?php $varietal_list = CHtml::listData(Varietals::model()->findAll(array('order'=>'common_flg DESC, name ASC')), 'id', 'name'); ?>
        <?php echo $form->dropDownList($model, 'wine_varietal_id', $varietal_list, array('empty'=>'(Select an Varietal)')); ?>
        <?php echo $form->error($model,'wine_varietal_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'bottle_size'); ?>
        <?php echo $form->dropDownList($model, 'bottle_size', Yii::app()->params['bottle_sizes']); ?>
        <?php echo $form->error($model,'bottle_size'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'overall_rating'); ?>
		<?php 
			$this->widget('CStarRating',array(
                          'model'=>$model,
                          'attribute'=>'overall_rating',
                          'minRating'=>80,
                          'maxRating'=>100,
                          'starCount'=>20,
                          'readOnly'=>false,
            ));	?> <br>
        <?php echo $form->error($model,'overall_rating'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'image_file'); ?>
        <?php echo $model->image_file; ?>
    </div>

    <div class="row">
        <?php 
            echo $form->labelEx($model,'image');
            echo $form->fileField($model, 'image');
            echo $form->error($model,'image'); 

            if($model->isNewRecord != '1')
            { 
                echo "<div class=\"row\">";
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/labels/' . $model->image_file, "image", array("width" => 200));
                echo "</div>";
            }
        ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div> <!-- form -->