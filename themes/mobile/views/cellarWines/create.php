<?php
/* @var $this CellarWinesController */
/* @var $model CellarWines */

$this->breadcrumbs = array(
    'Cellar Wines' => array('index'),
    'Add a Wine',
);

$this->menu = array(
    array('label' => 'List Cellar Wines', 'url' => array('index')),
    array('label' => 'Manage Cellar Wines', 'url' => array('admin')),
);
?>

<h1>Add a Wine to the Cellar:  <?php echo $model->cellar->cellar_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>