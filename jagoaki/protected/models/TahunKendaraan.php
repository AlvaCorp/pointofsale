<?php

/**
 * This is the model class for table "tahun_kendaraan".
 *
 * The followings are the available columns in table 'tahun_kendaraan':
 * @property integer $id
 * @property string $description
 * @property string $matrix
 *
 * The followings are the available model relations:
 * @property LogKendaraan[] $logKendaraans
 */
class TahunKendaraan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TahunKendaraan the static model class
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
		return 'tahun_kendaraan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'length', 'max'=>64),
			array('matrix', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, matrix', 'safe', 'on'=>'search'),
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
			'logKendaraans' => array(self::HAS_MANY, 'LogKendaraan', 'tahun_kendaraan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'matrix' => 'Matrix',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('matrix',$this->matrix,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}