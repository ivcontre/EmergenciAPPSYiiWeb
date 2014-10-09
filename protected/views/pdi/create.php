<?php
/* @var $this PdiController */
/* @var $model PDI */

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PDI', 'url'=>array('index')),
	array('label'=>'Manage PDI', 'url'=>array('admin')),
);
?>

<h1>Create PDI</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>