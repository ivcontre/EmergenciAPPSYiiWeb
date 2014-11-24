<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>
<div class="falso1">
<section class="falso">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
)); ?>

	<p class="note white">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row white">
		<?php echo $form->labelEx($model,'numero_telefono'); ?>
		<?php echo $form->textField($model,'numero_telefono',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'numero_telefono'); ?>
	</div>

	<div class="row white">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row white">
		<?php echo $form->labelEx($model,'apellido'); ?>
		<?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>

	<div class="row white">
		<?php echo $form->labelEx($model,'correo'); ?>
		<?php echo $form->textField($model,'correo',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'correo'); ?>
	</div>

	<div class="row white">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        <div class="row white">
		<?php echo $form->labelEx($model,'password_repeat'); ?>
		<?php echo $form->passwordField($model,'password_repeat',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>



	<div class="row buttons">
		<?php echo TbHtml::submitButton('Registrarse',array(
		    'color'=>TbHtml::BUTTON_COLOR_WARNING,
		    
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</section>
</div>
