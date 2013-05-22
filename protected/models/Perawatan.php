<?php

/**
 * This is the model class for table "perawatan".
 *
 * The followings are the available columns in table 'perawatan':
 * @property integer $id
 * @property integer $detail_kendaraan_id
 * @property integer $teknisi_id
 * @property string $nomor
 * @property string $km
 * @property string $volt
 * @property string $v_starter
 * @property string $sistem_kelistrikan
 * @property string $load_off
 * @property string $load_on
 * @property string $isi_air_aki
 * @property string $isi_air_sir
 * @property string $date_create
 * @property string $kartu_garansi_id
 *
 * The followings are the available model relations:
 * @property KartuGaransi $kartuGaransi
 * @property Pegawai $teknisi
 * @property DetailKendaraan $detailKendaraan
 */
class Perawatan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Perawatan the static model class
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
		return 'perawatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teknisi_id, km, volt, v_starter, load_off, load_on, isi_air_aki, isi_air_sir, kartu_garansi_id', 'required'),
			array('detail_kendaraan_id, teknisi_id', 'numerical', 'integerOnly'=>true),
			array('nomor, volt, v_starter, sistem_kelistrikan, load_off, load_on, isi_air_aki', 'length', 'max'=>16),
			array('km', 'length', 'max'=>64),
			array('kartu_garansi_id', 'length', 'max'=>32),
			array('date_create', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, detail_kendaraan_id, teknisi_id, nomor, km, volt, v_starter, sistem_kelistrikan, load_off, load_on, isi_air_aki, isi_air_sir, date_create, kartu_garansi_id', 'safe', 'on'=>'search'),
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
			'kartuGaransi' => array(self::BELONGS_TO, 'KartuGaransi', 'kartu_garansi_id'),
			'teknisi' => array(self::BELONGS_TO, 'Pegawai', 'teknisi_id'),
			'detailKendaraan' => array(self::BELONGS_TO, 'DetailKendaraan', 'detail_kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detail_kendaraan_id' => 'Detail Kendaraan',
			'teknisi_id' => 'Teknisi',
			'nomor' => 'Nomor',
			'km' => 'Kilometer',
			'volt' => 'Volt',
			'v_starter' => 'V Starter',
			'sistem_kelistrikan' => 'Sistem Kelistrikan',
			'load_off' => 'Load Off',
			'load_on' => 'Load On',
			'isi_air_aki' => 'Isi Air Aki',
                        'isi_air_sir' => 'Isi Air Sir',
			'date_create' => 'Date Create',
			'kartu_garansi_id' => 'Nomor Kartu Garansi',
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
		$criteria->compare('detail_kendaraan_id',$this->detail_kendaraan_id);
		$criteria->compare('teknisi_id',$this->teknisi_id);
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('km',$this->km,true);
		$criteria->compare('volt',$this->volt,true);
		$criteria->compare('v_starter',$this->v_starter,true);
		$criteria->compare('sistem_kelistrikan',$this->sistem_kelistrikan,true);
		$criteria->compare('load_off',$this->load_off,true);
		$criteria->compare('load_on',$this->load_on,true);
		$criteria->compare('isi_air_aki',$this->isi_air_aki,true);
                $criteria->compare('isi_air_sir',$this->isi_air_sir,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('kartu_garansi_id',$this->kartu_garansi_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function getRowCountByNomorGaransi($kode){

		$model = Yii::app()->db->createCommand()
			->select('count(*) + 1')
			->from('perawatan')
			->where('kartu_garansi_id=:kartu_garansi_id', array(':kartu_garansi_id'=>$kode))
			->queryScalar();
		
		if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		return $model;
		
	}
        
}