<?php

class PenjualanController extends Controller
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
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                'actions'=>array(
                                    'index', 
                                    'view', 
                                    'save', 
                                    'admin', 
                                    'kendaraan', 
                                    'totalpenjualan', 
                                    'nonkendaraan', 
                                    'loadmerk', 
                                    'loadproductcategory', 
                                    'loadproducttype', 
                                    'loadproduct', 
                                    'loadnewkendaraan',
                                    'loadnewkendaraanblank',
                                    'cetak', 
                                    'cetakKendaraan', 
                                    'create',
                                    'update', 
                                    'delete',
                                ),
                                'users'=>array('@'),
                                'roles'=>array('store_admin')
                        ),
                    
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('cancel'),
				'users'=>array('@'),
                                'roles'=>array('administrator')
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
        public function actionView()
        {
                $code = $_GET['code'];
                $cust = $_GET['cust'];
                
                $model = $this->findPenjualan($code, $cust);
                
                if($model!==NULL){
                        $model->save = 'yes';
                        $model->save();
                }
                $this->render('view',array(
                        'detailPenjualan'=>  DetailPenjualan::model()->getPenjualanGaransiByInvoice($model->kd_penjualan),
                        //'detailPenjualan'=>DetailPenjualan::model()->findAll(array('with'=>'logKendaraan', 'condition'=>"t.penjualan_id='$model->kd_penjualan' and (logKendaraan.detail_kendaraan_id <> 2 or logKendaraan.detail_kendaraan_id <> null)")),
                        'model'=>$model,
                ));
        }
        
        public function actionCancel(){
            $model = new Penjualan('search');
            
            if(isset($_POST['Penjualan']['kd_penjualan'])){
                
                $invoice = $_POST['Penjualan']['kd_penjualan'];
                
                $sqlP = 'select * from penjualan where kd_penjualan = :kd_penjualan limit 1';
                $issetPenjualan = Penjualan::model()->findBySql($sqlP, array(':kd_penjualan'=>$invoice));
                if($issetPenjualan===null){
                    Yii::app()->user->setFlash('Error', '<strong>Failed!</strong> Kode invoice tidak ditemukan.');
                    $this->redirect(array('cancel'));
                }
                else{
                    $sqlDp = 'select * from detail_penjualan where penjualan_id = :penjualan_id';
                    $DetailPenjualan = DetailPenjualan::model()->findAllBySql($sqlDp, array(':penjualan_id'=>$invoice));
                    if($DetailPenjualan===null){
                       Yii::app()->user->setFlash('Error', '<strong>Failed!</strong> Data detail penjualan kosong.');
                       $this->redirect(array('cancel'));
                    }
                    else{
                        
                        Yii::app()->user->setFlash('Success', "<strong>Success!</strong> Nomor invoice <b>$invoice</b> berhasil dibatalkan.");
                        
                        //update data penjualan
                        $issetPenjualan->status = 0;
                        $issetPenjualan->save();
                        
                        //update data detail penjualan
                        $command = Yii::app()->db->createCommand();
                        $command->update('detail_penjualan', array(
                            'status'=>'0',
                        ), 'penjualan_id=:penjualan_id', array(':penjualan_id'=>$invoice)); 
                        
                        $this->redirect(array('cancel'));
                        
                    }
                }
            }
            $this->render('cancel', array('model'=>$model));
        }

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionSave()
        {		
                $total = 0;
                $code = $_GET['code'];
                $cust = $_GET['cust'];
                
                $model = $this->findPenjualan($code, $cust);
                $detailPenjualan = DetailPenjualan::model()->findAll(array('condition'=>"penjualan_id='$model->kd_penjualan'"));

                foreach($detailPenjualan as $data){
                        $total = $total + $data['total_harga'];
                }
                $model->total = $total;
                if($model->save()){
                        //$this->redirect(array('view', array('code'=>$model->code, 'cust'=>$model->customer_id)));
                    $this->redirect(array('penjualan/view', 'code'=>$model->code, 'cust'=>$model->customer_id));
                }
                        //$this->redirect(array('view','code'=>$model->code&'cust'=>$model->customer_id)));
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

                if(isset($_POST['Penjualan']))
                {
                        $model->attributes=$_POST['Penjualan'];
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

        public function actionIndex(){
            
                        $interupt = false;
                        $parentCodePenjualan = '';
                        
                        $year = date('Y-m-d');
                        $year = substr($year, 2);
                        $year = str_replace('-', '', $year);                        

                        //Action ketika terjadi post penjualan
                        if(isset($_POST['Penjualan']) && isset($_POST['DetailPenjualan']) && isset($_GET['ktp'])){

                                $Penjualan = new Penjualan;
                                $DetailPenjualan = new DetailPenjualan;
                                $LogKendaraan = new LogKendaraan;
                                $DetailKendaraan = new DetailKendaraan;
                                $Customer = new Customer;
                                $Kendaraan = new Kendaraan;

                                $Product = Product::model()->findByPk($_POST['DetailPenjualan']['product_id']);

                                //set attributes models
                                $Penjualan->attributes = $_POST['Penjualan'];
                                $DetailPenjualan->attributes = $_POST['DetailPenjualan'];
                                $LogKendaraan->attributes = $_POST['LogKendaraan'];


                                /*
                                //Penjualan aki dengan kendaraan dan customer yang belum ada dalam sistem / penjualan aki dengan customer selain akun noname
                                */

                                if(isset($_POST['Kendaraan']) && isset($_POST['Customer']) && isset($_POST['Penjualan']) && isset($_POST['DetailKendaraan'])){

                                        $Kendaraan->attributes = $_POST['Kendaraan'];
                                        $Customer->attributes = $_POST['Customer'];
                                        $DetailKendaraan->attributes = $_POST['DetailKendaraan'];

                                        //(int)$_POST['Penjualan']['customer_id'] = (int)$_POST['DetailKendaraan']['customer_id'];

                                        //$cekCustomer = Customer::model()->findByPk((int)$_POST['Penjualan']['customer_id']);
                                        if($_POST['Customer']['no_ktp']!=''){
                                                if($_POST['Kendaraan']['no_mesin']=="" || $_POST['Kendaraan']['no_mesin']=='-'){
                                                        $Kendaraan->no_mesin = time() . 'MSN' . Yii::app()->user->role()->organisation_id;
                                                }
                                                else{
                                                        $Kendaraan->no_mesin = $_POST['Kendaraan']['no_mesin'];
                                                }

                                                if($_POST['Kendaraan']['tahun_kendaraan']==''){
                                                        $Kendaraan->tahun_kendaraan = '0000';
                                                }
                                                else{
                                                        $Kendaraan->tahun_kendaraan = $_POST['Kendaraan']['tahun_kendaraan'];
                                                }

                                                if($Kendaraan->save() && $Customer->save()){

                                                        $DetailKendaraan->kendaraan_id = $Kendaraan->no_mesin;
                                                        $DetailKendaraan->customer_id = $Customer->no_ktp;
                                                        $DetailKendaraan->uid = $DetailKendaraan->kendaraan_id . $DetailKendaraan->customer_id;

                                                        if($_POST['DetailKendaraan']['nopol']=="" || $_POST['DetailKendaraan']['nopol']=='-'){
                                                                $DetailKendaraan->nopol = 'L' . DetailKendaraan::model()->getMaxRow() . 'NPL';
                                                        }
                                                        else{
                                                                $DetailKendaraan->nopol = $_POST['DetailKendaraan']['nopol'];
                                                        }	

                                                        if($DetailKendaraan->save()){
                                                                $LogKendaraan->detail_kendaraan_id = $DetailKendaraan->uid;

                                                                if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                        $LogKendaraan->pegawai_id = 12;
                                                                }else{
                                                                        $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                                }

                                                                $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                                if($LogKendaraan->save()){
                                                                        $Penjualan->customer_id = $Customer->no_ktp;
                                                                        
                                                                        $Penjualan->date = date('Y-m-d');
                                                                        $Penjualan->organisation_id = Yii::app()->user->role()->organisation_id;   
                                                                        $rowCountPenjualan = Penjualan::model()->getRowCountByGerai(Yii::app()->user->role()->organisation_id, date('Y'));

                                                                        if($rowCountPenjualan==10000){
                                                                            $invoiceNumber = '0001';
                                                                        }
                                                                        else{
                                                                            $invoiceNumber = substr(10000 + $rowCountPenjualan, 1);
                                                                        }

                                                                        $newInvoice = 'SIG-' . $year . Yii::app()->user->role()->organisation_id . '-' . $invoiceNumber; 

                                                                        $Penjualan->kd_penjualan = $newInvoice;
                                                                        
                                                                        if($Penjualan->save()){
                                                                                $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                                                $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                        $DetailPenjualan->potongan = 0;
                                                                                }
                                                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                        $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                        if($tipePenjualan==2){
                                                                                            $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                            $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                            if($getDetailPenjualanId===null){
                                                                                                $interupt = true;
                                                                                            }
                                                                                            else{
                                                                                                
                                                                                                $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                                $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);
                                                                                                
                                                                                                $parentCodePenjualan = $getPenjualan->kd_penjualan;
                                                                                                
                                                                                                $getHargaPenjualanLama = $getDetailPenjualan->harga;
                                                                                                
                                                                                                //update kartu garansi lama
                                                                                                $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                                $getKartuGaransi->status = 0;
                                                                                                $getKartuGaransi->save();
                                                                                                
                                                                                            }
                                                                                        }
                                                                                        $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                                }
                                                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                        //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                                        $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                                }
                                                                                else{
                                                                                        $DetailPenjualan->potongan = 0;
                                                                                }

                                                                                // setting harga tergantung dari tipe penjualan
                                                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                    $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                                }
                                                                                else{
                                                                                    $DetailPenjualan->harga = $Product->harga; 
                                                                                }

                                                                                $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                                if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                                    $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                                }  
                                                                                
                                                                                $DetailPenjualan->penjualan_id = $newInvoice;
                                                
                                                                                if($DetailPenjualan->save()){

                                                                                         $mpenjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$Penjualan->kd_penjualan'"));
                                                                                         $mpenjualan->customer_id = $DetailKendaraan->customer_id;                                                                                         
                                                                                         
                                                                                         $mpenjualan->code = md5($mpenjualan->kd_penjualan);
                                                                                         if($_POST['DetailPenjualan']['tipe_penjualan_id']==2){
                                                                                            $mpenjualan->parent_id = $parentCodePenjualan; 
                                                                                         }
                                                                                         else{
                                                                                            $mpenjualan->parent_id = $mpenjualan->kd_penjualan;
                                                                                         }
                                                                                         $mpenjualan->save();
                                                                                         Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                        $this->redirect(array("penjualan/index/", "code"=>"$mpenjualan->code", "cust"=>$mpenjualan->customer_id));
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                        else{
                                                $jenisKendaraan = $_POST['Kendaraan']['jenis_kendaraan_id'];
                                                $nomorMesin = $_POST['Kendaraan']['no_mesin'];
                                                $nomorPolisi = $_POST['DetailKendaraan']['nopol'];
                                                $tahunKendaraan = $_POST['Kendaraan']['tahun_kendaraan'];

                                                //notif user available
                                                //Yii::app()->user->setFlash('Success', '<strong>Oke!</strong> Customer ditemukan.');
                                                if($_POST['Kendaraan']['no_mesin']=="" || $_POST['Kendaraan']['no_mesin']=='-'){
                                                        $Kendaraan->no_mesin = time() . 'MSN' . Yii::app()->user->role()->organisation_id;
                                                }
                                                else{
                                                        $Kendaraan->no_mesin = $_POST['Kendaraan']['no_mesin'];
                                                }

                                                if($_POST['Kendaraan']['tahun_kendaraan']==''){
                                                        $Kendaraan->tahun_kendaraan = '0000';
                                                }
                                                else{
                                                        $Kendaraan->tahun_kendaraan = $_POST['Kendaraan']['tahun_kendaraan'];
                                                }

                                                if(($jenisKendaraan == 1 || $jenisKendaraan == 2 || $jenisKendaraan == 3 || $jenisKendaraan == 4) ){


                                                        if($Kendaraan->save()){
                                                                $DetailKendaraan->kendaraan_id = $Kendaraan->no_mesin;
                                                                $DetailKendaraan->customer_id = $_POST['Penjualan']['customer_id'];
                                                                $DetailKendaraan->uid = $DetailKendaraan->kendaraan_id . $DetailKendaraan->customer_id;

                                                                if($_POST['DetailKendaraan']['nopol']=="" || $_POST['DetailKendaraan']['nopol']=='-'){
                                                                        $DetailKendaraan->nopol = 'L' . DetailKendaraan::model()->getMaxRow() . 'NPL';
                                                                }
                                                                else{
                                                                        $DetailKendaraan->nopol = $_POST['DetailKendaraan']['nopol'];
                                                                }	

                                                                if($DetailKendaraan->save()){
                                                                        $LogKendaraan->detail_kendaraan_id = $DetailKendaraan->uid;

                                                                        if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                                $LogKendaraan->pegawai_id = 12;
                                                                        }else{
                                                                                $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                                        }

                                                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                                        if($LogKendaraan->save()){
                                                                            
                                                                                $Penjualan->customer_id = $_POST['Penjualan']['customer_id'];
                                                                                
                                                                                $Penjualan->date = date('Y-m-d');
                                                                                $Penjualan->organisation_id = Yii::app()->user->role()->organisation_id;   
                                                                                $rowCountPenjualan = Penjualan::model()->getRowCountByGerai(Yii::app()->user->role()->organisation_id, date('Y'));

                                                                                if($rowCountPenjualan==10000){
                                                                                    $invoiceNumber = '0001';
                                                                                }
                                                                                else{
                                                                                    $invoiceNumber = substr(10000 + $rowCountPenjualan, 1);
                                                                                }

                                                                                $newInvoice = 'SIG-' . $year . Yii::app()->user->role()->organisation_id . '-' . $invoiceNumber; 

                                                                                $Penjualan->kd_penjualan = $newInvoice;
                                                                                
                                                                                if($Penjualan->save()){
                                                                                        $DetailPenjualan->penjualan_id = $Penjualan->id;
                                                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                                $DetailPenjualan->potongan = 0;
                                                                                        }
                                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                            $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                            if($tipePenjualan==2){
                                                                                                $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                                $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                                if($getDetailPenjualanId===null){
                                                                                                    $interupt = true;
                                                                                                }
                                                                                                else{
                                                                                                    
                                                                                                    $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                                    $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                                                    $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                                                    $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                                                    //update kartu garansi lama
                                                                                                    $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                                    $getKartuGaransi->status = 0;
                                                                                                    $getKartuGaransi->save();

                                                                                                }
                                                                                            }
                                                                                            $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                                        }
                                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                                //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                                        }
                                                                                        else{
                                                                                                $DetailPenjualan->potongan = 0;
                                                                                        }

                                                                                        // setting harga tergantung dari tipe penjualan
                                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                                        }
                                                                                        else{
                                                                                            $DetailPenjualan->harga = $Product->harga; 
                                                                                        }

                                                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                                        }                                                                                      

                                                                                        $DetailPenjualan->penjualan_id = $newInvoice;                                                                                        
                                                
                                                                                        if($DetailPenjualan->save()){

                                                                                                 $mpenjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$Penjualan->kd_penjualan'"));
                                                                                                 $mpenjualan->customer_id = $DetailKendaraan->customer_id;

                                                                                                 
                                                                                                 $mpenjualan->code = md5($mpenjualan->kd_penjualan);
                                                                                                 if($_POST['DetailPenjualan']['tipe_penjualan_id']==2){
                                                                                                     $mpenjualan->parent_id = $parentCodePenjualan;
                                                                                                 }
                                                                                                 else{
                                                                                                    $mpenjualan->parent_id = $mpenjualan->kd_penjualan;
                                                                                                 }
                                                                                                 $mpenjualan->save();
                                                                                                 Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                                 $this->redirect(array("penjualan/index/", "code"=>"$mpenjualan->code", "cust"=>$mpenjualan->customer_id));
                                                                                        }
                                                                                }
                                                                        }
                                                                }

                                                        }


                                                }else{
                                                                        //Penjualan Dengan Customer Tersedia
                                                                        //
                                                                        //filtering nopol adalah untuk membedakan apakah kasir telah menghilangkan form new kendaraan atau tidak
                                                                        //Hilang / munculnya form new kendaraan disebabkan oleh hal berikut : 
                                                                        //nopol dengan nilai kosong maka kasir telah menggunakan akun customer noname, 
                                                                        //sedangkan nopol dengan nilai "-" maka kasir menggunakan aku customer teregistrasi dengan menghilangkan form new kendaraan (memilih kendaraan yang dimiliki oleh customer)

                                                                        if(isset($_POST['LogKendaraan']['detail_kendaraan_id']) && $_POST['LogKendaraan']['detail_kendaraan_id']!=""){
                                                                                $LogKendaraan->detail_kendaraan_id = 1; //$_POST['LogKendaraan']['detail_kendaraan_id'];
                                                                        }
                                                                        else{
                                                                                if($jenisKendaraan == 5){
                                                                                        $LogKendaraan->detail_kendaraan_id = 200000;
                                                                                }
                                                                                else if($jenisKendaraan == 6){
                                                                                        $LogKendaraan->detail_kendaraan_id = 300000;
                                                                                }
                                                                                else{
                                                                                        $LogKendaraan->detail_kendaraan_id = 100000;
                                                                                }
                                                                        }

                                                                        if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                                $LogKendaraan->pegawai_id = 12; //penjaga nilai ketika transaksi yang terjadi adalah jenis transaksi yang tanpa menginputkan log kendaraan
                                                                        }else{
                                                                                $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                                        }




                                                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                                        if($LogKendaraan->save()){
                                                                            
                                                                                $Penjualan->customer_id = $_POST['Penjualan']['customer_id'];

                                                                                $Penjualan->date = date('Y-m-d');
                                                                                $Penjualan->organisation_id = Yii::app()->user->role()->organisation_id;   
                                                                                $rowCountPenjualan = Penjualan::model()->getRowCountByGerai(Yii::app()->user->role()->organisation_id, date('Y'));

                                                                                if($rowCountPenjualan==10000){
                                                                                    $invoiceNumber = '0001';
                                                                                }
                                                                                else{
                                                                                    $invoiceNumber = substr(10000 + $rowCountPenjualan, 1);
                                                                                }

                                                                                $newInvoice = 'SIG-' . $year . Yii::app()->user->role()->organisation_id . '-' . $invoiceNumber; 

                                                                                $Penjualan->kd_penjualan = $newInvoice;
                                                                        
                                                                                if($Penjualan->save()){
                                                                                        $DetailPenjualan->penjualan_id = $Penjualan->id;
                                                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                                $DetailPenjualan->potongan = 0;
                                                                                        }
                                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                            $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                            if($tipePenjualan==2){
                                                                                                $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                                $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                                if($getDetailPenjualanId===null){
                                                                                                    $interupt = true;
                                                                                                }
                                                                                                else{

                                                                                                    $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                                    $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                                                    $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                                                    $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                                                    //update kartu garansi lama
                                                                                                    $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                                    $getKartuGaransi->status = 0;
                                                                                                    $getKartuGaransi->save();

                                                                                                    //$sumNewDetailPenjualan = DetailPenjualan::model()->findBySql("select sum(total_harga) from detail_penjualan where penjualan_id='$getDetailPenjualan->penjualan_id'", array());
                                                                                                }
                                                                                            }
                                                                                            $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                                        }
                                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                                //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                                        }
                                                                                        else{
                                                                                                $DetailPenjualan->potongan = 0;
                                                                                        }

                                                                                        // setting harga tergantung dari tipe penjualan
                                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                                        }
                                                                                        else{
                                                                                            $DetailPenjualan->harga = $Product->harga; 
                                                                                        }

                                                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;
                                                                                        
                                                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                                        }                                                                                           

                                                                                        $DetailPenjualan->penjualan_id = $newInvoice;
                                                                                
                                                                                        if($DetailPenjualan->save()){

                                                                                                 $mpenjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$Penjualan->kd_penjualan'"));
                                                                                                 //$mpenjualan->customer_id = $DetailKendaraan->customer_id;
                                                                                                 

                                                                                                 
                                                                                                    
                                                                                                 $mpenjualan->code = md5($mpenjualan->kd_penjualan);
                                                                                                 
                                                                                                 if($_POST['DetailPenjualan']['tipe_penjualan_id']==2){
                                                                                                     $mpenjualan->parent_id = $parentCodePenjualan;
                                                                                                 }
                                                                                                 else{
                                                                                                     $mpenjualan->parent_id = $mpenjualan->kd_penjualan;
                                                                                                 }
                                                                                                 
                                                                                                 $mpenjualan->save();
                                                                                                 Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                                 $this->redirect(array("penjualan/index/", "code"=>"$mpenjualan->code", "cust"=>$mpenjualan->customer_id));
                                                                                        }
                                                                                }
                                                                        }


                                                                //

                                                }

                                        }
                                }

                                /*
                                        Penjualan aki, kendaraan dan customer sudah tersedia dalam sistem / penjualan aki dengan akun noname
                                */
                                else{

                                        $productCategory = $_POST['DetailPenjualan']['product_category_id'];

                                        if($productCategory == 1 or $productCategory == 2){

                                                        //Penjualan Aki
                                                if($_POST['LogKendaraan']['detail_kendaraan_id']==''){
                                                         Yii::app()->user->setFlash('Error', '<strong>Gagal!</strong> Transaksi gagal dilakukan karena kendaraan belum dipilih.');
                                                         if(isset($_GET['ktp']) && $_GET['ktp']!=""){
                                                                $this->redirect(array("penjualan/index/", "ktp"=>$_GET['ktp']));
                                                         }
                                                         else{
                                                                $this->redirect(array("penjualan/index/", "code"=>$_GET['code'], "cust"=>$_GET['cust']));
                                                         }
                                                }
                                                else{

                                                        if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                $LogKendaraan->pegawai_id = 12;
                                                        }else{
                                                                $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                        }
                                                        if(isset($_POST['LogKendaraan']['detail_kendaraan_id']) && $_POST['LogKendaraan']['detail_kendaraan_id']!=""){
                                                                $LogKendaraan->detail_kendaraan_id = $_POST['LogKendaraan']['detail_kendaraan_id'];
                                                        }
                                                        else{
                                                                if($jenisKendaraan == 5){
                                                                        $LogKendaraan->detail_kendaraan_id = 200000;
                                                                }
                                                                else if($jenisKendaraan == 6){
                                                                        $LogKendaraan->detail_kendaraan_id = 300000;
                                                                }
                                                                else{
                                                                        $LogKendaraan->detail_kendaraan_id = 100000;
                                                                }
                                                        }
                                                                        
                                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                        
                                                        if($LogKendaraan->save()){
                                                            
                                                                $Penjualan->customer_id = $_POST['Penjualan']['customer_id'];
                                                                
                                                                $Penjualan->date = date('Y-m-d');
                                                                $Penjualan->organisation_id = Yii::app()->user->role()->organisation_id;   
                                                                $rowCountPenjualan = Penjualan::model()->getRowCountByGerai(Yii::app()->user->role()->organisation_id, date('Y'));

                                                                if($rowCountPenjualan==10000){
                                                                    $invoiceNumber = '0001';
                                                                }
                                                                else{
                                                                    $invoiceNumber = substr(10000 + $rowCountPenjualan, 1);
                                                                }

                                                                $newInvoice = 'SIG-' . $year . Yii::app()->user->role()->organisation_id . '-' . $invoiceNumber; 

                                                                $Penjualan->kd_penjualan = $newInvoice;
                                                                        
                                                                if($Penjualan->save()){

                                                                        $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                if($tipePenjualan==2){
                                                                                    $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                    $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                    if($getDetailPenjualanId===null){
                                                                                        $interupt = true;
                                                                                    }
                                                                                    else{

                                                                                        $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                        $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                                        $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                                        $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                                        //update kartu garansi lama
                                                                                        $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                        $getKartuGaransi->status = 0;
                                                                                        $getKartuGaransi->save();

                                                                                        //$sumNewDetailPenjualan = DetailPenjualan::model()->findBySql("select sum(total_harga) from detail_penjualan where penjualan_id='$getDetailPenjualan->penjualan_id'", array());
                                                                                    }
                                                                                }
                                                                                $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else{
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        
                                                                        // setting harga tergantung dari tipe penjualan
                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                        }
                                                                        else{
                                                                            $DetailPenjualan->harga = $Product->harga; 
                                                                        }
                                                                        
                                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                        }
                                                                          

                                                                        $DetailPenjualan->penjualan_id = $newInvoice;
                                                                                

                                                                        if($DetailPenjualan->save()){

                                                                                 $mpenjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$Penjualan->kd_penjualan'"));


                                                                                
                                                                         
                                                                                 $mpenjualan->code = md5($mpenjualan->kd_penjualan);
                                                                                 
                                                                                 if($_POST['DetailPenjualan']['tipe_penjualan_id']==2){
                                                                                     $mpenjualan->parent_id = $parentCodePenjualan;
                                                                                 }
                                                                                 else{
                                                                                    $mpenjualan->parent_id = $mpenjualan->kd_penjualan;
                                                                                 }
                                                                                 $mpenjualan->save();
                                                                                 Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                 $this->redirect(array("penjualan/index/", "code"=>"$mpenjualan->code", "cust"=>$mpenjualan->customer_id));
                                                                        }
                                                                }
                                                        }        
                                                }

                                        }
                                        else{
                                                        //Penjualan NON AKI
                                                        $Penjualan->customer_id = $_POST['Penjualan']['customer_id'];
                                                        $Penjualan->date = date('Y-m-d');
                                                        $Penjualan->organisation_id = Yii::app()->user->role()->organisation_id;   
                                                        $rowCountPenjualan = Penjualan::model()->getRowCountByGerai(Yii::app()->user->role()->organisation_id, date('Y'));

                                                        if($rowCountPenjualan==10000){
                                                            $invoiceNumber = '0001';
                                                        }
                                                        else{
                                                            $invoiceNumber = substr(10000 + $rowCountPenjualan, 1);
                                                        }

                                                        $newInvoice = 'SIG-' . $year . Yii::app()->user->role()->organisation_id . '-' . $invoiceNumber; 
                                                        
                                                        $Penjualan->kd_penjualan = $newInvoice;
                                                        
                                                        if($Penjualan->save()){

                                                                $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                                $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                        $DetailPenjualan->potongan = 0;
                                                                }
                                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                        $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                        if($tipePenjualan==2){
                                                                            $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                            $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                            if($getDetailPenjualanId===null){
                                                                                $interupt = true;
                                                                            }
                                                                            else{

                                                                                $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                                $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                                $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                                //update kartu garansi lama
                                                                                $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                $getKartuGaransi->status = 0;
                                                                                $getKartuGaransi->save();

                                                                                //$sumNewDetailPenjualan = DetailPenjualan::model()->findBySql("select sum(total_harga) from detail_penjualan where penjualan_id='$getDetailPenjualan->penjualan_id'", array());
                                                                            }
                                                                        }
                                                                        $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                }
                                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                        //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                        $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                }
                                                                else{
                                                                        $DetailPenjualan->potongan = 0;
                                                                }

                                                                // setting harga tergantung dari tipe penjualan
                                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                    $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                }
                                                                else{
                                                                    $DetailPenjualan->harga = $Product->harga; 
                                                                }

                                                                $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                    $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                }

    

                                                                $DetailPenjualan->penjualan_id = $newInvoice;
                                                                                
                                                                if($DetailPenjualan->save()){


                                                                         $mpenjualan = Penjualan::model()->find(array('condition'=>"kd_penjualan='$Penjualan->kd_penjualan'"));                                                                         

                                                                         
                                                                         
                                                                         $mpenjualan->code = md5($mpenjualan->kd_penjualan);
                                                                         
                                                                         if($_POST['DetailPenjualan']['tipe_penjualan_id']==2){
                                                                             $mpenjualan->parent_id = $parentCodePenjualan;
                                                                         }
                                                                         else{
                                                                            $mpenjualan->parent_id = $mpenjualan->kd_penjualan;
                                                                         }

                                                                         $mpenjualan->save();
                                                                         Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                         $this->redirect(array("penjualan/index/", "code"=>"$mpenjualan->code", "cust"=>$mpenjualan->customer_id));
                                                                }
                                                        }
                                        }

                                }
                        }

                //Controll redirect setelah submit pertama
                else if(isset($_GET['code']) && $_GET['code']!='' && isset($_GET['cust']) && $_GET['cust']!=''){

                        $code = $_GET['code'];
                        $cust = $_GET['cust'];
                        $Penjualan = $this->findPenjualan($code, $cust);


                        if(isset($_POST['Penjualan']) && isset($_POST['DetailPenjualan']) && isset($_POST['Kendaraan'])){
                            


                                $DetailPenjualan = new DetailPenjualan;
                                $LogKendaraan = new LogKendaraan;
                                $DetailKendaraan = new DetailKendaraan;
                                $Kendaraan = new Kendaraan;



                                $Kendaraan->attributes = $_POST['Kendaraan'];
                                $DetailPenjualan->attributes = $_POST['DetailPenjualan'];
                                $LogKendaraan->attributes = $_POST['LogKendaraan'];
                                
                                $DetailKendaraan->attributes = $_POST['DetailKendaraan'];

                                $Product = Product::model()->findByPk($_POST['DetailPenjualan']['product_id']);

                                //(int)$_POST['Penjualan']['customer_id'] = $_POST['Penjualan']['customer_id'];

                                $jenisKendaraan = $_POST['Kendaraan']['jenis_kendaraan_id'];
                                $nomorMesin = $_POST['Kendaraan']['no_mesin'];
                                $nomorPolisi = $_POST['DetailKendaraan']['nopol'];
                                $tahunKendaraan = $_POST['Kendaraan']['tahun_kendaraan'];

                                if($_POST['Kendaraan']['no_mesin']=="" || $_POST['Kendaraan']['no_mesin']=='-'){
                                        $Kendaraan->no_mesin = time() . 'MSN' . Yii::app()->user->role()->organisation_id;
                                }
                                else{
                                        $Kendaraan->no_mesin = $_POST['Kendaraan']['no_mesin'];
                                }

                                if($_POST['Kendaraan']['tahun_kendaraan']==''){
                                        $Kendaraan->tahun_kendaraan = '0000';
                                }
                                else{
                                        $Kendaraan->tahun_kendaraan = $_POST['Kendaraan']['tahun_kendaraan'];
                                }

                                if($jenisKendaraan == 1 || $jenisKendaraan == 2 || $jenisKendaraan == 3 || $jenisKendaraan == 4){

                                        if($Kendaraan->save()){

                                                $DetailKendaraan->kendaraan_id = $Kendaraan->no_mesin;
                                                $DetailKendaraan->customer_id = $_POST['Penjualan']['customer_id'];
                                                $DetailKendaraan->uid = $DetailKendaraan->kendaraan_id . $DetailKendaraan->customer_id;

                                                if($_POST['DetailKendaraan']['nopol']=="" || $_POST['DetailKendaraan']['nopol']=='-'){
                                                        $DetailKendaraan->nopol = 'L' . DetailKendaraan::model()->getMaxRow() . 'NPL';
                                                }
                                                else{
                                                        $DetailKendaraan->nopol = $_POST['DetailKendaraan']['nopol'];
                                                }						

                                                if($DetailKendaraan->save()){

                                                        $LogKendaraan->detail_kendaraan_id = $DetailKendaraan->uid;

                                                        if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                $LogKendaraan->pegawai_id = 12;
                                                        }else{
                                                                $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                        }

                                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                        if($LogKendaraan->save()){
                                                                        $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                if($tipePenjualan==2){
                                                                                    $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                    $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                    if($getDetailPenjualanId===null){
                                                                                        $interupt = true;
                                                                                    }
                                                                                    else{

                                                                                        $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                        $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                                        $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                                        $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                                        //update kartu garansi lama
                                                                                        $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                        $getKartuGaransi->status = 0;
                                                                                        $getKartuGaransi->save();

                                                                                        //$sumNewDetailPenjualan = DetailPenjualan::model()->findBySql("select sum(total_harga) from detail_penjualan where penjualan_id='$getDetailPenjualan->penjualan_id'", array());
                                                                                    }
                                                                                }
                                                                                $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else{
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        
                                                                        // setting harga tergantung dari tipe penjualan
                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                        }
                                                                        else{
                                                                            $DetailPenjualan->harga = $Product->harga; 
                                                                        }
                                                                        
                                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                        }

                                                                        if($DetailPenjualan->save()){
                                                                                Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                $this->redirect(array("penjualan/index/",  "code"=>$code, "cust"=>$cust));
                                                                        }
                                                        }
                                                }

                                        }

                                }else{
                                                        //controll ketika user menghilangkan form new kendaraan
                                                        //filtering nopol adalah untuk membedakan apakah kasir telah menghilangkan form new kendaraan atau tidak
                                                        //Hilang / munculnya form new kendaraan disebabkan oleh hal berikut : 
                                                        //nopol dengan nilai kosong maka kasir telah menggunakan akun customer noname, 
                                                        //sedangkan nopol dengan nilai "-" maka kasir menggunakan aku customer teregistrasi dengan menghilangkan form new kendaraan (memilih kendaraan yang dimiliki oleh customer)

                                                        if(isset($_POST['LogKendaraan']['detail_kendaraan_id']) && $_POST['LogKendaraan']['detail_kendaraan_id']!=""){
                                                                $LogKendaraan->detail_kendaraan_id = $_POST['LogKendaraan']['detail_kendaraan_id'];
                                                        }
                                                        else{
                                                                if($jenisKendaraan == 5){
                                                                        $LogKendaraan->detail_kendaraan_id = 200000;
                                                                }
                                                                else if($jenisKendaraan == 6){
                                                                        $LogKendaraan->detail_kendaraan_id = 300000;
                                                                }
                                                                else{
                                                                        $LogKendaraan->detail_kendaraan_id = 100000;
                                                                }
                                                        }

                                                        if($_POST['LogKendaraan']['pegawai_id']==""){
                                                                $LogKendaraan->pegawai_id = 12; //penjaga nilai ketika transaksi yang terjadi adalah jenis transaksi yang tanpa menginputkan log kendaraan
                                                        }else{
                                                                $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                                        }
                                                        
                                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; 
                                                        if($LogKendaraan->save()){
                                                            
                                                                        $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;


                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                                $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                                if($tipePenjualan==2){
                                                                                    $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                                    $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                                    if($getDetailPenjualanId===null){
                                                                                        $interupt = true;
                                                                                    }
                                                                                    else{

                                                                                                $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                                                $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);
                                                                                                
                                                                                                $parentCodePenjualan = $getPenjualan->kd_penjualan;
                                                                                                
                                                                                                $getHargaPenjualanLama = $getDetailPenjualan->harga;
                                                                                                
                                                                                                //update kartu garansi lama
                                                                                                $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                                                $getKartuGaransi->status = 0;
                                                                                                $getKartuGaransi->save();
                                                                                    }
                                                                                }
                                                                                $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                                        }
                                                                        else{
                                                                                $DetailPenjualan->potongan = 0;
                                                                        }
                                                                        
                                                                        // setting harga tergantung dari tipe penjualan
                                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                                        }
                                                                        else{
                                                                            $DetailPenjualan->harga = $Product->harga; 
                                                                        }
                                                                        
                                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                                        }

                                                                        if($DetailPenjualan->save()){
                                                                                Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                                $this->redirect(array("penjualan/index/",  "code"=>$code, "cust"=>$cust));
                                                                        }
                                                        }
                                                        
                                                //

                                }
                        }

                        else if(isset($_POST['Penjualan']) && isset($_POST['DetailPenjualan'])){
                            
                                $DetailPenjualan = new DetailPenjualan;

                                $Product = Product::model()->findByPk($_POST['DetailPenjualan']['product_id']);

                                
                                $DetailPenjualan->attributes = $_POST['DetailPenjualan'];


                                if(isset($_POST['LogKendaraan']['pegawai_id']) && $_POST['LogKendaraan']['pegawai_id']!=""){
                                        $LogKendaraan = new LogKendaraan;
                                        
                                        $LogKendaraan->attributes = $_POST['LogKendaraan'];
                                        $LogKendaraan->pegawai_id = (int)$_POST['LogKendaraan']['pegawai_id'];
                                        
                                        if(isset($_POST['LogKendaraan']['detail_kendaraan_id']) && $_POST['LogKendaraan']['detail_kendaraan_id']!=""){
                                                $LogKendaraan->detail_kendaraan_id = $_POST['LogKendaraan']['detail_kendaraan_id'];
                                        }
                                        else{
                                                if($jenisKendaraan == 5){
                                                        $LogKendaraan->detail_kendaraan_id = 200000;
                                                }
                                                else if($jenisKendaraan == 6){
                                                        $LogKendaraan->detail_kendaraan_id = 300000;
                                                }
                                                else{
                                                        $LogKendaraan->detail_kendaraan_id = 100000;
                                                }
                                        }
                                        
                                        $LogKendaraan->logKendaraanId = time() . 'LOGKID' . Yii::app()->user->role()->organisation_id; if($LogKendaraan->save()){
                                                        $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;
                                                        $DetailPenjualan->log_kendaraan_id = $LogKendaraan->id;

                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                                $DetailPenjualan->potongan = 0;
                                                        }
                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                                $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                                if($tipePenjualan==2){
                                                                    $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                                    $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                                    if($getDetailPenjualanId===null){
                                                                        $interupt = true;
                                                                    }
                                                                    else{

                                                                        $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                                        $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                                        $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                                        $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                                        //update kartu garansi lama
                                                                        $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                                        $getKartuGaransi->status = 0;
                                                                        $getKartuGaransi->save();
                                                                    }
                                                                }
                                                                $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                        }
                                                        else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                                $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95  * (int)$_POST['DetailPenjualan']['jumlah'];
                                                        }
                                                        else{
                                                                $DetailPenjualan->potongan = 0;
                                                        }

                                                        // setting harga tergantung dari tipe penjualan
                                                        if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                            $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                        }
                                                        else{
                                                            $DetailPenjualan->harga = $Product->harga; 
                                                        }

                                                        $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                        if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                            $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                        }									

                                                        if($DetailPenjualan->save()){
                                                                Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                                $this->redirect(array("penjualan/index/",  "code"=>$code, "cust"=>$cust));
                                                        }
                                        }
                                        
                                                
                                }
                                else{

                                                $DetailPenjualan->penjualan_id = $Penjualan->kd_penjualan;

                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '1'){
                                                        $DetailPenjualan->potongan = 0;
                                                }
                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '2' OR $_POST['DetailPenjualan']['tipe_penjualan_id'] == '3'){
                                                    $tipePenjualan = $_POST['DetailPenjualan']['tipe_penjualan_id'];
                                                    if($tipePenjualan==2){
                                                        $kodeGaransi = $_POST['DetailPenjualan']['kode_garansi'];
                                                        $getDetailPenjualanId = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"))->detail_penjualan_id;
                                                        if($getDetailPenjualanId===null){
                                                            $interupt = true;
                                                        }
                                                        else{

                                                            $getDetailPenjualan = DetailPenjualan::model()->findByPk($getDetailPenjualanId);
                                                            $getPenjualan = Penjualan::model()->findByPk(DetailPenjualan::model()->find(array('condition'=>"id='$getDetailPenjualanId'"))->penjualan_id);

                                                            $parentCodePenjualan = $getPenjualan->kd_penjualan;

                                                            $getHargaPenjualanLama = $getDetailPenjualan->harga;

                                                            //update kartu garansi lama
                                                            $getKartuGaransi = KartuGaransi::model()->find(array('condition'=>"kode='$kodeGaransi'"));
                                                            $getKartuGaransi->status = 0;
                                                            $getKartuGaransi->save();
                                                        }
                                                    }
                                                    $DetailPenjualan->potongan = $Product->harga * $_POST['DetailPenjualan']['jumlah'];
                                                }
                                                else if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                        //$DetailPenjualan->potongan = $Product->harga * 0.05  * $_POST['DetailPenjualan']['jumlah'];
                                                        $DetailPenjualan->potongan = (int)$_POST['DetailPenjualan']['harga'] * 0.95 * (int)$_POST['DetailPenjualan']['jumlah'];
                                                }
                                                else{
                                                        $DetailPenjualan->potongan = 0;
                                                }

                                                // setting harga tergantung dari tipe penjualan
                                                if($_POST['DetailPenjualan']['tipe_penjualan_id'] == '4'){
                                                    $DetailPenjualan->harga = (int)$_POST['DetailPenjualan']['harga'];
                                                }
                                                else{
                                                    $DetailPenjualan->harga = $Product->harga; 
                                                }

                                                $DetailPenjualan->total_harga = $_POST['DetailPenjualan']['jumlah'] * $DetailPenjualan->harga - $DetailPenjualan->potongan;

                                                if(isset($_POST['DetailPenjualan']['tanggal_produksi']) && $_POST['DetailPenjualan']['tanggal_produksi']!=''){
                                                    $DetailPenjualan->tanggal_produksi = date('Y-m-d', strtotime($_POST['DetailPenjualan']['tanggal_produksi']));
                                                }							

                                                if($DetailPenjualan->save()){
                                                        Yii::app()->user->setFlash('Success', '<strong>Success!</strong> Transaksi berhasil dilakukan.');
                                                        $this->redirect(array("penjualan/index/",  "code"=>$code, "cust"=>$cust));
                                                }
                                        
                                        
                                }
                        }


                        $code = $_GET['code'];

                        $cust = $_GET['cust'];

                        $CurrPenjualan = $this->findPenjualan($code, $cust);

                        $customer_id = $CurrPenjualan->customer_id;
                        $sqlC = 'select * from customer where no_ktp=:no_ktp limit 1';
                        $CurrCustomer = Customer::model()->findBySql($sqlC, array(':no_ktp'=>$customer_id));
                        $CurrDetailPenjualan = new DetailPenjualan;
                        $CurrLogKendaraan = new LogKendaraan;

                        $daftarKendaraan = DetailKendaraan::model()->findAll(array('condition'=>"customer_id='$cust'"));
                        
                        
                        $this->render('index', array(
                                                'customer'=>$CurrCustomer,
                                                'penjualan'=>$CurrPenjualan,
                                                'detailPenjualan'=>$CurrDetailPenjualan,
                                                'logKendaraan'=>$CurrLogKendaraan,
                                                "daftarKendaraan"=>$daftarKendaraan,
                                        ));
                        
                }

                else{

                        if(isset($_GET['ktp']) && $_GET['ktp']!=""){

                                if(isset($_POST['Kendaraan']['no_mesin'])){
                                        $no_mesin = $_POST['Kendaraan']['no_mesin'];
                                        $this->redirect(array('/penjualan/index?no='.$no_mesin));
                                }
                                if(isset($_POST['Customer']['no_ktp'])){
                                        $no_ktp = $_POST['Customer']['no_ktp'];
                                        $this->redirect(array('/penjualan/index?ktp='.$no_ktp));
                                }

                                $ktp = $_GET['ktp'];
                                $customer = Customer::model()->find(array('condition'=>"no_ktp='$ktp'"));
                                //
                                $penjualan = new Penjualan;
                                $detailPenjualan = new DetailPenjualan;
                                $logKendaraan = new LogKendaraan;
                                //

                                if($customer===null){
                                        $mDetailKendaraan = new DetailKendaraan;
                                        $mCustomer = new Customer;
                                        $mKendaraan = new Kendaraan;
                                        $this->render('index', array('ktp'=>$ktp,'detailKendaraan'=>$mDetailKendaraan, 'kendaraan'=>$mKendaraan, 'customer'=>$mCustomer, 'penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan, 'logKendaraan'=>$logKendaraan));

                                }
                                else{
                                        $daftarKendaraan = DetailKendaraan::model()->findAll(array('condition'=>"customer_id='$customer->no_ktp'"));

                                        $detailKendaraan = DetailKendaraan::model()->find(array('order'=>'id desc', 'condition'=>"customer_id='$customer->no_ktp'"));
                                        
                                        if($detailKendaraan===null){
                                            $mDetailKendaraan = new DetailKendaraan;
                                            $mKendaraan = new Kendaraan;
                                            $mCustomer = Customer::model()->find(array('condition'=>"no_ktp='$ktp'"));
                                        }
                                        else{
                                            $mDetailKendaraan = $this->findDetailKendaraan($detailKendaraan->id);                                        
                                            $mKendaraan = $this->findKendaraan($mDetailKendaraan->kendaraan_id);
                                            $mCustomer = $this->findCustomer($detailKendaraan->customer_id);
                                        }
                                        $this->render('index', array('daftarKendaraan'=>$daftarKendaraan, 'ktp'=>$ktp, 'detailKendaraan'=>$mDetailKendaraan, 'kendaraan'=>$mKendaraan, 'customer'=>$mCustomer, 'penjualan'=>$penjualan, 'detailPenjualan'=>$detailPenjualan, 'logKendaraan'=>$logKendaraan));

                                }


                        }
                        else{
                                throw new CHttpException(404,'The requested page does not exist.');
                        }
                 }
        }

        public function actionLoadnewkendaraan(){
                $this->renderPartial('newkendaraan');
        }

        public function actionLoadnewkendaraanblank(){
                $this->renderPartial('newkendaraanblank');
        }
        
        
        public function actionTotalpenjualan(){
            
            if(isset($_GET['kd_penjualan']) && $_GET['kd_penjualan']!='' && Yii::app()->request->isAjaxRequest){
                $kd_penjualan = $_GET['kd_penjualan'];
                $total = 0;
                $sqlP = 'select * from detail_penjualan where penjualan_id= :kd_penjualan';
                $DetailPenjualan = DetailPenjualan::model()->findAllBySql($sqlP, array(':kd_penjualan'=>$kd_penjualan));
                foreach ($DetailPenjualan as $data){
                    $total = $total + $data['total_harga'];
                }
                   
                $this->renderPartial('total_penjualan', array('total'=>$total));
            }
            else{
                throw new CHttpException(404,'The requested page does not exist.');
            }

        }
        
   

		/**
		 * Manages all models.
		 */
		public function actionAdmin()
		{
			$model=new Penjualan('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Penjualan']))
				$model->attributes=$_GET['Penjualan'];

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
			$model=Penjualan::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
			
		public function findPenjualan($code, $cust)
		{
                        //secure query
                        $sql = "select * from penjualan where code = :code AND customer_id = :cust";
                        //prevent sql injection
			$model=Penjualan::model()->with('customer')->findBySql($sql, array(':code'=>$code, ':cust'=>$cust));
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
			
		public function findDetailkendaraan($id)
		{
			$model=  DetailKendaraan::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
			
		public function findKendaraan($id)
		{
                        $sqlK = 'select * from kendaraan where no_mesin=:no_mesin';
			$model=  Kendaraan::model()->findBySql($sqlK, array(':no_mesin'=>$id));
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
			
		public function findCustomer($id)
		{
                        $sqlC = 'select * from customer where no_ktp=:no_ktp limit 1';
			$model=  Customer::model()->findBySql($sqlC, array(':no_ktp'=>$id));
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
			
		public function findLogkendaraan($id)
		{
			$model= LogKendaraan::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
        
        public function actionLoadmerk()
        {
           $id = (int)$_GET['cat'];
           unset(Yii::app()->session['cat']);
           Yii::app()->session['cat'] = $id;
           
           $data= Product::model()->findAll(array('with'=>'merkProduct','condition'=>"t.product_category_id='$id'"));

           $data=CHtml::listData($data,'merkProduct.id','merkProduct.name');

           echo "<option value=''>Pilih Merk</option>";
           foreach($data as $value=>$name)
           echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
           
        }
        
        public function actionLoadproduct()
        {
           if($_GET['merk']!=""){
                $merk = (int)$_GET['merk'];
                $cat = Yii::app()->session['cat'];
           }
           else{
               $merk = "20";
           }
           
           $data= Product::model()->findAll(array('condition'=>"merk_product_id='$merk' AND product_category_id='$cat'"));

           $data=CHtml::listData($data,'id','name');

           echo "<option value=''>Pilih Produk</option>";
           foreach($data as $value=>$name)
           echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
           
        }
        
        public function actionCetak(){
            $code = $_GET['code'];
            $cust = $_GET['cust'];
			$penjualan = $this->findPenjualan($code, $cust);
			$model = $this->findDetailPenjualanByPenjualanId($penjualan->kd_penjualan);
            $this->render('cetak', array('model'=>$model, 'code'=>$code));
        }
		
        public function findDetailPenjualanByPenjualanId($id)
        {
                $model = DetailPenjualan::model()->findAll(array('condition'=>"penjualan_id='$id'"));
                if($model===null)
                        throw new CHttpException(404,'The requested page does not exist.');
                return $model;
        }
		
		
        
        public function actionCetakkendaraan(){
            $code = $_GET['code'];
            $penjualan=  Penjualan::model()->find(array('condition'=>"code='$code'")); 
            $model = DetailPenjualan::model()->findAll(array('condition'=>"penjualan_id='$penjualan->id'"));
            $this->render('cetakKendaraan', array('model'=>$model, 'penjualan'=>$penjualan));
        }

		/**
		 * Performs the AJAX validation.
		 * @param CModel the model to be validated
		 */
		protected function performAjaxValidation($model)
		{
			if(isset($_POST['ajax']) && $_POST['ajax']==='penjualan-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
}