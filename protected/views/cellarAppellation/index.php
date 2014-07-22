<?php
/* @var $this CellarAppellationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cellar Appellations',
);

$this->menu=array(
	array('label'=>'Create CellarAppellation', 'url'=>array('create')),
	array('label'=>'Manage CellarAppellation', 'url'=>array('admin')),
);
?>

<h1>Cellar Appellations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
