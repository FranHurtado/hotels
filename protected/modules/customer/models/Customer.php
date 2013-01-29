<?php

/**
 * This is the model class for table "Customer".
 *
 * The followings are the available columns in table 'Customer':
 * @property integer $ID
 * @property integer $UserID
 * @property string $DNI
 * @property string $FullName
 * @property string $Email
 * @property string $Phone
 * @property string $BirthDate
 * @property string $Comments
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
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
		return 'Customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, FullName', 'required'),
			array('UserID', 'numerical', 'integerOnly'=>true),
			array('DNI', 'length', 'max'=>10),
			array('FullName', 'length', 'max'=>200),
			array('Email', 'length', 'max'=>150),
			array('Phone', 'length', 'max'=>20),
			array('Address', 'length', 'max'=>250),
			array('BirthDate, Comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, DNI, FullName, Email, Phone, BirthDate, Comments, Address', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Book', 'CustomerID'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'customerLists' => array(self::HAS_MANY, 'CustomerList', 'CustomerID'),
			'invoices' => array(self::HAS_MANY, 'Invoice', 'CustomerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserID' => 'Usuario',
			'DNI' => 'DNI',
			'FullName' => 'Nombre completo',
			'Email' => 'Email',
			'Phone' => 'Tel&eacute;fono',
			'BirthDate' => 'Fecha de nacimiento',
			'Address' => 'Direcci&oacute;n',
			'Comments' => 'Comentarios',
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
		$criteria->compare('DNI',$this->DNI,true);
		$criteria->compare('FullName',$this->FullName,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('BirthDate',$this->BirthDate,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Comments',$this->Comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}