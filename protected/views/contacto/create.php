<?php
/* @var $this ContactoController */
/* @var $model Contacto */
?>

<?php
$this->breadcrumbs=array(
	'Contactos'=>array('admin'),
	'Agregar Contacto',
);

?>

<h1 class="white">Agregar Contacto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>