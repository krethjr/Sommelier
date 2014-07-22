<?php
/* @var $this WineriesController */
/* @var $model Wineries */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Wineries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Wineries', 'url'=>array('index')),
	array('label'=>'Create Winery', 'url'=>array('create')),
	array('label'=>'View Winery', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Wineries', 'url'=>array('admin')),
);
?>

<h1>Update Wineries <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>