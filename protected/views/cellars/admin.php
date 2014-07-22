<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
	'Cellars'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cellars-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cellars</h1>

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

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cellars-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'name'=>'id',
                    'header'=>'Cellar ID',
                ),
		array(
                    'name'=>'owner_id',
                    'header'=>'Owner ID',
                ),
                array(
                    'name'=>'owner.username',
                    'header'=>'Owner Name',
                    'value'=>'$data->owner->username',
                ),
		'cellar_name',
		'create_dt',
		array(
                    'class'=>'CButtonColumn',
                    'header'=>'Operations',
                    'deleteConfirmation'=>'This will delete the Cellar and all the Wine Inventory records for this cellar, are you sure you want to delete it?',
		),
	),
    )); 
?>
