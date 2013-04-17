<?php

class EPlanning extends CWidget
{
	public $model;
	
	public $books;
	
	protected $month;
	
	protected $year;
	
	protected $monthDays;
	
	protected $jsRender = "";
	
	private $_baseUrl;
	
	public function init()
	{
		// Calculate month
		$this->month = $_GET["month"] == "" ? date("m") : $_GET["month"];
		
		// Calculate year
		$this->year = $_GET["year"] == "" ? date("Y") : $_GET["year"];
		
		echo "<div class='contextMenu'><p class=\"newBook\">Crear Reserva</p><p class=\"editBook\">Ver Reserva</p> <p class=\"closeBook\">Finalizar Reserva (checkout)</p></div>";
		echo "<div id='myPlanning'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' style='border-collapse:collapse;'>";
		$this->createHeader();
		$this->createRooms();
		echo "</table>";
		echo "</div>";
		
		echo "<script>$(document).ready(function(){\n";
			//Render books
			echo $this->jsRender;
			
			// Non booked cell click
			echo "\n$(\".roomDay\").click(function(e){\n";
				echo "if(($(\".contextMenu\").attr('id') == $(this).parent().attr('id')) && ($(\".contextMenu\").attr('title') == $(this).attr('id'))) {\n";
					echo "$(\".contextMenu\").hide(); \n";
					echo "$(\".contextMenu\").attr('id', '');\n";
					echo "$(\".contextMenu\").attr('title', '');\n";
				echo "}else{\n";
					echo "$(\".contextMenu\").show();\n";
					echo "$(\".contextMenu\").attr('id', $(this).parent().attr('id'));\n";
					echo "$(\".contextMenu\").attr('title', $(this).attr('id'));\n";
				echo "}\n"; 
				echo "$(\".contextMenu .newBook\").show();\n";
				echo "$(\".contextMenu .editBook\").hide();\n";
				echo "$(\".contextMenu .closeBook\").hide();\n";
				echo "$(\".contextMenu\").css({'top' : e.pageY + 5, 'left' : e.pageX + 10});\n";
			echo "});\n";
			
			// Booked cell click
			echo "\n$(\".roomDayBooked\").click(function(e){\n";
				echo "if(($(\".contextMenu\").attr('id') == $(this).parent().attr('id')) && ($(\".contextMenu\").attr('title') == $(this).attr('id'))) {\n";
					echo "$(\".contextMenu\").hide(); \n";
					echo "$(\".contextMenu\").attr('id', '');\n";
					echo "$(\".contextMenu\").attr('title', '');\n";
				echo "}else{\n";
					echo "$(\".contextMenu\").show();\n";
					echo "$(\".contextMenu\").attr('id', $(this).parent().attr('id'));\n";
					echo "$(\".contextMenu\").attr('title', $(this).attr('id'));\n";
				echo "}\n"; 
				echo "$(\".contextMenu .newBook\").hide();\n";
				echo "$(\".contextMenu .editBook\").show();\n";
				echo "if($(this).hasClass('close')){";
				echo "$(\".contextMenu .closeBook\").hide();\n";
				echo "}else{";
				echo "$(\".contextMenu .closeBook\").show();\n";
				echo "}";
				echo "$(\".contextMenu\").css({'top' : e.pageY + 5, 'left' : e.pageX + 10});\n";
			echo "});\n";
			
			// New book click
			echo "\n$(\".newBook\").click(function(){\n";
				echo "window.location.href = '". Yii::app()->createURL("/booking/book/create") . "?id=' + $(this).parent().attr('id') + '&d=' + $(this).parent().attr('title'); \n";
			echo "});\n";
			
			// Edit book click
			echo "\n$(\".editBook\").click(function(){\n";
				echo "window.location.href = '". Yii::app()->createURL("/booking/book/update") . "?id=' + $(this).parent().attr('title'); \n";
			echo "});\n";
			
			// Finish book click
			echo "\n$(\".closeBook\").click(function(){\n";
				echo "window.location.href = '". Yii::app()->createURL("/booking/book/billing") . "?id=' + $(this).parent().attr('title'); \n";
			echo "});\n";
			
		echo "\n});</script>";
	}
	
	protected function createHeader()
	{
		// Spanish locale
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S‡bado");
		$diasL = array("L","M","X","J","V","S","D");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		// Calculate next month and year
		$dateNext = strtotime("01-" . $this->month . "-" . $this->year . "+1 month");
		$nextMonth = date("m", $dateNext);
		$nextYear = date("Y", $dateNext); 
		
		// Calculate previous month and year
		$datePrevious = strtotime("01-" . $this->month . "-" . $this->year . "-1 month");
		$previousMonth = date("m", $datePrevious);
		$previousYear = date("Y", $datePrevious);
				
		echo "<p id='monthName'>";
		echo "<a href='". Yii::app()->createUrl("booking/book/planning", array('month'=>$previousMonth, 'year'=>$previousYear)) ."'><</a> ";
		echo $meses[(date("n", strtotime( $this->month . "/01/" . $this->year)) - 1)] . " " . $this->year;
		echo " <a href='". Yii::app()->createUrl("booking/book/planning", array('month'=>$nextMonth, 'year'=>$nextYear)) ."'>></a>";
		echo "</p>";
				
		echo "<tr class='headerPlanning'>";
		
		// Calculate Month days
		$this->monthDays = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
		
		echo "<td></td>";
		
		for($i=1; $i<=$this->monthDays; $i++) :
			echo "<td class='day'>";
			echo $i;
			echo "</td>";
		endfor;
		
		echo "</tr>";
		
		echo "<tr class='headerPlanning'>";
		
		echo "<td></td>";
		
		for($i=1; $i<=$this->monthDays; $i++) :
			if(date("w", strtotime($this->month . "/" . $i . "/" . $this->year)) == 0 || date("w", strtotime($this->month . "/" . $i . "/" . $this->year)) == 6):
				$holiday = "holiday";
			else:
				$holiday = "";
			endif;
			
			echo "<td class='day " . $holiday . "'>";
			echo $diasL[(date("N", strtotime($this->month . "/" . $i . "/" . $this->year)) - 1)];
			echo "</td>";
		endfor;
		
		echo "</tr>";
	}
	
	protected function createRooms()
	{
		// Room names
		foreach($this->model as $room) :
			echo "<tr id='" . $room->ID . "'>";
			echo "<td class='roomName'>" . $room->Name . "</td>";
			
			// Fill room days
			for($i=1; $i<=$this->monthDays; $i++) :
				if(date("w", strtotime($this->month . "/" . $i . "/" . $this->year)) == 0 || date("w", strtotime($this->month . "/" . $i . "/" . $this->year)) == 6):
					$holiday = "holiday";
				else:
					$holiday = "";
				endif;
				
				echo "<td class='roomDay " . $holiday . " " . $room->ID . " " . strtotime($this->month. "/" . $i . "/" . $this->year) . "' id='".strtotime($this->month. "/" . $i . "/" . $this->year)."'>";
				echo "";
				echo "</td>";
			endfor;	
			echo "</tr>";
		endforeach;
		
		$this->renderBooks();
	}
	
	private function renderBooks()
	{
		// Change background of booked days
		foreach($this->books as $book):
			if($book->Type == 0):
				if(strtotime($book->Finish) - strtotime($book->Start) > 86400):
					$j = ((strtotime($book->Finish) - strtotime($book->Start)) / 86400);
					for($i = 0; $i<$j; $i++):
						$theDate = strtotime($book->Start) + ($i * 86400);
						$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('title', '". $book->customer->FullName ."'); \n";
						$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('id', '". $book->ID ."'); \n $('." . $theDate . ".". $book->room->ID ."').attr('class', 'roomDayBooked'); \n";
					endfor;
				else :
					$theDate = strtotime($book->Start);
					$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('title', '". $book->customer->FullName ."'); \n";
					$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('id', '". $book->ID ."'); \n $('." . $theDate . ".". $book->room->ID ."').attr('class', 'roomDayBooked'); \n";
				endif;
			else:
				if(strtotime($book->Finish) - strtotime($book->Start) > 86400):
					$j = ((strtotime($book->Finish) - strtotime($book->Start)) / 86400);
					for($i = 0; $i<$j; $i++):
						$theDate = strtotime($book->Start) + ($i * 86400);
						$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('title', '". $book->customer->FullName ."'); \n";
						$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('id', '". $book->ID ."'); \n $('." . $theDate . ".". $book->room->ID ."').attr('class', 'roomDayBooked close'); \n";
					endfor;
				else :
					$theDate = strtotime($book->Start);
					$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('title', '". $book->customer->FullName ."'); \n";
					$this->jsRender = $this->jsRender . "\n $('." . $theDate . ".". $book->room->ID ."').attr('id', '". $book->ID ."'); \n $('." . $theDate . ".". $book->room->ID ."').attr('class', 'roomDayBooked close'); \n";
				endif;
			endif;
		endforeach;
	}
}