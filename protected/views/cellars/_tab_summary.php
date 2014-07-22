<?php
/* @var $this CellarsController */
/* @var $data Cellars */
?>

<div class="row"> 
    <div class="span6" >  
        <?php
            $this->Widget('ext.highcharts.HighchartsWidget', array(
               'options'=>array(
                  'chart' => array('type' => 'bar'),
                  'title' => array('text' => $title),
                  'xAxis' => array('categories' => $xLabels),
                  'yAxis' => array('title' => array('text' => null)),
                  'series' => array(
                                    array(
                                        'name' => 'Bottle Count', 
                                        'data' => $dataArray,
                                    )
                                )
               )
            ));
        ?>
    </div>
</div>