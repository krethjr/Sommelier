<?php
/* @var $this AppellationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Appellations',
);

$this->menu=array(
	array('label'=>'Create Appellations', 'url'=>array('create')),
	array('label'=>'Manage Appellations', 'url'=>array('admin')),
);
?>

<h1>Appellations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
