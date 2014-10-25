<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
?>

<?php
$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->numero_usuario),
	'Mi Configuración',
);

$this->menu=array(
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id_configuracion)),
);
?>
<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'nullDisplay'=>'sin valor aún',
    'attributes'=>array(
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