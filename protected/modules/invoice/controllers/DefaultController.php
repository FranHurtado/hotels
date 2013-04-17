<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionInvoiceList()
	{   
    	if($_POST["start"]){
    		
    		$criteria = new CDbCriteria();
			$criteria->condition = "Date BETWEEN :start AND :finish AND UserID = :userid";
			$criteria->params = array(':start' => date("Y-m-d", strtotime($_POST["start"])), ':finish' => date("Y-m-d", strtotime($_POST["fin"])), ':userid' => Yii::app()->user->ID);
			
			$model = Invoice::model()->findAll($criteria);
    		
    		set_time_limit(600);
    		
	        # mPDF
	        $pdf = Yii::app()->ePdf->mpdf('', 'A4', '','','','','','','','','P');
	
	        $pdf->writeHTMLfooter=false;
	        $pdf->writeHTMLheader=false;
	        $pdf->DeflMargin=15;
	        $pdf->DefrMargin=15;
	        $pdf->tMargin=15;
	        $pdf->bMargin=15;
	
	        $pdf->w=297;   //manually set width
	        $pdf->h=209.8; //manually set height
	 
	        # render (full page)
	        $pdf->WriteHTML($this->renderPartial('_invoicelist', array('model'=>$model), true));
	 
	        # Outputs ready PDF
	        $pdf->Output('ListaFacturas_'.date("d/m/Y").'.pdf','D');
        }else{
	        $this->render('selector');
        }
	}
}