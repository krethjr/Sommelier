<?php
/* @var $this SystemconfigController */
/* @var $model Systemconfig */

$this->breadcrumbs = array(
    'Admin' => array('site/admin'),
    'Systemconfigs' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Systemconfig', 'url' => array('index')),
    array('label' => 'Create Systemconfig', 'url' => array('create')),
    array('label' => 'Update Systemconfig', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Systemconfig', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Systemconfig #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'systemName',
        'version',
        'wineOfTheDay_id',
        'wineOfTheDay_dt',
    ),
));
?>
