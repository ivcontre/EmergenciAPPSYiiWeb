<?php
/* @var $this ContactoController */
/* @var $model Contacto */

$this->breadcrumbs=array(
	'Perfil'=>array('usuario/view&id='.Yii::app()->user->id),
	'Contactos',
);

$this->menu=array(
	array('label'=>'Agregar Nuevo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contacto-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 class="white">Administrar Contactos <a class="btn btn-primary btn-large" name="yt0" type="button" href="<?PHP echo $this->createUrl('create')?>"><i class="icon-plus"></i></a></h1>



<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'contacto-grid',
        'htmlOptions'=>array('class'=>'grid-view contactos'),
	'dataProvider'=>$model->search(),
        'emptyText'=>'No has agregado contactos todavía :(',
	'filter'=>$model,
	'columns'=>array(
		//'id_contacto',
		//'numero_telefono',
		'nombre',
		'numero',
		'correo',
		//'estado',
		//'alerta_sms',
                array(
                    'header'=> 'Alerta SMS',
                    'value' => '(($data->alerta_sms == 0)?"No":"Si")',
                    'name' => 'alerta_sms'
                ),
		array(
                    'header'=> 'Alerta GPS',
                    'value' => '(($data->alerta_gps == 0)?"No":"Si")',
                    'name' => 'alerta_gps'
                ),
		array(
                    'header'=> 'Alerta Correo',
                    'value' => '(($data->alerta_correo == 0)?"No":"Si")',
                    'name' => 'alerta_correo'
                ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>