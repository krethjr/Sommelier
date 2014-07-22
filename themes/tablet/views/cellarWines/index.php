<?php
/* @var $this CellarWinesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
        'Cellars'=>array('/cellars/index'),
        $cellarName=>array('/cellars/view', 'id'=>$cellar_id),
        'Wine Inventory',
);

$this->menu=array(
	array('label'=>'Add Wine to Cellar', 'url'=>array('/wines/picker', 'cellar_id'=>$cellar_id)),
	array('label'=>'Add a New Wine', 'url'=>array('/wines/create')),
);
?>

<h1><?php echo $cellarName; ?> - Wine Inventory</h1>
<?php
Yii::app()->session['from_cellar'] = '1';

$dataProvider->pagination = array('pageSize' => 40);

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'cellarWines-grid',
    'cssFile'=>Yii::app()->theme->baseUrl . "/css/styles.css",
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name'=>'wine_id', 
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'name'=>'winery',
            'value'=>'$data->wine->winery->winery_name',
        ),
        array(
            'name'=>'varietal',
            'value'=>'$data->wine->wineVarietal->name',
        ),
        array(
            'name'=>'vintage',
            'header'=>'Year',
            'value'=>'$data->wine->wine_year',
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'name'=>'quantity',
            'header'=>'Qty',
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'name'=>'rating', 
            'header'=>'Rtg',
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}{review}{add}{remove}',
            'header'=>'Actions',
            'htmlOptions' => array('style'=>'width:144px'),
            'buttons'=>array(
                'view' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/search_tab.png',
                    'options'=>array('title'=>'View the details for your collection of this wine'),
                ),
                'update' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/pencil_tab.png',
                    'options'=>array('title'=>'Update the details for your collection of this wine'),
                ),
                'delete' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/DeleteRed_tab.png',
                    'options'=>array('title'=>'Remove this wine entirely from your cellar'),
                ),
                'review' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/review_tab.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/review", array("wine_id"=>$data->wine_id))',
                    'options'=>array('title'=>'Review this wine'),
                ),
                'add' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/addWine_tab.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/addBottle", array("id"=>$data->id))',
                    'options'=>array('title'=>'Add another bottle of this wine to your cellar'),
                ),
                'remove' => array(
                    'imageUrl'=>Yii::app()->theme->baseUrl.'/images/drinkWine_tab.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/removeBottle", array("id"=>$data->id))',
                    'options'=>array('title'=>'Remove a bottle of this wine from your cellar'),
                ),
            ),
        )
)));
?>