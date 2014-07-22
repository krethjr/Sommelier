<?php
/* @var $this VarietalsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Varietals',
);

$this->menu=array(
	array('label'=>'Create Varietals', 'url'=>array('create')),
	array('label'=>'Manage Varietals', 'url'=>array('admin')),
);
?>

<h1>Varietals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
