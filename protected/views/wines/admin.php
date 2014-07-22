<?php
/* @var $this WinesController */
/* @var $model Wines */

$this->breadcrumbs = array(
    'Wines' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Wines', 'url' => array('index')),
    array('label' => 'Create Wine', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
    });
    $('.search-form form').submit(function(){
            $('#wines-grid').yiiGridView('update', {
                    data: $(this).serialize()
            });
            return false;
    });"
);
?>

<h1>Manage Wines</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'wines-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'wine_name',
        'description',
        'winery_id',
        'appellation_id',
        'wine_year',
        'wine_varietal_id',
        'overall_rating',
        'bottle_size',
        array('class' => 'CButtonColumn'),
    ),
));
?>
