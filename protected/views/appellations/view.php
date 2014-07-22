<?php
/* @var $this AppellationsController */
/* @var $model Appellations */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
		'Appellations'=>array('index'),
		$model->id,
);

$this->menu=array(
	array('label'=>'List Appellations', 'url'=>array('index')),
	array('label'=>'Create Appellations', 'url'=>array('create')),
	array('label'=>'Update Appellations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Appellations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Appellations', 'url'=>array('admin')),
);
?>

<h1>View Appellations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'country',
		'region_id',
		'appellation',
		'common_flg',
	),
)); ?>
