<?php

/* @var $models CentroMedico */

    $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_HOVER,
    'dataProvider'=>new CArrayDataProvider($models),
    'template' => "{items}",
    'columns'=>array(
		'id',
		'nombre',
		'direccion',
		array(
                    'value' => '$data->idComuna->nombre',
                    'name' => 'Comuna'
                ),
		'telefono',
	),
    ));
?>

