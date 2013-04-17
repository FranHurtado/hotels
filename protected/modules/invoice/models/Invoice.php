<?php

/**
 * This is the model class for table "Invoice".
 *
 * The followings are the available columns in table 'Invoice':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $CustomerID
 * @property string $Date
 * @property string $Number
 *
 * The followings are the available model relations:
 * @property Charge[] $charges
 * @property User $user
 * @property Customer $customer
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'Invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, CustomerID, Date, Number', 'required'),
			array('UserID, CustomerID, SerieID', 'numerical', 'integerOnly'=>true),
			array('Number', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, CustomerID, Date, Number', 'safe', 'on'=>'search'),
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
			'charges' => array(self::HAS_MANY, 'Charge', 'InvoiceID'),
			'serie' => array(self::BELONGS_TO, 'Serie', 'SerieID'),
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
			'CustomerID' => 'Cliente',
			'Date' => 'Fecha',
			'Number' => 'Numero',
			'SerieID' => 'Serie',
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
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('Number',$this->Number,true);
		$criteria->compare('SerieID',$this->SerieID);
		
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
		
		$model = Invoice::model()->findAll($criteria);
		
		$result = "";
		
		$result.= "<table cellpadding='5' cellspacing='0' border='0' style='border-collapse: collapse;'>";
		
		$result.= "<tr><td><b>Serie</b></td><td><b>Numero</b></td><td><b>Cliente</b></td></tr>";
				
		foreach ($model as $customer):
			$result.= "<tr>";
			$result.= "<td><a href='".Yii::app()->createURL('/invoice/invoice/update/', array('id'=>$customer->ID))."'>" . $customer->serie->Serie . "</td>";
			$result.= "<td><a href='".Yii::app()->createURL('/invoice/invoice/update/', array('id'=>$customer->ID))."'>" . $customer->Number . "</td>";
			$result.= "<td><a href='".Yii::app()->createURL('/invoice/invoice/update/', array('id'=>$customer->ID))."'>" . Functions::stringCut($customer->customer->FullName, 20) . "</td>";
			$result.= "</tr>";
		endforeach;
		
		$result.= "</table>";
		
		return $result;
	}
}