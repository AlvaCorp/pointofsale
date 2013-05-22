<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property integer $gerai_id
 * @property integer $product_category_id
 * @property integer $product_type_id
 * @property integer $merk_product_id
 * @property string $name
 * @property string $kd_product
 * @property double $harga
 * @property double $diskon
 * @property integer $jumlah
 * @property string $kendaraan
 * @property integer $garansi_max
 * @property integer $product_satuan_id
 *
 * The followings are the available model relations:
 * @property DetailPenjualan[] $detailPenjualans
 * @property KartuGaransi[] $kartuGaransis
 * @property LogProduct[] $logProducts
 * @property ProductSatuan $productSatuan
 * @property ProductCategory $productCategory
 * @property ProductType $productType
 * @property MerkProduct $merkProduct
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
                        array('product_category_id, harga, product_satuan_id, name', 'required'),
			array('gerai_id, product_category_id, product_type_id, merk_product_id, jumlah, garansi_max, product_satuan_id', 'numerical', 'integerOnly'=>true),
			array('harga, diskon', 'numerical'),
			array('name', 'length', 'max'=>1024),
			array('kd_product', 'length', 'max'=>512),
			array('kendaraan', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gerai_id, product_category_id, product_type_id, merk_product_id, name, kd_product, harga, diskon, jumlah, kendaraan, garansi_max, product_satuan_id', 'safe', 'on'=>'search'),
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
			'detailPenjualans' => array(self::HAS_MANY, 'DetailPenjualan', 'product_id'),
			'kartuGaransis' => array(self::HAS_MANY, 'KartuGaransi', 'product_id'),
			'logProducts' => array(self::HAS_MANY, 'LogProduct', 'product_id'),
			'productSatuan' => array(self::BELONGS_TO, 'ProductSatuan', 'product_satuan_id'),
			'productCategory' => array(self::BELONGS_TO, 'ProductCategory', 'product_category_id'),
			'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
			'merkProduct' => array(self::BELONGS_TO, 'MerkProduct', 'merk_product_id'),
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
			'product_type_id' => 'Tipe Produk',
			'merk_product_id' => 'Merk Produk',
			'name' => 'Name',
			'kd_product' => 'Kode Produk',
			'harga' => 'Harga',
			'diskon' => 'Diskon',
			'jumlah' => 'Jumlah',
			'kendaraan' => 'Kendaraan',
			'garansi_max' => 'Garansi Max',
			'product_satuan_id' => 'Satuan',
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
		$criteria->compare('gerai_id',$this->gerai_id);
		$criteria->compare('product_category_id',$this->product_category_id);
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('merk_product_id',$this->merk_product_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('kd_product',$this->kd_product,true);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('diskon',$this->diskon);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('kendaraan',$this->kendaraan,true);
		$criteria->compare('garansi_max',$this->garansi_max);
		$criteria->compare('product_satuan_id',$this->product_satuan_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}