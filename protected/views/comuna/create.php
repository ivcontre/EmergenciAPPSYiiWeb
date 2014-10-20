<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Crear Comuna</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>