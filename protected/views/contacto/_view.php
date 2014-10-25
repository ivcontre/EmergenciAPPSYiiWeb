<?php
/* @var $this ContactoController */
/* @var $data Contacto */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_contacto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_contacto),array('view','id'=>$data->id_contacto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_telefono')); ?>:</b>
	<?php echo CHtml::encode($data->numero_telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alerta_sms')); ?>:</b>
	<?php echo CHtml::encode($data->alerta_sms); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('alerta_gps')); ?>:</b>
	<?php echo CHtml::encode($data->alerta_gps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alerta_correo')); ?>:</b>
	<?php echo CHtml::encode($data->alerta_correo); ?>
	<br />

	*/ ?>

</div>