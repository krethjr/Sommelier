<?php
/* @var $this AppellationsController */
/* @var $model Appellations */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Appellations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Appellations', 'url'=>array('index')),
	array('label'=>'Manage Appellations', 'url'=>array('admin')),
);
?>

<h1>Create Appellations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>