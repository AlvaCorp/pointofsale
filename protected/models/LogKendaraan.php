<?php

/**
 * This is the model class for table "log_kendaraan".
 *
 * The followings are the available columns in table 'log_kendaraan':
 * @property integer $id
 * @property integer $modifikasi_id
 * @property integer $masalah_id
 * @property integer $beban_id
 * @property integer $teknisi_id
 * @property integer $detail_kendaraan_id
 * @property integer $tahun_kendaraan_id
 * @property integer $kondisi_id
 * @property string $date
 * @property integer $status
 * @property string $logKendaraanId
 *
 * The followings are the available model relations:
 * @property TahunKendaraan $tahunKendaraan
 * @property DetailKendaraan $detailKendaraan
 * @property Masalah $masalah
 * @property Teknisi $teknisi
 * @property Beban $beban
 * @property Modifikasi $modifikasi
 * @property Kondisi $kondisi
 * @property Penjualan[] $penjualans
 */
class LogKendaraan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LogKendaraan the static model class
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
		return 'log_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('modifikasi_id, masalah_id, beban_id, teknisi_id, detail_kendarann_id, tahun_kendaraan_id, kondisi_id, status', 'required'),
			array('modifikasi_id, masalah_id, beban_id, teknisi_id, tahun_kendaraan_id, kondisi_id, status, km_awal, km_akhir', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modifikasi_id, masalah_id, beban_id, teknisi_id, detail_kendaraan_id, tahun_kendaraan_id, kondisi_id, logKendaraanId, date, status, km_awal, km_akhir', 'safe', 'on'=>'search'),
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
			'tahunKendaraan' => array(self::BELONGS_TO, 'TahunKendaraan', 'tahun_kendaraan_id'),
			'detailKendaraan' => array(self::BELONGS_TO, 'DetailKendaraan', 'detail_kendaraan_id'),
			'masalah' => array(self::BELONGS_TO, 'Masalah', 'masalah_id'),
			'pegawai' => array(self::BELONGS_TO, 'Pegawai', 'pegawai_id'),
			'beban' => array(self::BELONGS_TO, 'Beban', 'beban_id'),
			'modifikasi' => array(self::BELONGS_TO, 'Modifikasi', 'modifikasi_id'),
			'kondisi' => array(self::BELONGS_TO, 'Kondisi', 'kondisi_id'),
			'detailPenjualan' => array(self::HAS_MANY, 'DetailPenjualan', 'log_kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'pegawai_id' => 'Teknisi',
			'modifikasi_id' => 'Modifikasi',
			'masalah_id' => 'Masalah',
			'beban_id' => 'Beban',
			'teknisi_id' => 'Teknisi',
			'detail_kendaraan_id' => 'Nomor Polisi',
			'tahun_kendaraan_id' => 'Tahun Kendaraan',
			'kondisi_id' => 'Kondisi',
                        'logKendaraanId' => 'Log Kendaraan Id',
			'date' => 'Date',
			'km_awal' => 'Kilometer Awal',
			'km_akhir' => 'Kilometer Akhir',
			'status' => 'Status',
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
                $criteria->compare('pegawai_id',$this->pegawai_id);
		$criteria->compare('modifikasi_id',$this->modifikasi_id);
		$criteria->compare('masalah_id',$this->masalah_id);
		$criteria->compare('beban_id',$this->beban_id);
		$criteria->compare('teknisi_id',$this->teknisi_id);
		$criteria->compare('detail_kendaraan_id',$this->detail_kendaraan_id);
		$criteria->compare('tahun_kendaraan_id',$this->tahun_kendaraan_id);
		$criteria->compare('kondisi_id',$this->kondisi_id);
                $criteria->compare('logKendaraanId',$this->logKendaraanId);
		$criteria->compare('km_awal',$this->km_awal);
		$criteria->compare('km_akhir',$this->km_akhir);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}