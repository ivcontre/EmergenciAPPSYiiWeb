<?php

/**
 * This is the model class for table "configuracion".
 *
 * The followings are the available columns in table 'configuracion':
 * @property integer $id_configuracion
 * @property string $numero_usuario
 * @property string $numero_pdi
 * @property string $numero_carabinero
 * @property string $numero_bombero
 * @property string $numero_centro_medico
 * @property integer $radio_busqueda
 * @property string $mensaje_alerta
 * @property string $fecha_modificacion
 *
 * The followings are the available model relations:
 * @property Usuario $numeroUsuario
 */
class Configuracion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configuracion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_configuracion, numero_usuario, numero_pdi, numero_carabinero, numero_bombero, numero_centro_medico, radio_busqueda, mensaje_alerta, fecha_modificacion', 'required'),
			array('id_configuracion, radio_busqueda', 'numerical', 'integerOnly'=>true),
			array('numero_usuario, numero_pdi, numero_carabinero, numero_bombero, numero_centro_medico', 'length', 'max'=>15),
			array('mensaje_alerta', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_configuracion, numero_usuario, numero_pdi, numero_carabinero, numero_bombero, numero_centro_medico, radio_busqueda, mensaje_alerta, fecha_modificacion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'numero_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_configuracion' => 'Id Configuracion',
			'numero_usuario' => 'Numero Usuario',
			'numero_pdi' => 'Numero Pdi',
			'numero_carabinero' => 'Numero Carabinero',
			'numero_bombero' => 'Numero Bombero',
			'numero_centro_medico' => 'Numero Centro Medico',
			'radio_busqueda' => 'Radio Busqueda',
			'mensaje_alerta' => 'Mensaje Alerta',
			'fecha_modificacion' => 'Fecha Modificacion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_configuracion',$this->id_configuracion);
		$criteria->compare('numero_usuario',$this->numero_usuario,true);
		$criteria->compare('numero_pdi',$this->numero_pdi,true);
		$criteria->compare('numero_carabinero',$this->numero_carabinero,true);
		$criteria->compare('numero_bombero',$this->numero_bombero,true);
		$criteria->compare('numero_centro_medico',$this->numero_centro_medico,true);
		$criteria->compare('radio_busqueda',$this->radio_busqueda);
		$criteria->compare('mensaje_alerta',$this->mensaje_alerta,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Configuracion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
