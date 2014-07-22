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

<div id="flashes">
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
</div>

<?php
Yii::app()->session['from_cellar'] = '0';

Yii::import('zii.widgets.grid.CGridView');

$this->widget('CGridView', array(
    'id'=>'wine-list',
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
        'wine_name',
        array(
            'name'=>'appellation', 
            'value'=>'$data->appellation->appellation',
        ),
        'bottle_size',
        'overall_rating',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'header'=>'Actions',
            'htmlOptions' => array('style'=>'width:72px'),
            'buttons'=>array(
                'view' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/search.png',
                    'options'=>array('title'=>'View the global details of this wine'),
                ),
                'update' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/pencil.png',
                    'options'=>array('title'=>'Update the details of this globally'),
                ),
                'delete' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/DeleteRed.png',
                    'options'=>array('title'=>'Deleting the wine will remove it from all cellars'),
                ),
            ),
        )
    )));
?>