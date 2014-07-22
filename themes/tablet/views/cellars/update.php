<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
	'Cellars' => array('index'),
	$model->cellar_name => array('view','id'=>$model->id),
	'Update',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
	array('label'=>'View Cellars', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cellars', 'url'=>array('admin')),
    );
}
else
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
	array('label'=>'View Cellars', 'url'=>array('view', 'id'=>$model->id)),
    );
}
?>

<h1>Update Cellars</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>