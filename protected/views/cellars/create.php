<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
	'Cellars'=>array('index'),
	'Create',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Manage Cellars', 'url'=>array('admin')),
    );
}
else
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
    );
}

?>

<h1>Create Cellars</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>