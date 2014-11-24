<?php
/* @var $this CarabineroController */
/* @var $model Carabinero */
/* @var $form CActiveForm */
?>

<div class="form white">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'carabinero-form',
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
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>500)); ?>
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
                        'name' => 'Carabinero_comuna',
                        'model' => $model,
                        'value' => $value,
                        'sourceUrl' => $this->createUrl('ListarComunas'),
                        'options' => array(
                                    'minLength' => '2',
                                    'showAnim' => 'fold',
                                    'select' => 'js:function(event, ui){
                                                        $("#Carabinero_id_comuna").val(ui.item["nombre"]);
                                                        actionCarabinero.centrarMapaConDireccion(ui.item["value"]);
                                                   }',
                                   
                        ),
                    ));
                     
                     
                ?>
		<?php echo $form->error($model,'id_comuna'); ?>
	</div>

	
        <div class="row">
            <div id="map" style="width:450px; height:300px"></div>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'x'); ?>
		<?php echo $form->textField($model,'x'); ?>
		<?php echo $form->error($model,'x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'y'); ?>
		<?php echo $form->textField($model,'y'); ?>
		<?php echo $form->error($model,'y'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row buttons">
                <?php echo TbHtml::formActions(array(
                        TbHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
                    )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->