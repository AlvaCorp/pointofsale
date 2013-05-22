<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $gerai_id
 * @property integer $product_category_id
 * @property integer $merk_product_id
 * @property string $kd_product
 * @property string $name
 * @property string $tanggal_produksi
 * @property integer $no_produksi
 * @property double $harga
 * @property double $diskon
 * @property integer $jumlah
 * @property string $kendaraan
 * @property integer $garansi_max
 *
 * The followings are the available model relations:
 * @property DetailPenjualan[] $detailPenjualans
 * @property KartuGaransi[] $kartuGaransis
 * @property LogProduct[] $logProducts
 * @property MerkProduct $merkProduct
 * @property ProductCategory $productCategory
 * @property Gerai $gerai
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('id, gerai_id, product_category_id, merk_product_id, no_produksi, jumlah, garansi_max', 'numerical', 'integerOnly'=>true),
			array('harga, diskon', 'numerical'),
			array('kd_product', 'length', 'max'=>128),
			array('name', 'length', 'max'=>256),
			array('kendaraan', 'length', 'max'=>64),
			array('tanggal_produksi', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gerai_id, product_category_id, merk_product_id, kd_product, name, tanggal_produksi, no_produksi, harga, diskon, jumlah, kendaraan, garansi_max', 'safe', 'on'=>'search'),
		);
	}
        
//
        protected function afterFind(){
            parent::afterFind();
            $this->tanggal_produksi=date('d-m-Y', strtotime(str_replace("-", "", $this->tanggal_produksi)));       
        }

        protected function beforeSave(){
                $this->tanggal_produksi=date('Y-m-d', strtotime(str_replace(",", "", $this->tanggal_produksi)));
                return true;
        }


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'detailPenjualan' => array(self::HAS_MANY, 'DetailPenjualan', 'product_id'),
			'kartuGaransi' => array(self::HAS_MANY, 'KartuGaransi', 'product_id'),
			'logProduct' => array(self::HAS_MANY, 'LogProduct', 'product_id'),
			'merkProduct' => array(self::BELONGS_TO, 'MerkProduct', 'merk_product_id'),
			'productCategory' => array(self::BELONGS_TO, 'ProductCategory', 'product_category_id'),
			'gerai' => array(self::BELONGS_TO, 'Gerai', 'gerai_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gerai_id' => 'Gerai',
			'product_category_id' => 'Kategori Produk',
			'merk_product_id' => 'Merk Produk',
			'kd_product' => 'Kode Produk',
			'name' => 'Nama',
			'tanggal_produksi' => 'Tanggal Produksi',
			'no_produksi' => 'No. Produksi',
			'harga' => 'Harga',
			'diskon' => 'Diskon',
			'jumlah' => 'Jumlah',
			'kendaraan' => 'Kendaraan',
			'garansi_max' => 'Garansi Max(Bulan)',
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
		//$criteria->compare('gerai_id',$this->gerai_id);
		$criteria->compare('product_category_id',$this->product_category_id);
		$criteria->compare('merk_product_id',$this->merk_product_id);
		//$criteria->compare('kd_product',$this->kd_product,true);
		//$criteria->compare('name',$this->name,true);
		//$criteria->compare('tanggal_produksi',$this->tanggal_produksi,true);
		$criteria->compare('no_produksi',$this->no_produksi);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('kendaraan',$this->kendaraan,true);
		$criteria->compare('garansi_max',$this->garansi_max);
                $criteria->with = array(
                    'merkProduct'=>array('select'=>'merkKendaraan.name'),
                    'productCategory'=>array('select'=>'kategoriKendaraan.name'),
                    //'bahanBakar'=>array('select'=>'bahanBakar.name'),
                    //'jenisKendaraan'=>array('select'=>'jenisKendaraan.name')
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}