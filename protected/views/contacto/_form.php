<?php
/* @var $this ContactoController */
/* @var $model Contacto */
/* @var $form TbActiveForm */
?>

<div class="form white">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contacto-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'nombre',array('span'=>5,'maxlength'=>50)); ?>

            <?php echo $form->textFieldControlGroup($model,'numero',array('span'=>5,'maxlength'=>15)); ?>

            <?php echo $form->textFieldControlGroup($model,'correo',array('span'=>5,'maxlength'=>35)); ?>

            <?php //echo $form->textFieldControlGroup($model,'estado',array('span'=>5)); ?>
    
            <?php //echo $form->checkBoxControlGroup($model, 'alerta_sms', array('span' => 5)); ?>
    <div class="row">
        <div class="col-md-3">
        <label>Alerta SMS</label>
            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'Contacto[alerta_sms]',
                        'model'=>$model,
                        'attribute'=>'alerta_sms'
            )); ?>
        </div>
        <div class="col-md-3">
        <label>Alerta GPS</label>
            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'Contacto[alerta_gps]',
                        'model'=>$model,
                        'attribute'=>'alerta_gps'
            )); ?>
        </div>
        <div class="col-md-3">
        <label>Alerta Correo</label>
            <?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'Contacto[alerta_correo]',
                        'model'=>$model,
                        'attribute'=>'alerta_correo'
            )); ?>
        </div>
     </div>
            <?php //echo $form->textFieldControlGroup($model,'alerta_sms',array('span'=>5)); ?>
            <?php //echo $form->checkBoxControlGroup($model, 'alerta_gps', array('span' => 5)); ?>
            <?php //echo $form->textFieldControlGroup($model,'alerta_gps',array('span'=>5)); ?>
            <?php //echo $form->checkBoxControlGroup($model, 'alerta_correo', array('span' => 5)); ?>
            <?php //echo $form->textFieldControlGroup($model,'alerta_correo',array('span'=>5)); ?>

        <div class="">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->