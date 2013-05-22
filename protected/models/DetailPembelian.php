<?php

/**
 * This is the model class for table "detail_pembelian".
 *
 * The followings are the available columns in table 'detail_pembelian':
 * @property integer $id
 * @property integer $gerai_id
 * @property integer $pembelian_id
 * @property integer $jumlah
 * @property string $total_harga
 *
 * The followings are the available model relations:
 * @property Gerai $gerai
 * @property Pembelian $pembelian
 */
class DetailPembelian extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DetailPembelian the static model class
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
		return 'detail_pembelian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, gerai_id, pembelian_id, jumlah', 'numerical', 'integerOnly'=>true),
			array('total_harga', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gerai_id, pembelian_id, jumlah, total_harga', 'safe', 'on'=>'search'),
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
			'gerai' => array(self::BELONGS_TO, 'Gerai', 'gerai_id'),
			'pembelian' => array(self::BELONGS_TO, 'Pembelian', 'pembelian_id'),
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
			'pembelian_id' => 'Pembelian',
			'jumlah' => 'Jumlah',
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
		$criteria->compare('gerai_id',$this->gerai_id);
		$criteria->compare('pembelian_id',$this->pembelian_id);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('total_harga',$this->total_harga,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}