<?php
/* @var $this PdiController */
/* @var $model PDI */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pdi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

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
                        'name' => 'nombre',
                        'model' => $model,
                        'value' => $value,
                        'sourceUrl' => $this->createUrl('ListarComunas'),
                        'options' => array(
                                    'minLength' => '2',
                                    'showAnim' => 'fold',
                                    'select' => 'js:function(event, ui) {jQuery("#nombre").val(ui.item["id_comuna"]);}',
                                   
                        ),
                    ));
                     
                     
                ?>
		<?php echo $form->error($model,'id_comuna'); ?>
	</div>
        
        <div class="row">
            <div id="map" style="width:450px; height:300px"></div>
            <?php   if(isset($model->x) && isset($model->y)){
                        echo "<script>cargarMapaEdicion(".$model->x.",".$model->y.");</script>";
                    }else{
                        $centro = "PDI";
                        echo "<script>cargarMapaIngreso('".$centro."');</script>";
                        
                    }
                    
             ?>
            
            
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->