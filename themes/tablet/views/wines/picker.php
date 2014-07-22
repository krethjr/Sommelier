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
        array('label' => 'Manage Wines', 'url' => array('admin')),
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

$dataProvider->pagination = array('pageSize' => 40);

class AddWineGridView extends CGridView
{
    public $cellar_id;
    
    public function init()
    {
        parent::init();
    }
}

$this->widget('AddWineGridView', array(
    'id' => 'wines-grid',
    'cssFile'=>Yii::app()->theme->baseUrl . "/css/styles.css",
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
        'bottle_size',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{add}',
            'header' => 'Actions',
            'htmlOptions' => array('style' => 'width:98px'),
            'buttons' => array(
                'view' => array(
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/search_tab.png',
                    'options' => array('title' => 'View the global details of this wine'),
                ),
                'add' => array(
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/addWine_tab.png',
                    'url' => 'Yii::app()->createUrl("cellarWines/addWine", array("wine_id"=>$data->id))',
                    'options' => array('title' => 'Add this wine to your cellar'),
                ),
            ),
        )
)));
?>