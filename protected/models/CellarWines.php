<?php

/**
 * This is the model class for table "tbl_cellar_wines".
 *
 * The followings are the available columns in table 'tbl_cellar_wines':
 * @property integer $id
 * @property integer $cellar_id
 * @property integer $wine_id
 * @property integer $quantity
 * @property integer $rating
 * @property string $location
 * @property string $create_dt
 * @property string $update_dt
 * @property string $cost
 *
 * The followings are the available model relations:
 * @property TblWines $wine
 * @property TblCellars $cellar
 */
class CellarWines extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            return 'tbl_cellar_wines';
	}

        /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cellar_id, wine_id, quantity, cellar_loc_id', 'required'),
			array('cellar_id, wine_id, quantity, rating, cellar_loc_id', 'numerical', 'integerOnly'=>true),
			array('cost', 'length', 'max'=>10),
                        array('create_dt', 'default',
                            'value'=>new CDbExpression('NOW()'),
                            'setOnEmpty'=>false,'on'=>'insert'),
                        array('update_dt', 'default',
                            'value'=>new CDbExpression('NOW()'),
                            'setOnEmpty'=>false,'on'=>'insert, update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cellar_id, wine_id, rating, location, create_dt, update_dt, cellar_loc_id', 'safe', 'on'=>'search'),
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
			'wine' => array(self::BELONGS_TO, 'Wines', 'wine_id'),
			'cellar' => array(self::BELONGS_TO, 'Cellars', 'cellar_id'),
                        'cellarLoc' => array(self::BELONGS_TO, 'CellarLocation', 'cellar_loc_id'),
		);
	}

	public function increment()
	{
            $this->quantity = $this->quantity + 1;
            
            return;
	}

        public function decrement()
	{
            if ($this->quantity > 0)
                $this->quantity = $this->quantity - 1;
            
            return;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cellar_id' => 'Cellar',
			'wine_id' => 'Wine',
			'quantity' => 'Quantity',
			'rating' => 'Rating',
			'cellar_loc_id' => 'Location',
			'create_dt' => 'Date Created',
			'update_dt' => 'Last Update Date',
			'cost' => 'Cost',
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
		$criteria->compare('cellar_id',$this->cellar_id);
		$criteria->compare('wine_id',$this->wine_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('create_dt',$this->create_dt,true);
		$criteria->compare('update_dt',$this->update_dt,true);
		$criteria->compare('cost',$this->cost,true);
                $criteria->compare('cellar_loc_id',$this->cellar_loc_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CellarWines the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
