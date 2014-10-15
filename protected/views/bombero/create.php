<?php
/* @var $this BomberoController */
/* @var $model Bombero */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/actionBombero.js');

$this->breadcrumbs=array(
	'Bomberos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bomberos', 'url'=>array('index')),
	array('label'=>'Administrar Bomberos', 'url'=>array('admin')),
);
?>

<h1>Crer Bombero</h1>

<?php $this->renderPartial('_form', array('model'=>$model));
echo "<script>actionBombero.cargarMapaIngreso('Bombero');</script>";?>