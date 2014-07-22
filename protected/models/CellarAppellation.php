<?php

/**
 * This is the model class for table "{{cellar_appellation}}".
 *
 * The followings are the available columns in table '{{cellar_appellation}}':
 * @property integer $id
 * @property integer $cellar_id
 * @property integer $appellation_id
 *
 * The followings are the available model relations:
 * @property Cellars $cellar
 * @property Appellations $appellation
 */
class CellarAppellation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cellar_appellation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cellar_id, appellation_id', 'required'),
			array('cellar_id, appellation_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cellar_id, appellation_id', 'safe', 'on'=>'search'),
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
			'cellar' => array(self::BELONGS_TO, 'Cellars', 'cellar_id'),
			'appellation' => array(self::BELONGS_TO, 'Appellations', 'appellation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cellar_id' => 'Cellar',
			'appellation_id' => 'Appellation',
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

		$criteria->compare('cellar_id',$this->cellar_id);
		$criteria->compare('appellation_id',$this->appellation_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CellarAppellation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
