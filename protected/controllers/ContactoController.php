<?php

class ContactoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','alertas'),
				'users'=>array('user'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('user'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','seguimiento'),
				'users'=>array('user'),
			),
                    
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Contacto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Contacto'])) {
			$model->attributes=$_POST['Contacto'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id_contacto));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                
		$model=$this->loadModel($id);
                $this->allowEdit($model->numero_telefono);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Contacto'])) {
			$model->attributes=$_POST['Contacto'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id_contacto));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Contacto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contacto('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Contacto'])) {
			$model->attributes=$_GET['Contacto'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionSeguimiento(){
            $this->layout='';
            $this->render('seguimiento');
            $this->layout='//layouts/column2';
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contacto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contacto::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contacto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='contacto-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function allowEdit($idUsuario)
	{
            if($idUsuario != Yii::app()->user->id)
                throw new CHttpException(404, 'El contenido solicitado no fue encontrado');
	}
        
        public function alertas(){
            $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
            if($usuario != null){
                $response = array();
                $response['title'] = 'No tienes alertas';
                $notificaciones = Notificacion::model()->findAllByAttributes(array('numero_contacto'=>$usuario->numero_telefono, 'estado'=>'1'));
                if($notificaciones != null){
                    $response['title'] = 'Amigos en Peligro!';
                    $response['htmlOptions'] = array('color'=>TbHtml::BUTTON_COLOR_WARNING);
                    $listUser = array();
                    foreach($notificaciones as $notificacion){
                        
                        $user = $notificacion->usuario;
                        $configuracion = $user->configuracion;
                         
                        $listUser[] = array(
                            'label'=>$user->nombre.' - '.$user->numero_telefono, 
                            'url'=>'javascript:actionSeguimiento.cargaPunto('.$user->latitud.','.$user->longitud.',"'.$user->nombre.'","'.$user->numero_telefono.'","'.$configuracion->mensaje_alerta.'")'
                            );
                        
                    }
                    $response['labels'] = $listUser;
                }else{
                    
                    $response['labels'] = array();
                    $response['htmlOptions'] = array('color'=>TbHtml::BUTTON_COLOR_SUCCESS);
                    
                }
                return $response;
            }
        }
        
        public function actionAlertas(){
            $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
            $id_usuario = $_REQUEST['id_usuario'];
            $lat;
            $lng;
            if($usuario != null){
                $response = array();
                $response['title'] = 'No tienes alertas';
                $notificaciones = Notificacion::model()->findAllByAttributes(array('numero_contacto'=>$usuario->numero_telefono, 'estado'=>'1'));
                if($notificaciones != null){
                    $response['title'] = 'Amigos en Peligro!';
                    $response['htmlOptions'] = array('color'=>TbHtml::BUTTON_COLOR_WARNING);
                    $listUser = array();
                    foreach($notificaciones as $notificacion){
                        
                        $user = $notificacion->usuario;
                        $configuracion = $user->configuracion;
                         if($user->numero_telefono == $id_usuario){
                             $lat = $user->latitud;
                             $lng = $user->longitud;
                         }
                        $listUser[] = array(
                            'label'=>$user->nombre.' - '.$user->numero_telefono, 
                            'url'=>'javascript:actionSeguimiento.cargaPunto('.$user->latitud.','.$user->longitud.',"'.$user->nombre.'","'.$user->numero_telefono.'","'.$configuracion->mensaje_alerta.'")'
                            );
                        
                    }
                    $response['labels'] = $listUser;
                }else{
                    
                    $response['labels'] = array();
                    $response['htmlOptions'] = array('color'=>TbHtml::BUTTON_COLOR_SUCCESS);
                    
                }
                $dropdown =  TbHtml::buttonDropdown($response['title'],$response['labels'],$response['htmlOptions']); 
                $response['dropdown'] = $dropdown;
                $response['lat'] = $lat;
                $response['lng'] = $lng;
                echo json_encode($response);
            }
        }
}