<?php
/* @var $this WinesController */
/* @var $model Wines */
if (Yii::app()->session['from_cellar'] == '1')
{
    $this->breadcrumbs=array(
        'Cellars'=>array('/cellars/index'),
        $cellarName=>array('/cellars/view', 'id'=>Yii::app()->session['cellar_id']),
        'Cellar Inventory'=>array('/cellarWines/index', 'cellar_id'=>Yii::app()->session['cellar_id']),
        'Create',
    );
}
else
{
    $this->breadcrumbs=array(
            'Admin'=>array('/site/admin'),
            'Wines'=>array('/wines/index'),
            'Create',
    );
}

$this->menu=array(
//	array('label'=>'List Wines', 'url'=>array('index', 'cellar_id'=>$cellar_id)),
	array('label'=>'Add/View a Winery', 'url'=>array('wineries/index')),
);
?>

<h1>Add a New Wine</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>