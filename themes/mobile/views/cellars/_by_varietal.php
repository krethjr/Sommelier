<?php
/* @var $this CellarsController */
/* @var $data Cellars */
?>

<div class="row"> 
    <div class="span6" >  
        <?php
        $labels = array('Apples', 'Bananas', 'Oranges');
        $tempData = array(5, 7, 3);
            
            $this->Widget('ext.highcharts.HighchartsWidget', array(
               'options'=>array(
                  'chart' => array('type' => 'bar'),
                  'title' => array('text' => 'Cellar Wines by Varietal'),
                  'xAxis' => array(
                     'categories' => $vLabels
                  ),
                  'yAxis' => array(
                     'title' => array('text' => null)
                  ),
                  'series' => array(
                     array('name' => 'Bottle Count', 'data' => $dataArray)
                  )
               )
            ));
        ?>
    </div>
</div>