<?php
/* @var $this WinesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Cellars' => array('/cellars/index'),
    $cellarName => array('/cellars/view', 'id' => $cellar_id),
    'Add Wine to Cellar',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu = array(
        array('label' => 'Add a New Wine', 'url' => array('create')),
//        array('label' => 'Manage Wines', 'url' => array('admin')),
    );
}
else
{
    $this->menu = array(
        array('label' => 'Add a New Wine', 'url' => array('create')),
    );
}
?>

<h1>Wine Listing</h1>
Use the Add action-button (wine bottle) to add the selected wine to your cellar
<?php
Yii::app()->session['from_cellar'] = '1';

Yii::import('zii.widgets.grid.CGridView');

class AddWineGridView extends CGridView
{
    public $cellar_id;
}

$this->widget('AddWineGridView', array(
    'id' => 'wines-grid',
    'cellar_id' => $cellar_id,
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id',
        array(
            'name' => 'winery',
            'value' => '$data->winery->winery_name',
        ),
        array(
            'name' => 'varietal',
            'value' => '$data->wineVarietal->name',
        ),
        'wine_year',
        'wine_name',
        array(
            'name' => 'appellation',
            'value' => '$data->appellation->appellation',
        ),
        'bottle_size',
        'overall_rating',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{add}',
            'header' => 'Actions',
            'htmlOptions' => array('style' => 'width:98px'),
            'buttons' => array(
                'view' => array(
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/search.png',
                    'options' => array('title' => 'View the global details of this wine'),
                ),
                'update' => array(
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/pencil.png',
                    'options' => array('title' => 'Update the details of this globally'),
                ),
                'delete' => array(
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/DeleteRed.png',
                    'options' => array('title' => 'Deleting the wine will remove it from all cellars'),
                ),
                'add' => array
                    (
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/addWine.png',
                    'url' => 'Yii::app()->createUrl("cellarWines/addWine", array("wine_id"=>$data->id))',
                    'options' => array('title' => 'Add this wine to your cellar'),
                ),
            ),
        )
)));
?>