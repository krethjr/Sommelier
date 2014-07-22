<?php
/* @var $this WineriesController */
/* @var $model Wineries */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Wineries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Wineries', 'url'=>array('index')),
	array('label'=>'Create Winery', 'url'=>array('create')),
	array('label'=>'Update Winery', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Winery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Wineries', 'url'=>array('admin')),
);
?>

<h1>View Wineries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'winery_name',
		'default_appellation_id',
		'phone',
		'proprietor_name',
		'winemaker_name',
		'website:url',
		'description:ntext',
		'create_dt',
		'update_dt',
	),
)); ?>
