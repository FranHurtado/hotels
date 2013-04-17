<?php

/**
 * This is the model class for table "Worker".
 *
 * The followings are the available columns in table 'Worker':
 * @property integer $ID
 * @property string $Fullname
 * @property string $DNI
 * @property string $Birthdate
 * @property integer $Gender
 */
class Worker extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Worker the static model class
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
		return 'Worker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Fullname, Birthdate', 'required'),
			array('Gender', 'numerical', 'integerOnly'=>true),
			array('Fullname', 'length', 'max'=>150),
			array('DNI', 'length', 'max'=>10),
			array('Birthdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Fullname, DNI, Birthdate, Gender', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Fullname' => 'Nombre completo: ',
			'DNI' => 'DNI: ',
			'Birthdate' => 'Fecha nac.: ',
			'Gender' => 'G&eacute;nero: ',
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
		$criteria->compare('Fullname',$this->Fullname,true);
		$criteria->compare('DNI',$this->DNI,true);
		$criteria->compare('Birthdate',$this->Birthdate,true);
		$criteria->compare('Gender',$this->Gender);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}