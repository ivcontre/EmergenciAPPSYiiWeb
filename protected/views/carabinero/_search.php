<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_comuna'); ?>
                <?php $criteria = new CDbCriteria();
                      $criteria->order = 'nombre';
                ?>
		<?php echo $form->dropDownList($model,'id_comuna', CHtml::listData(Comuna::model()->findAll($criteria), 'id_comuna', 'nombre')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'x'); ?>
		<?php echo $form->textField($model,'x'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'y'); ?>
		<?php echo $form->textField($model,'y'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->