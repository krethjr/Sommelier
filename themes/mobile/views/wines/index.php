<?php
    /* @var $this WinesController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs=array(
            'Admin'=>array('/site/admin'),
            'All Wine Details',
    );

    $this->menu=array(
	array('label'=>'Add a New Wine', 'url'=>array('create')),
    );
?>

<h1>Complete Wine Listing</h1>
Use the Add/Update/Delete action-buttons
<?php
Yii::app()->session['from_cellar'] = '0';

Yii::import('zii.widgets.grid.CGridView');

$dataProvider->pagination = array('pageSize' => 20);

$this->widget('CGridView', array(
    'id'=>'wine-list',
    'cssFile'=>Yii::app()->theme->baseUrl . "/css/styles.css",
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        array(
            'name'=>'winery',
            'value'=>'$data->winery->winery_name',
        ),
        array(
            'name'=>'varietal', 
            'value'=>'$data->wineVarietal->name',
        ),
        'wine_year', 
        array(
            'name'=>'wine_name', 
            'value'=>'$data->wine_name',
            'visible'=>FALSE,
        ),
        'overall_rating',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'header'=>'Actions',
            'htmlOptions' => array('style'=>'width:145px'),
            'buttons'=>array(
                'view' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/search_tab.png',
                    'options'=>array('title'=>'View the global details of this wine'),
                ),
                'update' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/pencil_tab.png',
                    'options'=>array('title'=>'Update the details of this globally'),
                ),
                'delete' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/DeleteRed_tab.png',
                    'options'=>array('title'=>'Deleting the wine will remove it from all cellars'),
                ),
            ),
        )
    )));
?>