<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
?>

<?php
$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.$model->usuario->numero_telefono),
	'Editar Configuración',
);

$this->menu=array(
	array('label'=>'Perfil', 'url'=>array('usuario/view', 'id'=>$model->numero_usuario)),
);
?>

    <h1 class="white">Actualiza tu Configuración</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>