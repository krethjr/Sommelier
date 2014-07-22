<?php
/* @var $this ApiAccessController */
/* @var $model ApiAccess */

$this->breadcrumbs = array(
    'Api Access' => array('index'),
    $model->api_id,
);

$this->menu = array(
    array('label' => 'List Api Access', 'url' => array('index')),
    array('label' => 'Create Api Access', 'url' => array('create')),
    array('label' => 'Update Api Access', 'url' => array('update', 'id' => $model->api_id)),
    array('label' => 'Delete Api Access', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->api_id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Api Access #<?php echo $model->api_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'api_id',
        'api_key_desc',
        'api_key_id',
        'api_key_secret',
        'update_dt',
        array(
            'name' => 'Responsible User',
            'value' => $model->responsibleUser->username
        ),
    ),
));
?>
