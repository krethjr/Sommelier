<?php
/* @var $this ApiAccessController */
/* @var $model ApiAccess */

$this->breadcrumbs=array(
	'Api Access'=>array('index'),
	$model->api_id=>array('view','id'=>$model->api_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Api Access', 'url'=>array('index')),
	array('label'=>'Create Api Access', 'url'=>array('create')),
	array('label'=>'View Api Access', 'url'=>array('view', 'id'=>$model->api_id)),
);
?>

<h1>Update Api Access <?php echo $model->api_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>