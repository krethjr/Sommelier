<?php

/**
 * This is the model class for table "{{systemconfig}}".
 *
 * The followings are the available columns in table '{{systemconfig}}':
 * @property integer $id
 * @property string $systemName
 * @property string $version
 * @property integer $wineOfTheDay_id
 * @property string $wineOfTheDay_dt
 */
class Systemconfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{systemconfig}}';
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
			array('id, wineOfTheDay_id', 'numerical', 'integerOnly'=>true),
			array('systemName, version', 'length', 'max'=>45),
			array('wineOfTheDay_dt', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, systemName, version, wineOfTheDay_id, wineOfTheDay_dt', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'systemName' => 'System Name',
			'version' => 'Version',
			'wineOfTheDay_id' => 'Wine Of The Day',
			'wineOfTheDay_dt' => 'Wine Of The Day Dt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('systemName',$this->systemName,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('wineOfTheDay_id',$this->wineOfTheDay_id);
		$criteria->compare('wineOfTheDay_dt',$this->wineOfTheDay_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Systemconfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
