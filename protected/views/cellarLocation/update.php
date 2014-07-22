<?php
/* @var $this CellarLocationController */
/* @var $model CellarLocation */

$this->breadcrumbs=array(
	'Cellar Locations'=>array('index','cellar_id'=>$model->cellar_id),
	$model->location=>array('view','id'=>$model->cellar_loc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cellar Locations', 'url'=>array('index', 'cellar_id'=>$model->cellar_id)),
	array('label'=>'Create Location', 'url'=>array('create', 'cellar_id'=>$model->cellar_id)),
	array('label'=>'View Cellar Location', 'url'=>array('view', 'id'=>$model->cellar_loc_id)),
);
?>

<h1>Update Cellar Location</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>