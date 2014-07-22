<?php
/* @var $this ApiAccessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Api Access',
);

$this->menu=array(
	array('label'=>'Create Api Access', 'url'=>array('create')),
);
?>

<h1>Api Access</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
