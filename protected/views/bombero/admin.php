<?php
/* @var $this BomberoController */
/* @var $model Bombero */

$this->breadcrumbs=array(
	'Administrar Bomberos',
);

$this->menu=array(
	//array('label'=>'List Bombero', 'url'=>array('index')),
	array('label'=>'Ingresar Nuevo', 'url'=>array('create')),
         TbHtml::menuDivider(),
        array('label'=>'Generar Reporte', 'url'=>array('PrintDocument')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bombero-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><small>Administrar Cuarteles de Bomberos </small>
    <a href="<?PHP echo $this->createUrl('create');?>" title="Agrega un nuevo Centro Médico">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/mas.png";?>">  
    </a>
    <a href="<?PHP echo $this->createUrl('PrintDocument');?>" target="_blank" title="Generar PDF" style="float: right">  
        <img src="<?PHP echo Yii::app()->request->baseUrl."/icons/pdf.png";?>">
    </a>
</h1> 
<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
   'dataProvider' => $model->search(),
   'filter' => $model,
   'type' => TbHtml::GRID_TYPE_HOVER,
   
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
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));

?>
