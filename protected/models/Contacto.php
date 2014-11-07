<?php

/**
 * This is the model class for table "contacto".
 *
 * The followings are the available columns in table 'contacto':
 * @property integer $id_contacto
 * @property string $numero_telefono
 * @property string $nombre
 * @property string $numero
 * @property string $correo
 * @property integer $estado
 * @property boolean $alerta_sms
 * @property integer $alerta_gps
 * @property integer $alerta_correo
 *
 * The followings are the available model relations:
 * @property Usuario $numeroTelefono
 */
class Contacto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contacto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero_telefono, nombre, numero, correo, estado, alerta_sms, alerta_gps, alerta_correo', 'required'),
			array('estado, alerta_sms, alerta_gps, alerta_correo', 'numerical', 'integerOnly'=>true),
			array('numero_telefono, numero', 'length', 'max'=>15),
			array('nombre', 'length', 'max'=>50),
			array('correo', 'length', 'max'=>35),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_contacto, numero_telefono, nombre, numero, correo, estado, alerta_sms, alerta_gps, alerta_correo', 'safe', 'on'=>'search'),
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
			'numeroTelefono' => array(self::BELONGS_TO, 'Usuario', 'numero_telefono'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_contacto' => 'Id Contacto',
			'numero_telefono' => 'Numero Telefono',
			'nombre' => 'Nombre',
			'numero' => 'Numero',
			'correo' => 'Correo',
			'estado' => 'Estado',
			'alerta_sms' => 'Alerta Sms',
			'alerta_gps' => 'Alerta Gps',
			'alerta_correo' => 'Alerta Correo',
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
                
		$criteria->compare('id_contacto',$this->id_contacto);
		$criteria->compare('numero_telefono',Yii::app()->user->id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('alerta_sms',$this->alerta_sms);
		$criteria->compare('alerta_gps',$this->alerta_gps);
		$criteria->compare('alerta_correo',$this->alerta_correo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contacto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
