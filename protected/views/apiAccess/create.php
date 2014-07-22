<?php
/* @var $this ApiAccessController */
/* @var $model ApiAccess */

$this->breadcrumbs=array(
	'Api Access'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Api Access', 'url'=>array('index')),
);
?>

<h1>Create Api Access</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>