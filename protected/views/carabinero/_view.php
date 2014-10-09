<?php
/* @var $this CarabineroController */
/* @var $data Carabinero */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_comuna')); ?>:</b>
	<?php echo CHtml::encode($data->idComuna->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('x')); ?>:</b>
	<?php echo CHtml::encode($data->x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('y')); ?>:</b>
	<?php echo CHtml::encode($data->y); ?>
	<br />


</div>