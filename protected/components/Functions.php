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

}