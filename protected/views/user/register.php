<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register',
);
?>

<h1>Register a New User</h1>

<?php $this->renderPartial('_regForm', array('model'=>$model)); ?>