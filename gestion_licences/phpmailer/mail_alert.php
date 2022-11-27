<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php
$string = get_include_contents('C:\xampp\htdocs\gestion_licences\date.php');

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}

//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    require 'config.php';
    
    $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
    $sql = 'SELECT * FROM licences WHERE date_fin ="' . $myDate . '"' ;
   

$result = $con->query($sql);

if ($result->num_rows > 0) {
    
    //Create instance of PHPMailer
	$mail = new PHPMailer();
    //Set mailer to use smtp
        $mail->isSMTP();
    //Define smtp host
        $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
        $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
        $mail->Port = "587";
    //Set gmail username
        $mail->Username = "entrez votre username ici";
    //Set gmail password
        $mail->Password = "entrez votre password ici";
    //Email subject
        $mail->Subject = "licence expiree";
    //Set sender email
        $mail->setFrom('entrez votre email ici');
    //Enable HTML
        $mail->isHTML(true);
    
    //Email body
    
        $mail->Body ="<h1>votre licence va bientot expirer</h1>". get_include_contents('C:\xampp\htdocs\gestion_licences\date.php');
    //Add recipient
        $mail->addAddress('medbaba@mattel.mr');
                if ( $mail->send() ) {
                    echo "Email Sent..!";
                
                }  
            
            else{
                echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
            }
    }       
    else  {
       
        echo "0 results";
        }


?>

</body>
</html>
  