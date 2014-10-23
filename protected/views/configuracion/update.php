<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
?>

<?php
$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->usuario->numero_telefono),
	'Mi Configuracion'=>array('view','id'=>$model->id_configuracion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'List Configuracion', 'url'=>array('index')),
	array('label'=>'Create Configuracion', 'url'=>array('create')),
	array('label'=>'View Configuracion', 'url'=>array('view', 'id'=>$model->id_configuracion)),
	array('label'=>'Manage Configuracion', 'url'=>array('admin')),
);
?>

    <h1>Update Configuracion <?php echo $model->id_configuracion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>