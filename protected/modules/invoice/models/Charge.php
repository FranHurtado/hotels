<?php

/**
 * This is the model class for table "Charge".
 *
 * The followings are the available columns in table 'Charge':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $InvoiceID
 * @property string $Text
 * @property string $Price
 * @property integer $IVA
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Invoice $invoice
 */
class Charge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Charge the static model class
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
		return 'Charge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, InvoiceID, Text, Price, IVA', 'required'),
			array('UserID, InvoiceID, IVA', 'numerical', 'integerOnly'=>true),
			array('Text', 'length', 'max'=>150),
			array('Price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, InvoiceID, Text, Price, IVA', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'InvoiceID'),
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
			'InvoiceID' => 'Invoice',
			'Text' => 'Text',
			'Price' => 'Price',
			'IVA' => 'Iva',
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
		$criteria->compare('InvoiceID',$this->InvoiceID);
		$criteria->compare('Text',$this->Text,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('IVA',$this->IVA);
		
		$criteria->condition = "UserID = :userid";
		$criteria->params = array(':userid' => Yii::app()->user->ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}