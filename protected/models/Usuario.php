<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $numero_telefono
 * @property string $regid
 * @property integer $id_tipo_usuario
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $password
 * @property integer $estado_alerta
 * @property double $latitud
 * @property double $longitud
 * @property string $fecha_ingreso
 *
 * The followings are the available model relations:
 * @property Notificacion[] $notificacions
 * @property Contacto[] $contactos
 * @property TipoUsuario $idTipoUsuario
 * @property Configuracion $configuracion
 */
class Usuario extends CActiveRecord
{
        public $password_repeat;
        public $password_old;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero_telefono, id_tipo_usuario, nombre, apellido, correo, password', 'required', 'message'=>'El campo {attribute} no puede ser vacío'),
			array('password_repeat','required','on'=>'register', 'message'=>'El campo {attribute} no puede ser vacío'),
                        
                        array('password_old, password','required','on'=>'updatePass', 'message'=>'El campo {attribute} no puede ser vacío'),
                        array('password_old', 'verificaOldPassword', 'on'=>'updatePass', 'message'=>'password incorrecto'),
                        
                        array('id_tipo_usuario, estado_alerta', 'numerical', 'integerOnly'=>true),
			array('latitud, longitud', 'numerical'),
			array('numero_telefono', 'length', 'max'=>25),
                        array('correo', 'length', 'max'=>50),
                        array('numero_telefono','unique', 'className'=>'Usuario', 'message'=>'El n° telefónico {value} ya se encuentra en nuestros registros'),
			array('correo','unique', 'className'=>'Usuario', 'message'=>'El e-mail {value} ya está siendo usado en nuestro sistema.'),
                        array('regid', 'length', 'max'=>200),
			array('nombre, apellido', 'length', 'max'=>50),
			array('password', 'length', 'max'=>20),
                        array('password', 'verificaPassword', 'on'=>'update', 'message'=>'password incorrecto'),
                        array('password_repeat', 'compare', 'compareAttribute'=>'password', 'on'=>'register', 'message'=>'Verifique contraseña por favor'),
                        // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('numero_telefono, regid, id_tipo_usuario, nombre, apellido, correo, password, estado_alerta, latitud, longitud', 'safe', 'on'=>'search'),
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
                        'notificaciones' => array(self::HAS_MANY, 'Notificacion', 'numero_telefono'),
			'contactos' => array(self::HAS_MANY, 'Contacto', 'numero_telefono'),
			'idTipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'id_tipo_usuario'),
                        'configuracion' => array(self::HAS_ONE, 'Configuracion', 'numero_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{       
            switch( $this->getScenario() ){
                case 'register':
                    return array(
			'numero_telefono' => 'Numero Telefono',
			'regid' => 'Regid',
			'id_tipo_usuario' => 'Id Tipo Usuario',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'correo' => 'Correo',
			'password' => 'Contraseña',
                        'password_repeat' => 'Confirmar contraseña',
			'estado_alerta' => 'Estado Alerta',
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
		);
                    break;
                case 'update':
                    return array(
			'numero_telefono' => 'N° Teléfono',
			'regid' => 'Regid',
			'id_tipo_usuario' => 'Id Tipo Usuario',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'correo' => 'Correo',
			'password' => 'Contraseña',
                        'password_repeat' => 'Confirmar contraseña',
                        'password_new' => 'Contraseña',
			'estado_alerta' => 'Estado Alerta',
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
		);
                    break;
                case 'updatePass':
                    return array(
			'password' => 'Contraseña Nueva',
                        'password_old' => 'Contraseña Actual',
		);
                    break;
                default:
                    return array(
			'numero_telefono' => 'Numero Telefono',
			'regid' => 'Regid',
			'id_tipo_usuario' => 'Id Tipo Usuario',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'correo' => 'Correo',
			'password' => 'Contraseña',
                        'password_repeat' => 'Confirmar contraseña',
                        'password_new' => 'Contraseña',
			'estado_alerta' => 'Estado Alerta',
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
		);
            }
	
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

		$criteria->compare('numero_telefono',$this->numero_telefono,true);
		$criteria->compare('regid',$this->regid,true);
		$criteria->compare('id_tipo_usuario',$this->id_tipo_usuario);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('estado_alerta',$this->estado_alerta);
		$criteria->compare('latitud',$this->latitud);
		$criteria->compare('longitud',$this->longitud);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function unique_update($att, $params){
            $model = self::model()->findByAttributes(array('numero_telefono'=>$this->numero_telefono));
            if($model != null){
                $this->addError($att,"ya hay usuario registrado con este número telefónico");
                return;
            }
        } 
        
        public function verificaPassword($att, $params){
            $model = self::model()->findByPk(Yii::app()->user->id);
            if($model->password != $this->password){
                $this->addError($att,"El password es incorrecto");
                return;
            }
        }
        
        public function verificaOldPassword($att, $params){
            $model = self::model()->findByPk(Yii::app()->user->id);
            if($model->password != $this->password_old){
                $this->addError($att,"El password es incorrecto");
                return;
            }
        }
}
