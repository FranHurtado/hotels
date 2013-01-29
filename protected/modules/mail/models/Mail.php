<?php

/**
 * This is the model class for table "Mail".
 *
 * The followings are the available columns in table 'Mail':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $ListID
 * @property string $Name
 * @property string $Date
 * @property string $Text
 */
class Mail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mail the static model class
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
		return 'Mail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, ListID, Name, Date', 'required'),
			array('UserID, ListID', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>100),
			array('Text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, ListID, Name, Date, Text', 'safe', 'on'=>'search'),
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
			'list' => array(self::BELONGS_TO, 'Mailist', 'ListID'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
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
			'ListID' => 'Lista',
			'Name' => 'Nombre',
			'Date' => 'Fecha de creacion',
			'Text' => 'Texto',
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
		$criteria->compare('ListID',$this->ListID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('Text',$this->Text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}