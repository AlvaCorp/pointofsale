<?php

/**
 * This is the model class for table "detail_penjualan".
 *
 * The followings are the available columns in table 'detail_penjualan':
 * @property integer $id
 * @property integer $product_category_id
 * @property integer $product_type_id
 * @property integer $merk_product_id
 * @property integer $penjualan_id
 * @property integer $product_id
 * @property integer $log_kendaraan_id
 * @property string $tanggal_produksi
 * @property string $kode_produksi
 * @property integer $jumlah
 * @property double $total_harga
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Penjualan $penjualan
 */
class DetailPenjualan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DetailPenjualan the static model class
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
                        array('tanggal_produksi, kode_produksi', 'required'),
			array('product_category_id, product_type_id, merk_product_id, penjualan_id, product_id, log_kendaraan_id, jumlah', 'numerical', 'integerOnly'=>true),
			array('total_harga, potongan', 'numerical'),
			array('kode_produksi', 'length', 'max'=>512),
			array('tanggal_produksi', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_category_id, product_type_id, merk_product_id, penjualan_id, product_id, log_kendaraan_id, tanggal_produksi, kode_produksi, jumlah, total_harga', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'penjualan' => array(self::BELONGS_TO, 'Penjualan', 'penjualan_id'),
                        'logKendaraan' => array(self::BELONGS_TO, 'LogKendaraan', 'log_kendaraan_id')
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
			'product_type_id' => 'Product Type',
			'merk_product_id' => 'Merk Product',
			'penjualan_id' => 'Penjualan',
			'product_id' => 'Product',
			'log_kendaraan_id' => 'Log Kendaraan',
			'tanggal_produksi' => 'Tanggal Produksi',
			'kode_produksi' => 'Kode Produksi',
			'jumlah' => 'Jumlah',
                        'potongan'  => 'Potongan',
			'total_harga' => 'Total Harga',
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
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('merk_product_id',$this->merk_product_id);
		$criteria->compare('penjualan_id',$this->penjualan_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('log_kendaraan_id',$this->log_kendaraan_id);
		$criteria->compare('tanggal_produksi',$this->tanggal_produksi,true);
		$criteria->compare('kode_produksi',$this->kode_produksi,true);
		$criteria->compare('jumlah',$this->jumlah);
                $criteria->compare('potongan',$this->potongan);
		$criteria->compare('total_harga',$this->total_harga);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getData($id){

            $model = Yii::app()->db->createCommand()
                ->select('a.id as detail_id, a.tanggal_produksi as tanggal_produksi, a.kode_produksi, a.jumlah, a.total_harga, b.id as product_id, b.name as product_name, b.kd_product as product_code, b.harga as product_price, b.diskon, b.garansi_max, c.name as satuan')
                ->from('detail_penjualan a')
                ->leftJoin('product b', 'a.product_id=b.id')
                ->leftJoin('product_satuan c', 'b.product_satuan_id=c.id')
                ->where('id=:id', array(':id'=>$id))
                ->queryAll();
            
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
            
        }
}