<?php
/* @var $this AppellationsController */
/* @var $model Appellations */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Appellations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Appellations', 'url'=>array('index')),
	array('label'=>'Create Appellations', 'url'=>array('create')),
	array('label'=>'View Appellations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Appellations', 'url'=>array('admin')),
);
?>

<h1>Update Appellations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>