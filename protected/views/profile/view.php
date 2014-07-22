<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View User - <?php echo Yii::app()->user->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'profile',
		'create_dt',
		'last_login_dt',
		'first_name',
		'last_name',
		'country',
		'state',
		array(
                    'label'=>'Favorite Region',
                    'value'=>$model->favoriteRegion->region_name,
                ),
	),
)); ?>
