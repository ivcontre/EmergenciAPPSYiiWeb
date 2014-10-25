<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Perfil',
);

$this->menu=array(
	array('label'=>'Editar Cuenta', 'url'=>array('update', 'id'=>$model->numero_telefono)),
	//array('label'=>'Delete Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->numero_telefono),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
        ),
	'attributes'=>array(
		'numero_telefono',
		'id_tipo_usuario',
		'nombre',
		'apellido',
		'correo',
	),
)); ?>
