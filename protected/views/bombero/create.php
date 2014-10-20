<?php
/* @var $this BomberoController */
/* @var $model Bombero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionBombero.js');

$this->breadcrumbs=array(
	'Bomberos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Administrar', 'url'=>array('admin')),
);
?>

<h1>Crear Bombero</h1>

<?php $this->renderPartial('_form', array('model'=>$model));
echo "<script>actionBombero.cargarMapaIngreso('Bombero');</script>";?>