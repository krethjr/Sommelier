<?php
/* @var $this WineriesController */
/* @var $model Wineries */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Wineries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Wineries', 'url'=>array('index')),
	array('label'=>'Manage Wineries', 'url'=>array('admin')),
);
?>

<h1>Add a New Winery</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>