<?php 
session_start();
include('dbcon.php');



//require 'path/to/PHPMailer/src/Exception.php';
//require 'path/to/PHPMailer/src/PHPMailer.php';
//require 'path/to/PHPMailer/src/SMTP.php';
require 'vendor/autoload.php';
//require 'vendor/phpmailer/phpmailer/src/Exception.php';



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendemail_verify($name,$email,$verify_token)
{
$email = new PHPMailer(true);


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
   $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'peeplil6666@gmail.com';                     //SMTP username
    $mail->Password   = 'GGWTFnice69';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    //Recipients
    $mail->setFrom('peeplil6666@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient
  // $mail->addAddress('peeplil6666@gmail.com');               //Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
   
$email_template = "
<h2>You have Registered with Web Weaver</h2>
<h5>Verify your email address to Login with the below given link</h5><br>
<a href='http://localhost/REGESTRATION%20SYSTEM/verify-email.php?token=$verify_token'>Click Me</a>
";
$mail -> Body = $email_template;
    $mail->send();
    //echo 'Message has been sent';

}

if(isset($_POST['register_btn']))
{
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$verify_token = md5(rand());
sendemail_verify("$name","$email","$verify_token");
echo "sent or not?";
};
/*
$check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
$check_email_query_run = mysqli_query($con, $check_email_query);

if(mysqli_num_rows($check_email_query_run) > 0)
{
$_SESSION['status'] = "Email ID already Exists";
header("Location: register.php");
}else{
 $query = "INSERT INTO users (name,phone,email,password,verify_token) VALUES ('$name','$phone','$password','$verify_token')";
 $query_run = mysqli_query($con, $query);
if($query_run)
{
    sendemail_verify("$name","$email","$verify_token");

    $_SESSION['status'] = "Registration Successfull! Please verify your Email Address.";
    header("Location: register.php");
}
else{
    $_SESSION['status'] = "Registration Failed";
    header("Location: register.php");
}
}*/
?>