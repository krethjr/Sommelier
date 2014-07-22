<?php
/* @var $this SystemconfigController */
/* @var $model Systemconfig */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Systemconfigs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Systemconfig', 'url'=>array('index')),
	array('label'=>'Create Systemconfig', 'url'=>array('create')),
	array('label'=>'View Systemconfig', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Systemconfig <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>