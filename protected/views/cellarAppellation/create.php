<?php
/* @var $this CellarAppellationController */
/* @var $model CellarAppellation */

$this->breadcrumbs=array(
	'Cellar Appellations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CellarAppellation', 'url'=>array('index')),
	array('label'=>'Manage CellarAppellation', 'url'=>array('admin')),
);
?>

<h1>Create CellarAppellation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>