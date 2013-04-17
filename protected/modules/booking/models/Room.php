<?php

/**
 * This is the model class for table "Room".
 *
 * The followings are the available columns in table 'Room':
 * @property integer $ID
 * @property integer $UserID
 * @property string $Name
 * @property string $PriceBig
 * @property string $PriceLow
 *
 * The followings are the available model relations:
 * @property Book[] $books
 * @property User $user
 */
class Room extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Room the static model class
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
		return 'Room';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, Name, PriceBig, PriceLow, PriceMed', 'required'),
			array('UserID, Type', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>150),
			array('PriceBig, PriceLow', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, Name, PriceBig, PriceLow', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Book', 'RoomID'),
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
			'UserID' => 'Usuario',
			'Name' => 'Nombre',
			'PriceBig' => 'Precio Alta',
			'PriceLow' => 'Precio Baja',
			'PriceMed' => 'Precio Media',
			'Type' => 'Tipo',
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
		$criteria->compare('PriceBig',$this->PriceBig,true);
		$criteria->compare('PriceLow',$this->PriceLow,true);
		$criteria->compare('PriceMed',$this->PriceMed,true);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}