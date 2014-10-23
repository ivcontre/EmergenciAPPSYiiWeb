<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
?>

<?php
$this->breadcrumbs=array(
	'Configuracions'=>array('index'),
	$model->id_configuracion,
);

$this->menu=array(
	array('label'=>'List Configuracion', 'url'=>array('index')),
	array('label'=>'Create Configuracion', 'url'=>array('create')),
	array('label'=>'Update Configuracion', 'url'=>array('update', 'id'=>$model->id_configuracion)),
	array('label'=>'Delete Configuracion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_configuracion),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Configuracion', 'url'=>array('admin')),
);
?>

<h1>View Configuracion #<?php echo $model->id_configuracion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'nullDisplay'=>'sin valor aún',
    'attributes'=>array(
		'id_configuracion',
		'numero_usuario',
		'numero_pdi',
		'numero_carabinero',
		'numero_bombero',
		'numero_centro_medico',
		'radio_busqueda',
		'mensaje_alerta',
		'fecha_modificacion',
	),
)); ?>