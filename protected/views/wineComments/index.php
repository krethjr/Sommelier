<?php
/* @var $this WineCommentsController */
/* @var $dataProvider CActiveDataProvider */

$cellar_id = Yii::app()->session['cellar_id'];

$this->breadcrumbs=array(
        'Wine Inventory'=>array('/cellarWines/index', 'cellar_id'=>$cellar_id),
	'Wine Comments',
);

$this->menu=array(
	array('label'=>'Create Wine Comments', 'url'=>array('create', 'wine_id'=>$wine_id)),
	array('label'=>'Manage Wine Comments', 'url'=>array('admin')),
);
?>

<h1>Wine Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
