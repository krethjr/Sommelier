<?php

/**
 * This is the model class for table "{{api_access}}".
 *
 * The followings are the available columns in table '{{api_access}}':
 * @property integer $api_id
 * @property string $api_key_desc
 * @property string $api_key_id
 * @property string $api_key_secret
 * @property string $update_dt
 * @property integer $responsible_user_id
 *
 * The followings are the available model relations:
 * @property User $responsibleUser
 */
class ApiAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{api_access}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('api_key_desc, responsible_user_id', 'required'),
			array('api_id, responsible_user_id', 'numerical', 'integerOnly'=>true),
			array('api_key_desc', 'length', 'max'=>45),
                        array('update_dt','default',
                            'value'=>new CDbExpression('NOW()'),
                            'setOnEmpty'=>false,
                            'on'=>'insert, update',
                        ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('api_id, api_key_desc, api_key_secret, api_key_id, update_dt, responsible_user_id', 'safe', 'on'=>'search'),
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
			'responsibleUser' => array(self::BELONGS_TO, 'User', 'responsible_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'api_id' => 'Api ID',
			'api_key_desc' => 'Api Key Desc',
			'api_key_id' => 'Api Key ID',
			'api_key_secret' => 'Api Key Secret',
			'update_dt' => 'Update Date-time',
			'responsible_user_id' => 'Responsible User',
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

		$criteria->compare('api_id',$this->api_id);
		$criteria->compare('api_key_desc',$this->api_key_desc,true);
		$criteria->compare('api_key_id',$this->api_key_id,true);
		$criteria->compare('api_key_secret',$this->api_key_secret,true);
		$criteria->compare('update_dt',$this->update_dt,true);
		$criteria->compare('responsible_user_id',$this->responsible_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApiAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function beforeSave()
        {
            if($this->isNewRecord)
            {          
                $this->api_key_id=Yii::app()->securityManager->generateRandomString(30, TRUE);
                $this->api_key_secret=Yii::app()->securityManager->generateRandomString(30, TRUE);
            }
            return parent::beforeSave();
        }
}
