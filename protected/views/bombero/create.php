<?php
/* @var $this BomberoController */
/* @var $model Bombero */

$this->breadcrumbs=array(
	'Bomberos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bombero', 'url'=>array('index')),
	array('label'=>'Manage Bombero', 'url'=>array('admin')),
);
?>

<h1>Create Bombero</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>