<?php

class DetailPenjualanController extends Controller
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
				array(
					  'application.filters.YXssFilter',
					  'clean'   => '*',
					  'tags'    => 'strict',
					  'actions' => 'all'
				)
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
                        /*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
                         * 
                         */
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin', 'index', 'view', 'create','update', 'delete'),
				'users'=>array('@'),
                                //'roles'=>'store_admin'
			),
                        /*
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
                         * 
                         */
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
		$model=new DetailPenjualan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DetailPenjualan']))
		{
			$model->attributes=$_POST['DetailPenjualan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DetailPenjualan']))
		{
			$model->attributes=$_POST['DetailPenjualan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	
		if(isset($_POST['Penjualan']) && ($_POST['Penjualan']['date']!="" || $_POST['Penjualan']['kd_penjualan'])){
			
			if(isset($_POST['Penjualan']['kd_penjualan']) && $_POST['Penjualan']['kd_penjualan']!="" && isset($_POST['Penjualan']['date']) && $_POST['Penjualan']['date']!=""){
				$invoice = str_replace("'", "", $_POST['Penjualan']['kd_penjualan']);
				$tanggal = str_replace("'", "", date('Y-m-d', strtotime($_POST['Penjualan']['date'])));
				
                                $this->redirect("index?invoice=$invoice&date=$tanggal");
			}
			else{
				if(isset($_POST['Penjualan']['kd_penjualan']) && $_POST['Penjualan']['kd_penjualan']!=""){
					$invoice = str_replace("'", "", $_POST['Penjualan']['kd_penjualan']);
                                        
                                        $this->redirect("index?invoice=$invoice");
				}
				else if(isset($_POST['Penjualan']['date']) && $_POST['Penjualan']['date']!=""){
                                    
                                        
                                        
					$tanggal = str_replace("'", "", date('Y-m-d', strtotime($_POST['Penjualan']['date'])));
                                        
                                        $this->redirect("index?date=$tanggal");
				}
			}
			
			
			
		}
                

		else if(isset($_GET['invoice']) || isset($_GET['date'])){
                    if(isset($_GET['invoice']) && $_GET['invoice']!="" && isset($_GET['date']) && $_GET['date']!=""){
                            $invoice = str_replace("'", "", $_GET['invoice']);
                            $tanggal = str_replace("'", "", date('Y-m-d', strtotime($_GET['date'])));

                            $penjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$invoice' and date='$tanggal'"));
                            $detailPenjualan = DetailPenjualan::model()->getAllDetailPenjualanByDateByKdPenjualan($tanggal, $invoice);

                            if($penjualan===null){
                                    Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Data tidak ditemukan.');
                                    $this->redirect(array('index'));
                            }
                            else{
                                    Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Data ditemukan.');
                                    $this->render('index', array('penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan));
                            }
                    }
                    else{
                        
                        if(isset($_GET['invoice']) && $_GET['invoice']!=""){
                                $invoice = str_replace("'", "", $_GET['invoice']);

                                $penjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$invoice'"));
                                $detailPenjualan = DetailPenjualan::model()->getAllDetailPenjualanByKdPenjualan($invoice);

                                if($penjualan===null){
                                        Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Data tidak ditemukan.');
                                        $this->redirect(array('index'));
                                }
                                else{
                                        Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Data ditemukan.');
                                        $this->render('index', array('penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan));
                                }
                        }
                                
                        else if(isset($_GET['date']) && $_GET['date']!=''){

                                $tanggal = str_replace("'", "", date('Y-m-d', strtotime($_GET['date'])));


                                $penjualan = Penjualan::model()->find(array('condition'=>"date='$tanggal'"));
                                $detailPenjualan = DetailPenjualan::model()->getAllDetailPenjualanByDate($tanggal);

                                if($penjualan===null){
                                        Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Data tidak ditemukan.');
                                        $this->redirect(array('index'));
                                }
                                else{
                                        Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Data ditemukan.');
                                        $this->render("index", array('penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan));
                                }

                        }
                    }
                }
                
                else{
                        $penjualan = new Penjualan;
                        $detailPenjualan = DetailPenjualan::model()->getAllDetailPenjualan();
                        $this->render('index', array('penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan));

                }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DetailPenjualan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DetailPenjualan']))
			$model->attributes=$_GET['DetailPenjualan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=DetailPenjualan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='detail-penjualan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
