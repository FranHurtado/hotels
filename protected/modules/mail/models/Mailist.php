<?php

/**
 * This is the model class for table "Mailist".
 *
 * The followings are the available columns in table 'Mailist':
 * @property integer $ID
 * @property integer $UserID
 * @property string $Name
 */
class Mailist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mailist the static model class
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
		return 'Mailist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, Name', 'required'),
			array('UserID', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, Name', 'safe', 'on'=>'search'),
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
			'mails' => array(self::HAS_MANY, 'Mail', 'ListID'),
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
			'Name' => 'Nombre de la lista',
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
		$criteria->compare('Name',$this->Name,true);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}