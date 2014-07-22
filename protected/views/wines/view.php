<?php
/* @var $this WinesController */
/* @var $model Wines */

$this->breadcrumbs = array(
	'Wines' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'List Wines', 'url' => array('index')),
	array('label' => 'Create Wine', 'url' => array('create')),
	array('label' => 'Update Wine', 'url' => array('update', 'id' => $model->id)),
	array('label' => 'Delete Wine', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Wines', 'url'=>array('admin')),
);
?>

<h1>Wine Details</h1>

<?php
	ob_start();
	$this->widget('CStarRating', array(
		'name' => 'rating',
		'value' => $model->overall_rating,
		'minRating' => 80,
		'maxRating' => 100,
		'starCount' => 20,
		'readOnly' => TRUE,
		)
	);
	echo '<b> (' . CHtml::encode($model->overall_rating) . ') </b>';
	$formattedRating = ob_get_contents();
	ob_end_clean();


	$this->widget('zii.widgets.CDetailView', array(
		'data' => $model,
		'attributes' => array(
			'wine_name',
			'description',
			array(
				'name' => 'Winery',
				'value' => $model->winery->winery_name
			),
			array(
				'name' => 'Appellation',
				'value' => $model->appellation->appellation
			),
			'wine_year',
			array(
				'name' => 'Varietal',
				'value' => $model->wineVarietal->name
			),
			array(
				'name'=>$model->getAttributeLabel('overall_rating'),
				'type'=>'raw',
				'value'=>$formattedRating
			),
			'bottle_size',
			'create_dt',
		),
	));
    // display the image from the wine record
    echo "<br>";
    echo CHtml::image(Yii::app()->baseUrl.'/images/labels/'.$model->image_file,
        "",
        array("width"=>"194px" ,"height"=>"258px"));
?>
