<?php

/**
 * This is the model class for table "CustomerList".
 *
 * The followings are the available columns in table 'CustomerList':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $CustomerID
 * @property integer $ListID
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Customer $customer
 */
class CustomerList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerList the static model class
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
		return 'CustomerList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, CustomerID, ListID', 'required'),
			array('UserID, CustomerID, ListID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, CustomerID, ListID', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'CustomerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserID' => 'User',
			'CustomerID' => 'Customer',
			'ListID' => 'List',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('CustomerID',$this->CustomerID);
		$criteria->compare('ListID',$this->ListID);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}