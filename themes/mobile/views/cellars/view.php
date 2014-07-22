<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
	'Cellars'=>array('index'),
	$model->cellar_name,
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
	array('label'=>'Update Cellar', 'url'=>array('update', 'id'=>$model->id)),
	array(
            'label'=>'Delete Cellar', 
            'url'=>'#', 
            'linkOptions'=>array(
                'submit'=>array(
                    'delete',
                    'id'=>$model->id
                ),
                'confirm'=>'This will delete the Cellar and all the Wine Inventory records for this cellar, are you sure you want to delete it?',
            )
        ),
	array('label'=>'Cellar Locations', 'url'=>array('cellarLocation/index', 'cellar_id'=>$model->id)),
        array('label'=>'Cellar Summary', 'url'=>array('summary', 'cellar_id'=>$model->id)),
        array('label'=>'Wine Inventory', 'url'=>array('cellarWines/index', 'cellar_id'=>$model->id)),
	array('label'=>'Manage Cellars', 'url'=>array('admin')),
    );
}
else
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
        array('label'=>'Wine Inventory', 'url'=>array('cellarWines/index', 'cellar_id'=>$model->id))
    );
}
?>

<h1>Wine Cellar View (tablet)</h1>

<?php 
    Yii::app()->session['cellar_id'] = $model->id;
    $temp_cellar_loc = CellarLocation::model()->findByPk($model->default_cellar_loc_id);

    $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            array(
                'name'=>'Cellar Owner',
                'value'=>$model->owner->first_name . " " . $model->owner->last_name
            ),
            'cellar_name',
            array(
                'name'=>'default_cellar_loc_id',
                'value'=>$temp_cellar_loc->location,
            ),
            'create_dt',
        ),
    ));
?>
