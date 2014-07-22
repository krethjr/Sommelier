<?php
/* @var $this CellarWinesController */
/* @var $model CellarWines */

$this->breadcrumbs=array(
	'Cellar Wines'=>array('index', 'cellar_id'=>$model->cellar_id),
	'Update',
);

$this->menu=array(
    array('label'=>'List Wines in Cellar', 'url'=>array('index', 'cellar_id'=>$model->cellar_id)),
    array('label'=>'Update Wine Details', 'url'=>array('Wines/update', 'id'=>$model->wine_id)),
);

Yii::app()->session['cw_return'] = 1;

?>

<h1>Update Wine: <?php echo $model->wine->winery->winery_name . " - " . $model->wine->wine_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>