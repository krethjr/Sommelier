<?php

/**
 * This is the model class for table "tbl_appellations".
 *
 * The followings are the available columns in table 'tbl_appellations':
 * @property integer $id
 * @property string $country
 * @property integer $region_id
 * @property string $appellation
 * @property string $common_flg
 *
 * The followings are the available model relations:
 * @property TblRegions $region
 * @property TblWineries[] $tblWineries
 * @property TblWines[] $tblWines
 */
class Appellations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_appellations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, region_id, appellation', 'required'),
			array('region_id', 'numerical', 'integerOnly'=>true),
			array('country, appellation', 'length', 'max'=>45),
			array('common_flg', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, country, region_id, appellation, common_flg', 'safe', 'on'=>'search'),
		);
	}

        public function getRegionAppellation()
        {
            return($this->region->region_name . " - " . $this->appellation);
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
			'tblWineries' => array(self::HAS_MANY, 'Wineries', 'default_appellation_id'),
			'tblWines' => array(self::HAS_MANY, 'Wines', 'appellation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Appellation ID',
			'country' => 'Country',
			'region_id' => 'Region',
			'appellation' => 'Appellation',
			'common_flg' => 'Common Flg',
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
		$criteria->compare('country',$this->country,true);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('appellation',$this->appellation,true);
		$criteria->compare('common_flg',$this->common_flg,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appellations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
