<?php

/*
 * Essential functions that you can use in the application.
 * Functions::methodName(values); 
 */

class Functions extends CApplicationComponent
{

	public static function sendMail($emailSender,$emailReceiver,$subject,$body)
	{
         $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
         $mailer->IsSMTP();
         $mailer->IsHTML(true);
         $mailer->SMTPAuth = true;
         $mailer->Host = "mail.turalbacrm.com";
         $mailer->Username = "noreply@turalbacrm.com";
         $mailer->Password = "send00z";
         $mailer->From = $emailSender;
         $mailer->FromName = "Boletin";
         $mailer->AddAddress($emailReceiver);
         $mailer->Subject = utf8_decode($subject);
         $mailer->Body = utf8_decode($body);
         if(!$mailer->Send()) :
              return false;
         else :
             return true;
         endif;
    }
    
    public static function stringCut($string,$size)
    {
        if(strlen($string)<$size)
            return $string;
        
        return substr($string,0,strrpos(substr($string,0,$size)," "))."...";
    }
    
    public static function lastReports()
    {
    	$result = "";
	    
	    $result.= "<table cellpadding='5' cellspacing='0' border='0' style='border-collapse: collapse;'>";
	    
	    $result.= "<tr><td>Selecciona el informe que desees imprimir:</td></tr>";
	    
	    $result.= "<tr>";
		$result.= "<td><a href='".Yii::app()->createURL('customer/customer/print/')."'>Listado de Clientes</td>";
		$result.= "</tr>";
	    
	    $result.= "<tr>";
		$result.= "<td><a href='".Yii::app()->createURL('booking/default/booklist/')."'>Listado de Reservas</td>";
		$result.= "</tr>";
	    
	    $result.= "<tr>";
		$result.= "<td><a href='".Yii::app()->createURL('invoice/default/invoicelist/')."'>Listado de Facturas</td>";
		$result.= "</tr>";
		
		$result.= "<tr>";
		$result.= "<td><a href='".Yii::app()->createURL('APPC/default/informe/')."'>Informe APPC</td>";
		$result.= "</tr>";
		
		$result.= "</table>";
		
		return $result;

    }

}