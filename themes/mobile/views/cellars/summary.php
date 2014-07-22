<?php
/* @var $this CellarsController */
/* @var $model Cellars */

$this->breadcrumbs=array(
        'Cellars'=>array('/cellars/index'),
        $model->cellar_name=>array('/cellars/view', 'id'=>$model->id),
        'Cellar Summary',
);

if (Yii::app()->user->name === 'admin')
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
	array('label'=>'Update Cellar', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Wine Inventory', 'url'=>array('/cellarWines/index', 'cellar_id'=>$model->id)),
	array('label'=>'Manage Cellars', 'url'=>array('admin')),
    );
}
else
{
    $this->menu=array(
	array('label'=>'List Cellars', 'url'=>array('index')),
	array('label'=>'Create Cellars', 'url'=>array('create')),
	array('label'=>'Update Cellar', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Wine Inventory', 'url'=>array('/cellarWines/index', 'cellar_id'=>$model->id))
    );
}
?>

<h1><?php echo "Cellar Summary for " . $model->cellar_name; ?></h1>
<h2><?php echo "Total Bottles in Cellar = " . $totalBottles; ?></h2> 

<?php 
    Yii::app()->session['cellar_id'] = $model->id;
    
    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
            'By Varietal'=>array(
                            'id'=>'byV',
                            'content'=>$this->renderPartial(
                                '_tab_summary',
                                array(
                                    'model'=>$model,
                                    'dataArray'=>$dataArrayV,
                                    'xLabels'=>$xLabelsV,
                                    'title'=>'Cellar Wines by Varietal',
                                ),
                                TRUE
                            ),
            ),
            'By Winery'=>array(
                            'id'=>'byW',
                            'content'=>$this->renderPartial(
                                '_tab_summary',
                                array(
                                    'model'=>$model,
                                    'dataArray'=>$dataArrayW,
                                    'xLabels'=>$xLabelsW,
                                    'title'=>'Cellar Wines by Winery',
                                ),
                                TRUE
                            ),
            ),
            'By Location'=>array(
                            'id'=>'byL',
                            'content'=>$this->renderPartial(
                                '_tab_summary',
                                array(
                                    'model'=>$model,
                                    'dataArray'=>$dataArrayL,
                                    'xLabels'=>$xLabelsL,
                                    'title'=>'Cellar Wines by Location',
                                ),
                                TRUE
                            ),
            ),
        ),
        'options'=>array('collapsible'=>true),
    ));
?>
