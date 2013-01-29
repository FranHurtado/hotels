<?php

/**
 * This is the model class for table "Control".
 *
 * The followings are the available columns in table 'Control':
 * @property integer $ID
 * @property integer $UserID
 * @property integer $WorkerID
 * @property integer $PointID
 * @property string $Name
 * @property string $Task
 * @property string $Startdate
 * @property string $Enddate
 * @property integer $Frecuency
 *
 * The followings are the available model relations:
 * @property Point $point
 * @property User $user
 * @property Worker $worker
 */
class Control extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Control the static model class
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
		return 'Control';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, WorkerID, PointID, Name, Startdate, Enddate, Frecuency', 'required'),
			array('UserID, WorkerID, PointID, Frecuency', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>150),
			array('Task', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UserID, WorkerID, PointID, Name, Task, Startdate, Enddate, Frecuency', 'safe', 'on'=>'search'),
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
			'point' => array(self::BELONGS_TO, 'Point', 'PointID'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'worker' => array(self::BELONGS_TO, 'Worker', 'WorkerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'UserID' => 'Empresa',
			'WorkerID' => 'Operario: ',
			'PointID' => 'Punto cr&iacute;tico: ',
			'Name' => 'Nombre: ',
			'Task' => 'Tarea: ',
			'Startdate' => 'Fecha inicio: ',
			'Enddate' => 'Fecha fin: ',
			'Frecuency' => 'Frecuencia: ',
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
		$criteria->compare('WorkerID',$this->WorkerID);
		$criteria->compare('PointID',$this->PointID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Task',$this->Task,true);
		$criteria->compare('Startdate',$this->Startdate,true);
		$criteria->compare('Enddate',$this->Enddate,true);
		$criteria->compare('Frecuency',$this->Frecuency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function giveFrecuency($data)
	{
		switch ($data){
            case "0":
                return "Diaria";
                break;
            case "1":
                return "Semanal";
                break;
            case "2":
                return "Mensual";
                break;
            case "3":
                return "Anual";
                break;
        }
	}
}