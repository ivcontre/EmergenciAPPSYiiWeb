
<?php Yii::app()->bootstrap->register(); ?>
        <div class="container">
            <h1><small>Bomberos de Chile</small></h1>
            

<?php
/* @var $model Bombero */
/* @var $criteria Criteria */

    $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => TbHtml::GRID_TYPE_HOVER,
    'dataProvider'=>new CActiveDataProvider($model, array(
                                                    'criteria'=>$criteria,
                                                    'pagination'=>false,)),
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
</div>
