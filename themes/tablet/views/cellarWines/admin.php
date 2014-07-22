<?php
/* @var $this CellarWinesController */
/* @var $model CellarWines */

$this->breadcrumbs=array(
	'Cellar Wines'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CellarWines', 'url'=>array('index')),
	array('label'=>'Create CellarWines', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cellar-wines-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cellar Wines</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cellar-wines-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cellar_id',
		'wine_id',
		'quantity',
		'rating',
		'location',
		/*
		'create_dt',
		'update_dt',
		'cost',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
