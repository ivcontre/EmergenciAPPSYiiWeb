<?php
/* @var $this ComunaController */
/* @var $model Comuna */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comuna-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row buttons">
                <?php echo TbHtml::formActions(array(
                        TbHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
                    )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->