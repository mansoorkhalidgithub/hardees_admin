<?php

namespace app\Helpers;

//use Log;
use Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use PHPMailer\PHPMailer\PHPMailer;


class EmailHelper
{
	public  static function resetEmail($token,$userEmail)
	{
		//dd($token);
		$server = "http://localhost:8000/";
		$urlGenrate = $server."password/reset/".$token;
		$expiteTime = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
		//$urlGenrate = url($server,['token'=>$token]);
		$text = '';
		$text .= '<div class="Container otpflow">
					<div class="name" style="font-size: 50px; font-weight: 500; color: #ffcd34; text-align: center;">Reset Password Notification!</div>
					<div class="Container invoicetext" style="font-size: 20px; color: black;">
						<strong style="color: #ffcd34;"></strong>
						
						<p style="padding: 0px 10px; text-align: justify;">You are receiving this email because we received a password reset request for your account.</p>
					   
					</div>
					<div class="appdetail" style="width: 100%;">
						<div class="Container invoicetext" style="font-size: 20px; color: black;padding: 10px 10px; text-align: justify;">This password reset link will expire in "'.$expiteTime.'" minutes.</div>

						<div class="Container bookmark" style="  font-size: 20px; color: black;color: #ffcd34; font-weight: 600; padding: 10px 10px; text-align: center;"><a href="'.$urlGenrate. '">"'.$urlGenrate. '"</a>
						</div>

						<div class="Container invoicetext" style="padding: 10px 10px;">If you did not request a password reset, no further action is required.
						</div>
					</div>

				</div>';

		$mail = new PHPMailer(true);
		$mail->IsSMTP();  
		$mail->SMTPAuth = true;    
		$mail->SMTPSecure = "ssl";
		$mail->Host = "mindtech.pk";
		$mail->Port = 465;
		$mail->Username = "hardees@mindtech.pk"; 
		$mail->Password = "w3n2o1$@r1d&";

		$mail->setfrom("hardees@mindtech.pk", 'Hardees');

		$mail->IsHTML(true);
		$mail->Subject = "Rest Password";
		$mail->Body    = $text;
		$mail->AddAddress($userEmail);
		if ($mail->Send()) {
			return true;
		} else {
			return 'false'.$mail->ErrorInfo;
		}
		
	}
}
