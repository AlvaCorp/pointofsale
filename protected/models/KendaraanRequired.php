<?php

/**
 * This is the model class for table "kendaraan".
 *
 * The followings are the available columns in table 'kendaraan':
 * @property integer $id
 * @property integer $merk_kendaraan_id
 * @property integer $kategori_kendaraan_id
 * @property integer $bahan_bakar_id
 * @property integer $jenis_kendaraan_id
 * @property string $no_kendaraan
 * @property string $no_mesin
 *
 * The followings are the available model relations:
 * @property DetailKendaraan[] $detailKendaraans
 * @property BahanBakar $bahanBakar
 * @property Merk $merk
 * @property KategoriKendaraan $kategoriKendaraan
 * @property JenisKendaraan $jenisKendaraan
 */
class KendaraanRequired extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kendaraan the static model class
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
		return 'kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merk_kendaraan_id, jenis_kendaraan_id, tahun_kendaraan, no_mesin', 'required'),
			array('tahun_kendaraan, jenis_kendaraan_id', 'required'),
			array('id, merk_kendaraan_id, kategori_kendaraan_id, bahan_bakar_id, jenis_kendaraan_id, tahun_kendaraan', 'numerical', 'integerOnly'=>true),
			array('no_kendaraan', 'length', 'max'=>16),
                        array('tahun_kendaraan', 'length', 'max'=>4),
			array('no_mesin', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merk_kendaraan_id, kategori_kendaraan_id, bahan_bakar_id, jenis_kendaraan_id, no_kendaraan, no_mesin, tahun_kendaraan', 'safe', 'on'=>'search'),
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
			'detailKendaraan' => array(self::HAS_MANY, 'DetailKendaraan', 'kendaraan_id'),
			'bahanBakar' => array(self::BELONGS_TO, 'BahanBakar', 'bahan_bakar_id'),
			'merkKendaraan' => array(self::BELONGS_TO, 'MerkKendaraan', 'merk_kendaraan_id'),
			'kategoriKendaraan' => array(self::BELONGS_TO, 'KategoriKendaraan', 'kategori_kendaraan_id'),
			'jenisKendaraan' => array(self::BELONGS_TO, 'JenisKendaraan', 'jenis_kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'merk_kendaraan_id' => 'Merk',
			'kategori_kendaraan_id' => 'Kategori Kendaraan',
			'bahan_bakar_id' => 'Bahan Bakar',
			'jenis_kendaraan_id' => 'Jenis Kendaraan',
			'no_kendaraan' => 'No Kendaraan',
			'no_mesin' => 'No Mesin',
                        'tahun_kendaraan'   => 'Tahun Kendaraan'
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
		$criteria->compare('merk_kendaraan_id',$this->merk_kendaraan_id);
		$criteria->compare('kategori_kendaraan_id',$this->kategori_kendaraan_id);
		$criteria->compare('bahan_bakar_id',$this->bahan_bakar_id);
		$criteria->compare('jenis_kendaraan_id',$this->jenis_kendaraan_id);
		$criteria->compare('no_kendaraan',$this->no_kendaraan,true);
		$criteria->compare('no_mesin',$this->no_mesin,true);
                $criteria->compare('tahun_kendaraan',$this->tahun_kendaraan,true);
                
                $criteria->with = array(
                    'merkKendaraan'=>array('select'=>'merkKendaraan.name'),
                    'kategoriKendaraan'=>array('select'=>'kategoriKendaraan.name'),
                    'bahanBakar'=>array('select'=>'bahanBakar.name'),
                    'jenisKendaraan'=>array('select'=>'jenisKendaraan.name')
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getData(){
            $model = Yii::app()->db->createCommand()
                    ->select("a.id, concat(a.no_mesin, ' [ ', b.name, ' ] ', a.tahun_kendaraan) as name")
                    ->from('kendaraan a')
                    ->leftJoin('merk_kendaraan b', 'a.merk_kendaraan_id=b.id')
                    ->order('b.name asc')
                    ->queryAll();
            return $model;           
        }
        
}