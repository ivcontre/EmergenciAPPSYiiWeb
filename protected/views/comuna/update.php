<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	$model->nombre=>array('view','id'=>$model->id_comuna),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ingresar nuevo', 'url'=>array('create')),
	array('label'=>'Detalle', 'url'=>array('view', 'id'=>$model->id_comuna)),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<?php echo TbHtml::pageHeader('Editar ', $model->nombre); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>