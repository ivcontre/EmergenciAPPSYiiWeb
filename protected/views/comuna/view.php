<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	$model->id_comuna,
);

$this->menu=array(
	array('label'=>'List Comuna', 'url'=>array('index')),
	array('label'=>'Create Comuna', 'url'=>array('create')),
	array('label'=>'Update Comuna', 'url'=>array('update', 'id'=>$model->id_comuna)),
	array('label'=>'Delete Comuna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_comuna),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comuna', 'url'=>array('admin')),
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
