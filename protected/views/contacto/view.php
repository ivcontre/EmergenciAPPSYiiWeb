<?php
/* @var $this ContactoController */
/* @var $model Contacto */
?>

<?php
$this->breadcrumbs=array(
	'Contactos'=>array('index'),
	$model->id_contacto,
);

$this->menu=array(
	array('label'=>'List Contacto', 'url'=>array('index')),
	array('label'=>'Create Contacto', 'url'=>array('create')),
	array('label'=>'Update Contacto', 'url'=>array('update', 'id'=>$model->id_contacto)),
	array('label'=>'Delete Contacto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_contacto),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contacto', 'url'=>array('admin')),
);
?>

<h1>View Contacto #<?php echo $model->id_contacto; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id_contacto',
		'numero_telefono',
		'nombre',
		'numero',
		'correo',
		'estado',
		'alerta_sms',
		'alerta_gps',
		'alerta_correo',
	),
)); ?>