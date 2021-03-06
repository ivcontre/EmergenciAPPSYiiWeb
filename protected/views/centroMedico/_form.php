<?php
/* @var $this CentroMedicoController */
/* @var $model CentroMedico */
/* @var $form CActiveForm */
?>

<div class="form white">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'centro-medico-form',
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
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200, 'class'=>'span5')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>500, 'class'=>'span5')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_comuna'); ?>
                <?php
                    
                    if($model->idComuna!=''){
                        $value = $model->idComuna->nombre;
                    }else{
                        $value = '';
                    }
                    
                    echo $form->hiddenField($model, 'id_comuna');
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array (
                        'name' => 'CentroMedico_comuna',
                        'model' => $model,
                        'value' => $value,
                        'sourceUrl' => $this->createUrl('ListarComunas'),
                        'options' => array(
                                    'minLength' => '2',
                                    'showAnim' => 'fold',
                                    'select' => 'js:function(event, ui) {jQuery("#CentroMedico_id_comuna").val(ui.item["nombre"]); '
                            . 'actionCentroMedico.centrarMapaConDireccion(ui.item["value"]);}',
                                   
                        ),
                    ));
                     
                     
                ?>
		<?php echo $form->error($model,'id_comuna'); ?>
	</div>
        <div class="row">
            <div id="map" style="width:470px; height:300px"></div>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'x'); ?>
		<?php echo $form->textField($model,'x', array('class'=>'span5')); ?>
		<?php echo $form->error($model,'x'); ?>
                
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'y'); ?>
		<?php echo $form->textField($model,'y', array('class'=>'span5')); ?>
		<?php echo $form->error($model,'y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15,'class'=>'span5')); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row buttons">
                <?php echo TbHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->