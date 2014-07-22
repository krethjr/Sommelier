<?php
/* @var $this WineriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Admin'=>array('site/admin'),
	'Wineries',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'Create Winery', 'url'=>array('create')),
	array('label'=>'Manage Wineries', 'url'=>array('admin')),
    );
}
else 
{
    $this->menu=array(
	array('label'=>'Create Wineries', 'url'=>array('create')),
   );
}
?>

<h1>Wineries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
