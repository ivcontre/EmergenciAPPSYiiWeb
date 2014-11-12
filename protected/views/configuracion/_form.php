<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'configuracion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'numero_pdi',array('span'=>5,'maxlength'=>15)); ?>

            <?php echo $form->textFieldControlGroup($model,'numero_carabinero',array('span'=>5,'maxlength'=>15)); ?>

            <?php echo $form->textFieldControlGroup($model,'numero_bombero',array('span'=>5,'maxlength'=>15)); ?>

            <?php echo $form->textFieldControlGroup($model,'numero_centro_medico',array('span'=>5,'maxlength'=>15)); ?>
    <div class="control-group">
            <?php echo $form->labelEx($model,'radio_busqueda'); ?>
        <input type="text" id="valor_slider" readonly style="border:0; color:#f6931f; font-weight:bold;" value="<?php echo $model->radio_busqueda?> (KM)">
        <div class="controls">
            <?php 
            $form->widget('zii.widgets.jui.CJuiSliderInput', array(
                'model'=>$model,
                'name'=>'Configuracion_radio_busqueda',
                'attribute'=>'radio_busqueda',
                'event'=>'change',
                'options'=>array(
                    'range'=>'min',
                    'min'=>0,
                    'max'=>20,
                    'slide'=>'js:function(event, ui) {
                        console.log(ui.value);
                        $("#Configuracion_radio_busqueda").val(ui.value);
                        $("#valor_slider").val(ui.value + " (KM)");
                        }'
                ),
            ));
           
            ?>
        </div>
         </div>
            <?php //echo $form->hiddenField($model, 'radio_busqueda');?>
            <?php //echo $form->textFieldControlGroup($model,'radio_busqueda',array('span'=>5)); ?>

            <?php echo $form->textAreaControlGroup($model,'mensaje_alerta',array('span'=>5,'maxlength'=>50,'rows' => 5)); ?>
    
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? '' : 'Guardar',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->