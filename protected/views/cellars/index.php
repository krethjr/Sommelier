<?php
/* @var $this CellarsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cellars',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'Create New Cellar', 'url'=>array('create')),
	array('label'=>'Manage Cellars', 'url'=>array('admin')),
    );
}
else
{
    $this->menu=array(
	array('label'=>'Create New Cellar', 'url'=>array('create')),
    );
}

?>

<h1>Cellars</h1>

<?php 
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view'
    )); 
?>
