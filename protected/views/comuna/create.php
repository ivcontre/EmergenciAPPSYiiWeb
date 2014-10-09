<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comuna', 'url'=>array('index')),
	array('label'=>'Manage Comuna', 'url'=>array('admin')),
);
?>

<h1>Create Comuna</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>