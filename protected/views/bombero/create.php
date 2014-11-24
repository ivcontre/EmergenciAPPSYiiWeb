<?php
/* @var $this BomberoController */
/* @var $model Bombero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/admin/actionBombero.js');

$this->breadcrumbs=array(
	'Bomberos'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	//array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Ver todos', 'url'=>array('admin')),
);
?>

<h2 class="white">Agregar Cuerpo de Bomberos</h2>

<?php $this->renderPartial('_form', array('model'=>$model));
echo "<script>actionBombero.cargarMapaIngreso('Bombero');</script>";?>