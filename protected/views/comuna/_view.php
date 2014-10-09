<?php
/* @var $this ComunaController */
/* @var $data Comuna */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_comuna')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_comuna), array('view', 'id'=>$data->id_comuna)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />


</div>