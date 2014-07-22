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

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'cellarWines-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'wine_id',
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
            'value'=>'$data->wine->wine_year',
        ),
        array(
            'name'=>'wine_name',
            'value'=>'$data->wine->wine_name',
        ),
        array(
            'name'=>'quantity', 
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'name'=>'rating', 
            'htmlOptions'=>array('style'=>'text-align: center')
        ),
        array(
            'name'=>'location',
            'value'=>'$data->cellarLoc->location',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}{review}{add}{remove}',
            'header'=>'Actions',
            'htmlOptions' => array('style'=>'width:143px'),
            'buttons'=>array(
                'view' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/search.png',
                    'options'=>array('title'=>'View the details for your collection of this wine'),
                ),
                'update' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/pencil.png',
                    'options'=>array('title'=>'Update the details for your collection of this wine'),
                ),
                'delete' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/DeleteRed.png',
                    'options'=>array('title'=>'Remove this wine entirely from your cellar'),
                ),
                'review' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/review.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/review", array("wine_id"=>$data->wine_id))',
                    'options'=>array('title'=>'Review this wine'),
                ),
                'add' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/addWine.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/addBottle", array("id"=>$data->id))',
                    'options'=>array('title'=>'Add another bottle of this wine to your cellar'),
                ),
                'remove' => array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/drinkWine.png',
                    'url'=>'Yii::app()->createUrl("cellarWines/removeBottle", array("id"=>$data->id))',
                    'options'=>array('title'=>'Remove a bottle of this wine from your cellar'),
                ),
            ),
        )
)));
?>