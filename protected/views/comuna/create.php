<?php
/* @var $this ComunaController */
/* @var $model Comuna */

$this->breadcrumbs=array(
	'Comunas'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>
<br>
<h2 class="white">Agregar Comuna</h2>
<br><br><br><br>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<br><br><br><br><br><br><br><br><br><br><br><br>