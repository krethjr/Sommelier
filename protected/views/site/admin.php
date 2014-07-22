<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
	'Admin',
);
?>

<h1>Administration Page</h1>

<?php
$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
	array('label'=>'Manage Regions', 'url'=>array('/regions/index')),
	array('label'=>'Manage Appellations', 'url'=>array('/appellations/index')),
	array('label'=>'Manage Varietals', 'url'=>array('/varietals/index')),
	array('label'=>'Manage Wineries', 'url'=>array('/wineries/index')),
	array('label'=>'Manage Wine Details', 'url'=>array('/wines/index')),
	array('label'=>'System Configuration', 'url'=>array('/systemconfig/index')),
    ),
));
?>