<?php
/**
 * Author: Pham Cong Son
 * Email: phamcongsonit@gmail.com
 */
extract($_POST);

require_once 'VerifyEmail.class.php'; 

// Initialize library class
$mail = new VerifyEmail();

// Set the timeout value on stream
// $mail->setStreamTimeoutWait(20);

// Set debug output mode
// $mail->Debug= TRUE; 
// $mail->Debugoutput= 'html'; 

// Set email address for SMTP request
$mail->setEmailFrom('phamcongsonit@gmail.com'); // you can type what email you want

// Check if email is valid and exist
$result = $mail->check($email);
header('Content-Type: application/json');
echo json_encode(['code' => $result, 'index' => $index]);
/*switch ($result) {
	case 0:
		echo 'fail';
		break;
	case 1: 
		echo 'success';
		break;
	case 2:
		echo 'server dont allow';
		break;
	case 3:
		echo 'cant connect server';
		break;
}*/
