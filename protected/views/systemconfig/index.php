<?php
/* @var $this SystemconfigController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Systemconfigs',
);

$this->menu=array(
	array('label'=>'Create Systemconfig', 'url'=>array('create')),
);
?>

<h1>Systemconfigs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
