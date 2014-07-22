<?php
/* @var $this SystemconfigController */
/* @var $model Systemconfig */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Systemconfigs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Systemconfig', 'url'=>array('index')),
);
?>

<h1>Create Systemconfig</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>