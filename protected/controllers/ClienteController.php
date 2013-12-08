<?php

class ClienteController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		$model=new Cliente;
                $a= new Cliente;
                $b= new Usuario;
                $b->idRol=2;
                $a->id_rol=2;
                
                $this->performAjaxValidation(array($a,$b));
                if(isset($_POST['Cliente'],$_POST['Usuario']))           {
                    $a->attributes=$_POST['Cliente'];
                    $b->attributes=$_POST['Usuario'];
                    //$b->idUsuario=$a->idCliente;
                    if($b->save() && $a->save())
                        $this->redirect(array('view','id'=>$a->id_cliente));
                }
                $this->render('create',array('a'=>$a,'b'=>$b));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                /*
		if($this->getPost('Cliente')!=null)
		{
			$model->setAttributes($this->getPost('Cliente'));
                        $model->id_rol=2;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_cliente));
		}

		$this->render('create',array(
			'model'=>$model,
		));
                
                 */
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if($this->getPost('Cliente')!=null)
		{
			$model->setAttributes($this->getPost('Cliente'));
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_cliente));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if($this->getGet('ajax')==null)
			$this->redirect($this->getPost('returnUrl')!=null ? $this->getPost('returnUrl') : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cliente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cliente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cliente']))
			$model->attributes=$_GET['Cliente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
         * 
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cliente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cliente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cliente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if($this->getPost('ajax')!=null && $this->getPost('ajax')==='cliente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        protected function gridDataColumn($data,$row)
        {
             $sql = 'SELECT cupoAprobado FROM credito cr , cliente cl ';
             $sql .= 'WHERE cr.id_cliente='.$data->id_cliente ;
             
             $rows = Yii::app()->db->createCommand($sql)->queryAll();
             //var_dump($rows);
            
             $result = '';
             if(!empty($rows))
                foreach ($rows as $row) 
                {
                 $result = $row['cupoAprobado'];
            }      
            return $result;  
            
        }
}
