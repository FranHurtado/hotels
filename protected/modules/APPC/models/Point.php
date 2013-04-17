<?php

/**
 * This is the model class for table "Point".
 *
 * The followings are the available columns in table 'Point':
 * @property integer $ID
 * @property integer $UserID
 * @property string $Name
 * @property string $Description
 * @property string $Goal
 * @property string $Actions
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Point extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Point the static model class
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
		return 'Point';
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
			array('Name', 'length', 'max'=>150),
			array('Description, Goal, Actions', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, Name, Description, Goal, Actions', 'safe', 'on'=>'search'),
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
			'control' => array(self::HAS_MANY, 'Control', 'PointID'),
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
			'Name' => 'Nombre: ',
			'Description' => 'Descripcion: ',
			'Goal' => 'Objetivos: ',
			'Actions' => 'Medidas: ',
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
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Goal',$this->Goal,true);
		$criteria->compare('Actions',$this->Actions,true);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function Top($num)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);
		$criteria->limit = $num;
		
		$model = Control::model()->findAll($criteria);
		
		$result = "";
		
		$result.= "<table cellpadding='5' cellspacing='0' border='0' style='border-collapse: collapse;'>";
		
		$result.= "<tr><td><b>Punto critico</b></td><td><b>Control</b></td></tr>";
				
		foreach ($model as $customer):
			$result.= "<tr>";
			$result.= "<td><a href='".Yii::app()->createURL('/APPC/point/update/', array('id'=>$customer->ID))."'>" . Functions::stringCut($customer->point->Name, 25) . "</a></td>";
			$result.= "<td><a href='".Yii::app()->createURL('/APPC/point/update/', array('id'=>$customer->ID))."'>" . Functions::stringCut($customer->Name, 25) . "</a></td>";
			$result.= "</tr>";
		endforeach;
		
		$result.= "</table>";
		
		return $result;
	}
}