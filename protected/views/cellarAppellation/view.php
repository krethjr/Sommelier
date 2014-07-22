<?php
/* @var $this CellarAppellationController */
/* @var $model CellarAppellation */

$this->breadcrumbs=array(
	'Cellar Appellations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CellarAppellation', 'url'=>array('index')),
	array('label'=>'Create CellarAppellation', 'url'=>array('create')),
	array('label'=>'Update CellarAppellation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CellarAppellation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CellarAppellation', 'url'=>array('admin')),
);
?>

<h1>View CellarAppellation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cellar_id',
		'appellation_id',
	),
)); ?>
