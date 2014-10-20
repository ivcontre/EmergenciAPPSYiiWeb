<?php
/* @var $this PdiController */
/* @var $model PDI */

$this->breadcrumbs=array(
	'Pdis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PDI', 'url'=>array('index')),
	array('label'=>'Create PDI', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pdi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Policia de Investigaciones</h1>

<?php 
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
