<?php
/* @var $this CellarAppellationController */
/* @var $model CellarAppellation */

$this->breadcrumbs=array(
	'Cellar Appellations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CellarAppellation', 'url'=>array('index')),
	array('label'=>'Create CellarAppellation', 'url'=>array('create')),
	array('label'=>'View CellarAppellation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CellarAppellation', 'url'=>array('admin')),
);
?>

<h1>Update CellarAppellation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>