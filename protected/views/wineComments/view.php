<?php
/* @var $this WineCommentsController */
/* @var $model WineComments */

$this->breadcrumbs=array(
	'Wine Comments'=>array('wineComments/index','wine_id'=>$wine_id),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Wine Comments', 'url'=>array('index', 'wine_id'=>$wine_id)),
	array('label'=>'Create Wine Comments', 'url'=>array('create', 'wine_id'=>$wine_id)),
	array('label'=>'Update Wine Comments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Wine Comments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Wine Comments', 'url'=>array('admin')),
);
?>

<h1>View Wine Comments</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
	'attributes'=>array(
            'id',
            array(
                'name'=>'Reviewer',
                'value'=>$model->user->first_name . " " . $model->user->last_name
            ),
            array(
                'name'=>'Wine',
                'value'=>$model->wine->winery->winery_name . '  ' . 
                        $model->wine->wine_year . '  ' .
                        $model->wine->description
            ),
            'comment_dt',
            'comment',
	),
)); 
?>
