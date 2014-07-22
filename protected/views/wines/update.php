<?php
    /* @var $this WinesController */
    /* @var $model Wines */
    $cellar_id = Yii::app()->session['cellar_id'];
    if (!empty($cellar_id))
    {
        $this->breadcrumbs=array(
            'Cellar Wines'=>array('CellarWines/index','cellar_id'=>$cellar_id),
            $model->wine_name=>array('view','id'=>$model->id),
            'Update',
        );
    }
    else
    {
        $this->breadcrumbs=array(
            $model->wine_name=>array('view','id'=>$model->id),
            'Update',
        );
    }
    $this->menu=array(
            array('label'=>'List Wines', 'url'=>array('index')),
            array('label'=>'Create Wine', 'url'=>array('create')),
            array('label'=>'View Wine', 'url'=>array('view', 'id'=>$model->id)),
    );
?>

<h1>Update Wine</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>