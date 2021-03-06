<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usuario-form',
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
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

    <p class="help-block">Los Campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model,'Por favor arregla los siguientes errores:'); ?>

    <div class="row white">
            <?php echo $form->passwordFieldControlGroup($model,'password_old',array('span'=>5,'maxlength'=>20)); ?>
    </div>
    <div class="row white">
            <?php echo $form->passwordFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>20)); ?>
    </div>
            

        <div class="">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->