<?php
/* @var $this WinesController */
/* @var $data Wines */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('wine_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->wine_name), array('view', 'id'=>$data->id)); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('wine_year')); ?>:</b>
	<?php echo CHtml::encode($data->wine_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->winery->getAttributeLabel('winery_name')); ?>:</b>
	<?php echo CHtml::encode($data->winery->winery_name); ?>
	<b><?php echo CHtml::encode($data->wineVarietal->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->wineVarietal->name); ?>
	<b><?php echo CHtml::encode($data->appellation->getAttributeLabel('appellation')); ?>:</b>
	<?php echo CHtml::encode($data->appellation->appellation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bottle_size')); ?>:</b>
	<?php echo CHtml::encode($data->bottle_size); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('overall_rating')); ?>:</b>
	<?php echo CHtml::encode($data->overall_rating); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('create_dt')); ?>:</b>
	<?php echo CHtml::encode($data->create_dt); ?>
	<br />
        <?php
            echo "<div class=\"row\">";
            echo CHtml::image(Yii::app()->request->baseUrl.'/images/labels/'.$model->image_file,"image",array("width"=>200));
            echo "</div>";
        ?>

</div>