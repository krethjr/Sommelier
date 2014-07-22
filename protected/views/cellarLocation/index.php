<?php
/* @var $this CellarLocationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Cellars'=>array('Cellars/index'),
        $cellarName=>array('Cellars/view','id'=>$cellar_id),
	'Cellar Locations',
);

$this->menu=array(
	array('label'=>'Create Location', 'url'=>array('create', 'cellar_id'=>$cellar_id)),
);
?>

<h1>Cellar Locations in <?php echo $cellarName; ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
