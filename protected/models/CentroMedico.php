<?php

/**
 * This is the model class for table "centro_medico".
 *
 * The followings are the available columns in table 'centro_medico':
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property integer $id_comuna
 * @property double $x
 * @property double $y
 * @property string $telefono
 *
 * The followings are the available model relations:
 * @property Comuna $idComuna
 */
class CentroMedico extends CActiveRecord
{
    public $comuna_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'centro_medico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, direccion, id_comuna, x, y, telefono', 'required'),
			array('id_comuna', 'numerical', 'integerOnly'=>true),
			array('x, y', 'numerical'),
			array('nombre', 'length', 'max'=>200),
			array('direccion', 'length', 'max'=>500),
			array('telefono', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, direccion, id_comuna, x, y, telefono', 'safe', 'on'=>'search'),
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
			'idComuna' => array(self::BELONGS_TO, 'Comuna', 'id_comuna'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'direccion' => 'Dirección',
			'id_comuna' => 'Comuna',
			'x' => 'Latitud',
			'y' => 'Longitud',
			'telefono' => 'Teléfono',
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
                
                
                
                $criteria->with = 'idComuna';
                
                $criteria->compare('idComuna.nombre',$this->id_comuna,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('t.nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		//$criteria->compare('id_comuna',$this->id_comuna);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('telefono',$this->telefono,true);
                $_SESSION['datos_filtrados'] = $criteria;
                $_SESSION['centroMedicoFilter']=$this;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CentroMedico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
