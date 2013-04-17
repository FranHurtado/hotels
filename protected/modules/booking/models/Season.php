<?php

/**
 * This is the model class for table "Season".
 *
 * The followings are the available columns in table 'Season':
 * @property integer $ID
 * @property integer $UserID
 * @property string $Name
 * @property string $Start
 * @property string $Finish
 *
 * The followings are the available model relations:
 * @property Book[] $books
 * @property User $user
 */
class Season extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Season the static model class
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
		return 'Season';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, Name, Start, Finish', 'required'),
			array('UserID, Type', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, Name, Start, Finish', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Book', 'SeasonID'),
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
			'Name' => 'Nombre de la temporada',
			'Start' => 'Comienzo',
			'Finish' => 'Final',
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
		$criteria->compare('Start',$this->Start,true);
		$criteria->compare('Finish',$this->Finish,true);
		$criteria->compare('Type',$this->Type);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getType($id)
	{
		switch($id):
			case 0:
				return "Baja";
				break;
				
			case 1:
				return "Media";
				break;
				
			case 2:
				return "Alta";
				break;
		endswitch;
	}
}