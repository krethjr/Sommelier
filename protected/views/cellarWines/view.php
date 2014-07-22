<?php
    /* @var $this CellarWinesController */
    /* @var $model CellarWines */

    $this->breadcrumbs=array(
        'Cellars'=>array('/cellars/index'),
        $model->cellar->cellar_name=>array('/cellarWines/index', 'cellar_id'=>$model->cellar_id),
        $model->id,
    );

    $this->menu=array(
        array('label'=>'List Wines in Cellar', 'url'=>array('index', 'cellar_id'=>$model->cellar_id)),
        array('label'=>'View Comments', 'url'=>array('/wineComments/index', 'wine_id'=>$model->wine_id)),
        array('label'=>'Update Wine Details', 'url'=>array('wines/update', 'id'=>$model->wine_id)),
        array('label'=>'Add a New Wine', 'url'=>array('/wines/create')),
        array('label'=>'Delete Wine from Cellar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete', 'id'=>$model->id, 'cellar_id'=>$model->cellar_id),'confirm'=>'Are you sure you want to delete this item?')),
    );

    Yii::app()->session['cw_return'] = 1;
?>

<h1>Wine Details</h1>

<?php 
	ob_start();
	$this->widget('CStarRating', array(
		'name' => 'rating',
		'value' => $model->rating,
		'minRating' => 80,
		'maxRating' => 100,
		'starCount' => 20,
		'readOnly' => TRUE,
		)
	);
	echo '<b> (' . $model->rating . ') </b>';
	$formattedRating = ob_get_contents();
	ob_end_clean();
	
    $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
                array(
                    'name'=>$model->cellar->getAttributeLabel('cellar_name'),
                    'value'=>$model->cellar->cellar_name
                ),
                array(
                    'name'=>$model->wine->winery->getAttributeLabel('winery_name'),
                    'value'=>$model->wine->winery->winery_name
                ),
                array(
                    'name'=>$model->wine->getAttributeLabel('wine_name'),
                    'value'=>$model->wine->wine_name
                ),
                array(
                    'name'=>$model->wine->appellation->getAttributeLabel('appellation'),
                    'value'=>$model->wine->appellation->appellation
                ),
                array(
                    'name'=>$model->wine->getAttributeLabel('wine_year'),
                    'value'=>$model->wine->wine_year
                ),
                array(
                    'name'=>$model->wine->wineVarietal->getAttributeLabel('name'),
                    'value'=>$model->wine->wineVarietal->name
                ),
				'quantity',
                array(
                    'name'=>$model->getAttributeLabel('rating'),
					'type'=>'raw',
                    'value'=>$formattedRating
                ),
                array(
                    'name'=>$model->cellarLoc->getAttributeLabel('location'),
                    'value'=>$model->cellarLoc->location
                ),
				'cost',
				'create_dt',
				'update_dt',
		),
    ));
    
    // display the image from the wine record
    echo "<br>";
    echo CHtml::image(Yii::app()->baseUrl.'/images/labels/'.$model->wine->image_file,
        "",
        array("width"=>"194px" ,"height"=>"258px"));
?>
