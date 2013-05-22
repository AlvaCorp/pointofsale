<?php

/**
 * This is the model class for table "kartu_garansi".
 *
 * The followings are the available columns in table 'kartu_garansi':
 * @property integer $id
 * @property integer $kode_garansi_id
 * @property integer $detail_kendaraan_id
 * @property integer $detail_penjualan_id
 * @property integer $product_id
 * @property string $date_create
 * @property integer $lama
 * @property integer $sisa
 * @property string $periode_mulai
 * @property string $periode_selesai
 * @property string $status
 * @property string $kode
 * @property string $km_awal
 * @property string $km_akhir
 *
 * The followings are the available model relations:
 * @property DetailKendaraan $detailKendaraan
 * @property KodeGaransi $kodeGaransi
 * @property Product $product
 */
class KartuGaransi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return KartuGaransi the static model class
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
		return 'kartu_garansi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_garansi_id, detail_penjualan_id, product_id, lama, sisa, km_awal, km_akhir', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>64),
			array('kode', 'length', 'max'=>256),
			array('date_create, periode_mulai, periode_selesai', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kode_garansi_id, detail_kendaraan_id, detail_penjualan_id, product_id, date_create, lama, sisa, periode_mulai, periode_selesai, status, kode, km_awal, km_akhir', 'safe', 'on'=>'search'),
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
			'detailKendaraan' => array(self::BELONGS_TO, 'DetailKendaraan', 'detail_kendaraan_id'),
			'kodeGaransi' => array(self::BELONGS_TO, 'KodeGaransi', 'kode_garansi_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_garansi_id' => 'Kode Garansi',
			'detail_kendaraan_id' => 'Detail Kendaraan',
			'detail_penjualan_id' => 'Detail Penjualan',
			'product_id' => 'Product',
			'date_create' => 'Date Create',
			'lama' => 'Lama',
			'sisa' => 'Sisa',
			'periode_mulai' => 'Periode Mulai',
			'periode_selesai' => 'Periode Selesai',
                        'km_awal' =>    'Kilometer Awal',
                        'km_akhir'  =>  'Kilometer Akhir',
			'status' => 'Status',
			'kode' => 'Kode',
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
		$criteria->compare('kode_garansi_id',$this->kode_garansi_id);
		$criteria->compare('detail_kendaraan_id',$this->detail_kendaraan_id);
		$criteria->compare('detail_penjualan_id',$this->detail_penjualan_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('lama',$this->lama);
		$criteria->compare('sisa',$this->sisa);
		$criteria->compare('periode_mulai',$this->periode_mulai,true);
		$criteria->compare('periode_selesai',$this->periode_selesai,true);
                
                $criteria->compare('km_awal',$this->km_awal,true);
                $criteria->compare('km_akhir',$this->km_akhir,true);
                
		$criteria->compare('status',$this->status,true);
		$criteria->compare('kode',$this->kode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
}