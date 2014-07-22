<?php

/**
 * This is the model class for table "{{wineries}}".
 *
 * The followings are the available columns in table '{{wineries}}':
 * @property integer $id
 * @property string $winery_name
 * @property integer $default_appellation_id
 * @property string $phone
 * @property string $proprietor_name
 * @property string $winemaker_name
 * @property string $website
 * @property string $description
 * @property string $create_dt
 * @property string $update_dt
 *
 * The followings are the available model relations:
 * @property Appellations $defaultAppellation
 * @property Wines[] $wines
 */
class Wineries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{wineries}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('winery_name', 'required'),
			array('default_appellation_id', 'numerical', 'integerOnly'=>true),
			array('winery_name, proprietor_name, winemaker_name', 'length', 'max'=>45),
			array('website', 'length', 'max'=>128),
			array('description', 'length', 'max'=>2048),
			array('phone', 'length', 'max'=>12),
                        array('create_dt', 'default',
                            'value'=>new CDbExpression('NOW()'),
                            'setOnEmpty'=>false,'on'=>'insert'),
                        array('update_dt', 'default',
                            'value'=>new CDbExpression('NOW()'),
                            'setOnEmpty'=>false,'on'=>'insert, update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, winery_name, default_appellation_id, phone, proprietor_name, winemaker_name, description, create_dt, update_dt', 'safe', 'on'=>'search'),
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
			'defaultAppellation' => array(self::BELONGS_TO, 'Appellations', 'default_appellation_id'),
			'wines' => array(self::HAS_MANY, 'Wines', 'winery_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'winery_name' => 'Winery Name',
			'default_appellation_id' => 'Default Appellation',
			'phone' => 'Phone',
			'proprietor_name' => 'Proprietor Name',
			'winemaker_name' => 'Winemaker Name',
			'website' => 'Website',
			'description' => 'Description',
			'create_dt' => 'Create Dt',
			'update_dt' => 'Update Dt',
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
		$criteria->compare('winery_name',$this->winery_name,true);
		$criteria->compare('default_appellation_id',$this->default_appellation_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('proprietor_name',$this->proprietor_name,true);
		$criteria->compare('winemaker_name',$this->winemaker_name,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_dt',$this->create_dt,true);
		$criteria->compare('update_dt',$this->update_dt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Wineries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
