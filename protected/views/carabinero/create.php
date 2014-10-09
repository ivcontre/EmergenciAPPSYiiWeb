<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Carabinero', 'url'=>array('index')),
	array('label'=>'Manage Carabinero', 'url'=>array('admin')),
);
?>

<h1>Create Carabinero</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>