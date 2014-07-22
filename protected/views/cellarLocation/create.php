<?php
/* @var $this CellarLocationController */
/* @var $model CellarLocation */

$this->breadcrumbs=array(
	'Cellar Locations'=>array('index','cellar_id'=>$model->cellar_id),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cellar Locations', 'url'=>array('index', 'cellar_id'=>$model->cellar_id)),
);
?>

<h1>Create Cellar Location</h1>

<?php 
    $model->cellar_id = $cellar_id;
    $this->renderPartial('_form', array(
        'model'=>$model,
        'cellar_id'=>$cellar_id,
    )); 
?>