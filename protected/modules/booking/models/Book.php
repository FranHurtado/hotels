<?php

/**
 * This is the model class for table "Book".
 *
 * The followings are the available columns in table 'Book':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $CustomerID
 * @property integer $RoomID
 * @property integer $SeasonID
 * @property string $Start
 * @property string $Finish
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Customer $customer
 * @property Room $room
 * @property Season $season
 */
class Book extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Book the static model class
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
		return 'Book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, CustomerID, RoomID, SeasonID, Start, Finish, Pax', 'required'),
			array('UserID, CustomerID, RoomID, SeasonID, Pax', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, CustomerID, RoomID, SeasonID, Start, Finish', 'safe', 'on'=>'search'),
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
			'room' => array(self::BELONGS_TO, 'Room', 'RoomID'),
			'season' => array(self::BELONGS_TO, 'Season', 'SeasonID'),
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
			'CustomerID' => 'Cliente',
			'RoomID' => 'Habitacion',
			'SeasonID' => 'Temporada',
			'Start' => 'Entrada',
			'Finish' => 'Salida',
			'Pax' => 'Pax',
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
		$criteria->compare('RoomID',$this->RoomID);
		$criteria->compare('SeasonID',$this->SeasonID);
		$criteria->compare('Start',$this->Start,true);
		$criteria->compare('Finish',$this->Finish,true);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getSeason($date)
	{
		$sql = "SELECT ID FROM Season WHERE 
			   	(CONCAT(YEAR(Season.Start),'-" . date("m", strtotime($date)) . "','-" . date("d", strtotime($date)) . "') >= Season.Start) AND 
			   	(CONCAT(YEAR(Season.Finish),'-" . date("m", strtotime($date)) . "','-" . date("d", strtotime($date)) . "') <= Season.Finish)";
			   	
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result["ID"];
	}
	
	
	public function Top($num)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);
		$criteria->limit = $num;
		
		$model = Book::model()->findAll($criteria);
		
		$result = "";
		
		$result.= "<table cellpadding='5' cellspacing='0' border='0' style='border-collapse: collapse;'>";
		
		$result.= "<tr><td><b>Entrada</b></td><td><b>Habitacion</b></td><td><b>Cliente</b></td></tr>";
				
		foreach ($model as $customer):
			$result.= "<tr>";
			$result.= "<td><a href='".Yii::app()->createURL('/booking/book/update/', array('id'=>$customer->ID))."'>" . date("d-m-Y" , strtotime($customer->Start)) . "</td>";
			$result.= "<td><a href='".Yii::app()->createURL('/booking/book/update/', array('id'=>$customer->ID))."'>" . Functions::stringCut($customer->room->Name, 20) . "</td>";
			$result.= "<td><a href='".Yii::app()->createURL('/booking/book/update/', array('id'=>$customer->ID))."'>" . Functions::stringCut($customer->customer->FullName, 20) . "</td>";
			$result.= "</tr>";
		endforeach;
		
		$result.= "</table>";
		
		return $result;
	}
}