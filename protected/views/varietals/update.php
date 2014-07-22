<?php
/* @var $this VarietalsController */
/* @var $model Varietals */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Varietals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Varietals', 'url'=>array('index')),
	array('label'=>'Create Varietals', 'url'=>array('create')),
	array('label'=>'View Varietals', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Varietals', 'url'=>array('admin')),
);
?>

<h1>Update Varietals <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>