<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */

$this->breadcrumbs=array(
	'Carabineros'=>array('index'),
	'Administrar',
);

$this->menu=array(
	//array('label'=>'Listar Carabineros', 'url'=>array('index')),
	array('label'=>'Ingresar Nuevo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#carabinero-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Carabineros</h1>


<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'carabinero-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//		'id',
//		'nombre',
//		'direccion',
//		array(
//                    'value' => '$data->idComuna->nombre',
//                    'name' => 'id_comuna'
//                ),
//		
//		'x',
//		
//		'y',
//		'telefono',
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//)); 
$this->widget('bootstrap.widgets.TbGridView', array(
   'dataProvider' => $model->search(),
   'filter' => $model,
   'type' => TbHtml::GRID_TYPE_HOVER,
   'template' => "{items}",
   'columns'=>array(
		'id',
		'nombre',
		'direccion',
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'id_comuna'
                ),
		'telefono',
		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>
