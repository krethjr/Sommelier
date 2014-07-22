<?php
/* @var $this CellarLocationController */
/* @var $model CellarLocation */

$this->breadcrumbs=array(
        'Cellars'=>array('Cellars/index'),
        $model->cellar->cellar_name=>array('Cellars/view','id'=>$model->cellar_id),
	'Cellar Locations'=>array('index','cellar_id'=>$model->cellar_id),
	$model->location,
);

$this->menu=array(
	array('label'=>'List Cellar Locations', 'url'=>array('index', 'cellar_id'=>$model->cellar_id)),
	array('label'=>'Create Location', 'url'=>array('create', 'cellar_id'=>$model->cellar_id)),
	array('label'=>'Update Cellar Location', 'url'=>array('update', 'id'=>$model->cellar_loc_id)),
	array('label'=>'Delete Cellar Location', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cellar_loc_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Cellar Location "<?php echo $model->location; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cellar.cellar_name',
		'location',
		'location_desc',
	),
)); ?>
