<?php
    /* @var $this SiteController */

    $this->pageTitle=Yii::app()->name;
    $today_dt = new DateTime("now", new DateTimeZone('America/Chicago'));
    $today = $today_dt->format('l jS F Y');
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Wine of the Day for <?php echo $today; ?>; </p>

<div>
    <h2>Our wine of the day is selected from across all cellars.</h2>
    
    <table style="width: 629px; height: 280px;" border="0">
        <tbody>
            <tr>
                <td>
                    <table border="0">
                        <tbody>
                            <tr>
                                <td><strong>Wine</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->wine_name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Vintage</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->wine_year); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Winery</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->winery->winery_name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Varietal</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->wineVarietal->name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Appelation</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->appellation->appellation); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Overall Rating</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->overall_rating); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td><?php echo CHtml::encode($wineRecord->description); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td><?php echo CHtml::image(Yii::app()->baseUrl.'/images/labels/'.$wineRecord->image_file,
                        "",
                        array("width"=>"194px" ,"height"=>"258px"));
                    ?>
                </td>
            </tr>
        </tbody>
    </table>    
</div>


