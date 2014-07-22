<?php
/* @var $this WineCommentsController */
/* @var $model WineComments */

$this->breadcrumbs=array(
	'Wine Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Wine Comments', 'url'=>array('index', 'wine_id'=>$wine_id)),
	array('label'=>'Manage Wine Comments', 'url'=>array('admin')),
);
?>

<h1>Create Wine Comments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>