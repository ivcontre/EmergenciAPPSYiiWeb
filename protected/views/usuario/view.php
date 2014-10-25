<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Perfil',
);

$this->menu=array(
	array('label'=>'Editar Cuenta', 'url'=>array('update', 'id'=>$model->numero_telefono)),
        array('label'=>'Editar Configuracion', 'url'=>array('configuracion/update', 'id'=>Yii::app()->user->idConfiguracion)),
        TbHtml::menuDivider(),
        array('label'=>'Mis Contactos', 'url'=>array('contacto/admin')),
	//array('label'=>'Delete Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->numero_telefono),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<?php echo TbHtml::quote('Cuenta'); ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
        ),
	'attributes'=>array(
		'numero_telefono',
		'nombre',
		'apellido',
		'correo',
	),
)); ?>

<?php echo TbHtml::quote('Configuración'); ?>
<?php 
foreach($model->configuracion as $conf){
    $configuracion = $conf;
}
$this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$configuracion,
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
