<?php
/* @var $this WineCommentsController */
/* @var $model WineComments */

$this->breadcrumbs=array(
	'Wine Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Wine Comments', 'url'=>array('index', 'wine_id'=>$wine_id)),
	array('label'=>'Create Wine Comments', 'url'=>array('create')),
	array('label'=>'View Wine Comments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Wine Comments', 'url'=>array('admin')),
);
?>

<h1>Update Wine Comments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>