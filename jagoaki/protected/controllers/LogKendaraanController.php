<?php

class LogKendaraanController extends Controller
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
			*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'admin', 'create','update', 'delete', 'garansi'),
				'users'=>array('@'),
			),
			/*
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
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
		$model=new LogKendaraan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LogKendaraan']))
		{
			$model->attributes=$_POST['LogKendaraan'];
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
		$DetailPenjualan = DetailPenjualan::model()->find(array('condition'=>"log_kendaraan_id='$model->id'"));
		$detailPenjualanAll = DetailPenjualan::model()->findAllByPk($DetailPenjualan->id);
		$Penjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$DetailPenjualan->penjualan_id'"));
		$Customer = Customer::model()->find(array('condition'=>"no_ktp='$Penjualan->customer_id'"));
		
		$DetailKendaraan = DetailKendaraanRequired::model()->find(array('condition'=>"uid='$model->detail_kendaraan_id'"));
		$Kendaraan = KendaraanRequired::model()->find(array('condition'=>"no_mesin='$DetailKendaraan->kendaraan_id'"));
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LogKendaraanRequired']))
		{


                        
                        $ktp = $_POST['Customer']['no_ktp'];
                        $sqlC = 'select * from customer where no_ktp = :no_ktp';
                        $issetCustomer = Customer::model()->findBySql($sqlC, array(':no_ktp'=>$ktp));
                        
                        
                        if($issetCustomer===null){
                            
                            $sqlK = 'select * from kendaraan where no_mesin=:no_mesin limit 1';
                            $issetKendaraan = Kendaraan::model()->findBySql($sqlK, array(':no_mesin'=>$_POST['KendaraanRequired']['no_mesin']));

                                
                            $newCustomer = new Customer;
                            $newDetailKendaraan = new DetailKendaraan;
                            $newKendaraan = new Kendaraan;

                            $model->attributes=$_POST['LogKendaraanRequired'];
                            $newDetailKendaraan->attributes = $_POST['DetailKendaraanRequired'];
                            $newKendaraan->attributes = $_POST['KendaraanRequired'];

                            $newCustomer->attributes = $_POST['Customer'];
                            $newCustomer->no_ktp = $_POST['Customer']['no_ktp'];
                            
                            if($issetKendaraan===null){
                                $newKendaraan->no_mesin = $_POST['KendaraanRequired']['no_mesin'];
                            }
                            else{
                                $newKendaraan->no_mesin = Kendaraan::model()->getMaxRow() . 'MSN';
                            }

                            if($newCustomer->save() && $newKendaraan->save()){
                                $Penjualan->customer_id = $newCustomer->no_ktp;
                                if($Penjualan->save()){

                                    $newDetailKendaraan->customer_id = $Penjualan->customer_id;
                                    $newDetailKendaraan->kendaraan_id = $newKendaraan->no_mesin;
                                    $newDetailKendaraan->uid = $newDetailKendaraan->kendaraan_id . $newDetailKendaraan->customer_id;

                                    if($newDetailKendaraan->save()){
                                        $model->detail_kendaraan_id = $newDetailKendaraan->uid;
                                        if($model->save()){
                                                Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Log kendaraan telah disimpan.');
                                                $this->redirect(array('update','id'=>$model->id));
                                        }
                                    }
                                }
                            }

                            else{
                                    Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Log kendaraan gagal disimpan.');
                            }                            
                        }
			else{
                            
                            $model->attributes=$_POST['LogKendaraanRequired'];
                            $DetailKendaraan->attributes = $_POST['DetailKendaraanRequired'];
                            $Kendaraan->attributes = $_POST['KendaraanRequired'];
                            
                            if($_POST['Customer']['no_ktp']!=$Customer->no_ktp){
                                $sqlC = 'select * from customer where no_ktp=:no_ktp';
                                $Customer = Customer::model()->findBySql($sqlC, array(':no_ktp'=>$_POST['Customer']['no_ktp']));
                            }
                            
                            $Customer->attributes = $_POST['Customer'];
                            
                            if($Customer->save() && $Kendaraan->save()){
                                $Penjualan->customer_id = $Customer->no_ktp;
                                if($Penjualan->save()){
                                    
                                    $DetailKendaraan->customer_id = $Penjualan->customer_id;
                                    $DetailKendaraan->kendaraan_id = $Kendaraan->no_mesin;
                                    $DetailKendaraan->uid = $DetailKendaraan->kendaraan_id . $DetailKendaraan->customer_id;
                                    
                                    if($DetailKendaraan->save()){
                                        $model->detail_kendaraan_id = $DetailKendaraan->uid;
                                        if($model->save()){
                                                Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Log kendaraan telah disimpan.');
                                                $this->redirect(array('update','id'=>$model->id));
                                        }
                                    }
                                    else{
                                        Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Detail kendaraan gagal disimpan.');
                                    }
                                }
                                else{
                                    Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Data penjualan gagal disimpan.');
                                }
                            }
                            else{
                                    Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Customer dan kendaraan gagal disimpan.');
                            }
                        }
		}

		$this->render('update',array(
			'model'=>$model,
			'DetailKendaraan'=>$DetailKendaraan,
			'detailPenjualan'=>$detailPenjualanAll,
			'Kendaraan'=>$Kendaraan,
			'Customer'=>$Customer
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
		$dataProvider=new CActiveDataProvider('LogKendaraan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LogKendaraan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LogKendaraan']))
			$model->attributes=$_GET['LogKendaraan'];

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
		$model=LogKendaraanRequired::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='log-kendaraan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	//
	public function actionGaransi($id){
		
		//total_matrix = MatrixLogKendaraan + MatrixJenisKendaraan + MatrixTahunKendaraan
		//Garansi = Bulan::model()->find(array('condition'=>"matrix='$total_matrix'"));
		
		$model = $this->loadModel($id);
                
                $DetailKendaraan = DetailKendaraan::model()->find(array('condition'=>"uid='$model->detail_kendaraan_id'"));
                
                $Kendaraan = Kendaraan::model()->find(array('condition'=>"no_mesin='$DetailKendaraan->kendaraan_id'"));
		//$Kendaraan = Kendaraan::model()->find(array('condition'=>"no_mesin=".DetailKendaraan::model()->find(array('condition'=>"uid='$model->detail_kendaraan_id)->kendaraan_id)));
		
		$yearNow = substr(date('Y-m-d'),0,4);
		
		
		$yearKendaraan = $yearNow - $Kendaraan->tahun_kendaraan;
		
		//Ambil Matrix berdasarkan Jenis Kendaraan
		$MatrixJenisKendaraan = JenisKendaraan::model()->findByPk($Kendaraan->jenis_kendaraan_id)->matrix;
		
		//Ambil Matrix Berdasarkan Tahun Kendaraan
		if($yearKendaraan > 10)
			$MatrixTahunKendaraan = -1;
		else if($yearKendaraan <= 10)
			$MatrixTahunKendaraan = 0;
			
		//Ambil Matrix Maximal berdasarkan Merk Product
		$MatrixMerkProduct = MerkProduct::model()->matrix(DetailPenjualan::model()->find(array('condition'=>"log_kendaraan_id=$id"))->merk_product_id, $Kendaraan->jenis_kendaraan_id);
		
		//Penentuan perhitungan garansi dengan log kendaraan tersedia
		if(isset($model->masalah->id) && ($Kendaraan->jenis_kendaraan_id == 1 || $Kendaraan->jenis_kendaraan_id==2 || $Kendaraan->jenis_kendaraan_id == 3 || $Kendaraan->jenis_kendaraan_id==4)){
			if($model->masalah->id == 7 ){
			
				//Total Matrix dari log kendaraan
				$MatrixLogKendaraan = $model->beban->matrix + $model->kondisi->matrix + $model->modifikasi->matrix;
				
				//Hitung Bersih Total Matrix
				$total_matrix = $MatrixMerkProduct + $MatrixLogKendaraan + $MatrixJenisKendaraan + $MatrixTahunKendaraan;
				
				$garansi = Bulan::model()->find(array('condition'=>"matrix='$total_matrix'"))->name;

				
			}
			else if($model->masalah->id == 1 or $model->masalah->id == 2){
				$garansi = 3;
			}
			else if($model->masalah->id == 3 or $model->masalah->id == 4 or $model->masalah->id == 5 or $model->masalah->id == 6){
				$garansi = 0;
				
			}
		}
		else{
			if($Kendaraan->jenis_kendaraan_id == 6 OR $Kendaraan->jenis_kendaraan_id===null){
				$garansi = 3;
			}
			else{
				//$total_matrix = $MatrixMerkProduct + $MatrixJenisKendaraan + $MatrixTahunKendaraan;
				//$garansi = Bulan::model()->find(array('condition'=>"matrix='$total_matrix'"))->name;
				$garansi = 0;
			}
		}
		
		$garansi = '0' . $garansi;
		
		//$periode_mulai = date('d-m-Y');
                $periode_mulai = date('d-m-Y', strtotime("now"));
		$day = 3 * 30;
		//$periode_selesai = date('d-m-Y', strtotime($periode_mulai . " +$day days"));
                $periode_selesai = date('d-m-Y', strtotime("+$day day"));
		
		$detailPenjualan = DetailPenjualan::model()->find(array('condition'=>"log_kendaraan_id=$id"));
		$penjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='".$detailPenjualan->penjualan_id."'"));
		$customer = Customer::model()->find(array('condition'=>"no_ktp='".$penjualan->customer_id."'"));
		$kendaraan = Kendaraan::model()->find(array('condition'=>"no_mesin='".DetailKendaraan::model()->findByPk($model->detail_kendaraan_id)->kendaraan_id."'"));
		$detailKendaraan = DetailKendaraan::model()->find(array('condition'=>"uid='".$model->detail_kendaraan_id."'"));

                //
                $logKendaraan = LogKendaraan::model()->findByPk($id);
                $kartuGaransi = new KartuGaransi;
                $kartuGaransi->detail_kendaraan_id = $model->detail_kendaraan_id;
                $kartuGaransi->detail_penjualan_id = $detailPenjualan->id;
                $kartuGaransi->product_id = $detailPenjualan->product_id;
                $kartuGaransi->date_create = date('Y-m-d');
                $kartuGaransi->periode_mulai = date('Y-m-d', strtotime($periode_mulai));
                $kartuGaransi->periode_selesai = date('Y-m-d', strtotime($periode_selesai));
                $kartuGaransi->km_awal = LogKendaraan::model()->findByPk($id)->km_awal;
                
                if($garansi==3){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 5000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                if($garansi==6){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 10000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                if($garansi==9){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 15000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                if($garansi==12){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 20000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                if($garansi==16){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 25000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                if($garansi==20){
                    $kartuGaransi->km_akhir = LogKendaraan::model()->findByPk($id)->km_awal + 30000;
                    $logKendaraan->km_akhir = $kartuGaransi->km_akhir;
                }
                
                $kode_garansi = '';
                $kartuGaransi->status = 1;
                if($kartuGaransi->save() && $logKendaraan->save()){
                        $nkartuGaransi = KartuGaransi::model()->findByPk($kartuGaransi->id);
                        $nkartuGaransi->kode = str_replace('-', '', substr(date('Y-m-d'), 2, 8) . Yii::app()->user->role()->organisation_id . time());
                        $kode_garansi = $nkartuGaransi->kode;
                        $nkartuGaransi->save();
                
        

                
                }
                
                $this->render('garansi', array(
                    'model'=>$model, 
                    'garansi'=>$garansi, 
                    'periode_mulai'=>$periode_mulai, 
                    'periode_selesai'=>$periode_selesai,
                    'detailPenjualan'=>$detailPenjualan,
                    'penjualan'=>$penjualan,
                    'customer'=>$customer,
                    'kendaraan'=>$kendaraan,
                    'detailKendaraan'=>$detailKendaraan,
                    'kodeGaransi'=>$kode_garansi,
                    'logKendaraan'=> LogKendaraan::model()->findByPk($id)
                ));
	}
}
