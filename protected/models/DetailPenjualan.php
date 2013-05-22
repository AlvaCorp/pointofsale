<?php

/**
 * This is the model class for table "detail_penjualan".
 *
 * The followings are the available columns in table 'detail_penjualan':
 * @property integer $id
 * @property integer $product_category_id
 * @property integer $merk_product_id
 * @property integer $tipe_penjualan_id
 * @property integer $penjualan_id
 * @property integer $product_id
 * @property integer $log_kendaraan_id
 * @property string $tanggal_produksi
 * @property string $kode_produksi
 * @property integer $jumlah
 * @property double $harga
 * @property double $potongan
 * @property double $total_harga
 * @property string $kode_garansi
 * @property string $status
 * @property string $keterangan
 *
 * The followings are the available model relations:
 * @property LogKendaraan $logKendaraan
 * @property TipePenjualan $tipePenjualan
 * @property Product $product
 * @property Penjualan $penjualan
 * 
 */
class DetailPenjualan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DetailPenjualan the static model class
	 */
    
        public $kode_garansi;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detail_penjualan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_category_id, merk_product_id, tipe_penjualan_id, penjualan_id, product_id, tanggal_produksi, jumlah, harga, kode_produksi, kode_garansi', 'required'),
			array('product_category_id, merk_product_id, tipe_penjualan_id, product_id, log_kendaraan_id, jumlah', 'numerical', 'integerOnly'=>true),
			array('harga, potongan, total_harga', 'numerical'),
			array('kode_produksi', 'length', 'max'=>512),
                        array('jumlah', 'length', 'max'=>2),
                        array('status', 'length', 'max'=>16),
                        array('keterangan', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_category_id, merk_product_id, tipe_penjualan_id, penjualan_id, product_id, log_kendaraan_id, tanggal_produksi, kode_produksi, jumlah, harga, potongan, total_harga, kode_garansi, status, keterangan', 'safe', 'on'=>'search'),
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
			'logKendaraan' => array(self::BELONGS_TO, 'LogKendaraan', 'log_kendaraan_id'),
			'tipePenjualan' => array(self::BELONGS_TO, 'TipePenjualan', 'tipe_penjualan_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'penjualan' => array(self::BELONGS_TO, 'Penjualan', 'penjualan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_category_id' => 'Product Category',
			'merk_product_id' => 'Merk Product',
			'tipe_penjualan_id' => 'Tipe Penjualan',
			'penjualan_id' => 'Penjualan',
			'product_id' => 'Product',
			'log_kendaraan_id' => 'Log Kendaraan',
			'tanggal_produksi' => 'Tanggal Produksi',
			'kode_produksi' => 'Kode Produksi',
			'jumlah' => 'Jumlah',
			'harga' => 'Harga',
			'potongan' => 'Potongan',
			'total_harga' => 'Total Harga',
                        'kode_garansi' => 'Kode Garansi',
                        'status' => 'Status',
                        'keterangan' => 'Keterangan'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_category_id',$this->product_category_id);
		$criteria->compare('merk_product_id',$this->merk_product_id);
		$criteria->compare('tipe_penjualan_id',$this->tipe_penjualan_id);
		$criteria->compare('penjualan_id',$this->penjualan_id, true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('log_kendaraan_id',$this->log_kendaraan_id);
		$criteria->compare('tanggal_produksi',$this->tanggal_produksi,true);
		$criteria->compare('kode_produksi',$this->kode_produksi,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('potongan',$this->potongan);
		$criteria->compare('total_harga',$this->total_harga);
                $criteria->compare('kode_garansi', $this->kode_garansi, true);
                $criteria->compare('status', $this->status, true);
                $criteria->compare('keterangan', $this->keterangan, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function getData($id){

		$model = Yii::app()->db->createCommand()
			->select('a.id as detail_id, a.harga, a.tanggal_produksi as tanggal_produksi, a.kode_produksi, a.jumlah, a.total_harga, b.id as product_id, b.name as product_name, b.kd_product as product_code, b.harga as product_price, b.diskon, b.garansi_max, c.name as satuan')
			->from('detail_penjualan a')
			->leftJoin('product b', 'a.product_id=b.id')
			->leftJoin('product_satuan c', 'b.product_satuan_id=c.id')
			->where('id=:id', array(':id'=>$id))
			->queryAll();
		
		if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		return $model;
		
	}
        
	public function getPenjualanGaransiByInvoice($invoice){
		$model = Yii::app()->db->createCommand()
		->select('b.id as log_kendaraan, e.kd_penjualan as invoice, e.date as tanggal, f.name as customer, i.name as merk, g.name as tipe, ')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
                //->leftJoin('kartu_garansi h', 'a.id=h.detail_penjualan_id')
                ->leftJoin('merk_product i', 'g.merk_product_id=i.id')
		//->where("a.penjualan_id = '$invoice' AND (a.product_category_id = '1' OR a.product_category_id = '2') AND (d.jenis_kendaraan_id <> 5 OR d.jenis_kendaraan_id <> 2) AND b.detail_kendaraan_id IS NOT NULL")
		->where("a.penjualan_id = '$invoice' AND (a.product_category_id = '1' OR a.product_category_id = '2')")                        
		->order('a.id desc')
		->queryAll();
		return $model;
	}
	
	public function getPenjualanGaransi(){
		$model = Yii::app()->db->createCommand()
		->select('a.id as id, g.name as product, e.date as date, e.kd_penjualan as invoice, f.name as customer, b.id as log_kendaraan_id, h.kode as kode')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
                ->leftJoin('kartu_garansi h', 'a.id=h.detail_penjualan_id')
		->where("(a.product_category_id = '1' OR a.product_category_id = '2') AND (d.jenis_kendaraan_id <> 5 OR d.jenis_kendaraan_id <> 2) AND h.status <> '0'")
		->order('a.id desc')
		->queryAll();
		return $model;
	}
	
	public function getAllDetailPenjualan(){
		$model = Yii::app()->db->createCommand()
		->select('a.id as id, g.name as product, e.date as date, e.kd_penjualan as invoice, f.name as customer, b.id as log_kendaraan_id')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
		->where("d.jenis_kendaraan_id <> 5 OR d.jenis_kendaraan_id <> 2 OR b.detail_kendaraan_id IS NOT NULL")
		->order('a.id desc')
		->queryAll();
		return $model;
	}
        
	public function getAllDetailPenjualanByKdPenjualan($kd_penjualan){
		$model = Yii::app()->db->createCommand()
		->select('a.id as id, g.name as product, e.date as date, e.kd_penjualan as invoice, f.name as customer, b.id as log_kendaraan_id')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
		->where("e.kd_penjualan='$kd_penjualan'")
		->order('a.id desc')
		->queryAll();
		return $model;
	}
        
	public function getAllDetailPenjualanByDate($date){
		$model = Yii::app()->db->createCommand()
		->select('a.id as id, g.name as product, e.date as date, e.kd_penjualan as invoice, f.name as customer, b.id as log_kendaraan_id')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
		->where("e.date='$date'")
		->order('a.id desc')
		->queryAll();
		return $model;
	}
        
	public function getAllDetailPenjualanByDateByKdPenjualan($date, $kd_penjualan){
		$model = Yii::app()->db->createCommand()
		->select('a.id as id, g.name as product, e.date as date, e.kd_penjualan as invoice, f.name as customer, b.id as log_kendaraan_id')
		->from('detail_penjualan a')
		->leftJoin('log_kendaraan b', 'a.log_kendaraan_id=b.id')
		->leftJoin('detail_kendaraan c', 'b.detail_kendaraan_id=c.uid')
		->leftJoin('kendaraan d', 'c.kendaraan_id=d.no_mesin')
		->leftJoin('penjualan e', 'a.penjualan_id=e.kd_penjualan')
		->leftJoin('customer f', 'e.customer_id=f.no_ktp')
		->leftJoin('product g', 'a.product_id=g.id')
		->where("e.date='$date' and e.kd_penjualan='$kd_penjualan'")
		->order('a.id desc')
		->queryAll();
		return $model;
	}
}