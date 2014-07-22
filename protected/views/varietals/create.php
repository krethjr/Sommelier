<?php
/* @var $this VarietalsController */
/* @var $model Varietals */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Varietals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Varietals', 'url'=>array('index')),
	array('label'=>'Manage Varietals', 'url'=>array('admin')),
);
?>

<h1>Create Varietals</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>