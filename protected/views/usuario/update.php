<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->numero_telefono),
	'Editar',
);

$this->menu=array(
	array('label'=>'List Usuario', 'url'=>array('index')),
	array('label'=>'Create Usuario', 'url'=>array('create')),
	array('label'=>'View Usuario', 'url'=>array('view', 'id'=>$model->numero_telefono)),
	array('label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<h1>Editar Cuenta<?php echo $model->numero_telefono; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>