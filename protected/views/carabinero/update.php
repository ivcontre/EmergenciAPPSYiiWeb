<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Carabineros', 'url'=>array('index')),
	array('label'=>'Crear nuevo', 'url'=>array('create')),
	array('label'=>'Ver detalle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar carabinero', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('Editar Carabinero', $model->nombre); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>