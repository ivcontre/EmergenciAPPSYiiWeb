<?php
/* @var $this ContactoController */
/* @var $model Contacto */
?>

<?php
$this->breadcrumbs=array(
	'Contactos'=>array('admin'),
	$model->nombre,
);

$this->menu=array(
	array('label'=>'Ver todos', 'url'=>array('admin')),
	array('label'=>'Agregar Nuevo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id_contacto)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_contacto),'confirm'=>'Estás seguro de eliminar tu contacto?')),
);
?>

<h1># <?php echo $model->nombre; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'nombre',
		'numero',
		'correo',
                array(
                    'value' => ($model->estado == 0)?'No ha activado su alerta':'Su dispositivo se encuentra en modo alerta',
                    'name' => 'estado'
                ),
                array(
                    'value' => ($model->alerta_sms == 0)?'Envío SMS Desactivado':'Envío SMS Activado',
                    'name' => 'alerta_sms'
                ),
                array(
                    'value' => ($model->alerta_gps == 0)?'Seguimiento Desactivado':'Seguimiento Activado',
                    'name' => 'alerta_gps'
                ),
                array(
                    'value' => ($model->alerta_correo == 0)?'Envío de e-mail Desactivado':'Envío de e-mail Activado',
                    'name' => 'alerta_correo'
                ),
	),
)); 

?>