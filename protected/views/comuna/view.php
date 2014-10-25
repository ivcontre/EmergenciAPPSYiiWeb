<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	$model->id_comuna,
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Agregar nueva Comuna', 'url'=>array('create')),
	array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->id_comuna)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_comuna),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar todas', 'url'=>array('admin')),
);
?>

<h1>View Comuna #<?php echo $model->id_comuna; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_comuna',
		'nombre',
	),
)); ?>
