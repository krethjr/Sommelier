<?php
/* @var $this VarietalsController */
/* @var $model Varietals */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Varietals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Varietals', 'url'=>array('index')),
	array('label'=>'Create Varietals', 'url'=>array('create')),
	array('label'=>'Update Varietals', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Varietals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Varietals', 'url'=>array('admin')),
);
?>

<h1>View Varietals #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'common_flg',
		'varietal_type',
		'description',
	),
)); ?>
