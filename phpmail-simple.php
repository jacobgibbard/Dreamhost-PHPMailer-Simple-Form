<?php

// MAKE SURE you updated everything in !-*THESE*-!

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/!-*username*-!/PHPMailer/src/Exception.php';
require '/home/!-*username*-!/PHPMailer/src/PHPMailer.php';
require '/home/!-*username*-!/PHPMailer/src/SMTP.php';

$sendto = "!-*example@dreamhostemail.com*-!";

$firstname = substr(strip_tags(stripslashes($_POST['firstname'])), 0, 100);
$firstname = substr(strip_tags(stripslashes($_POST['firstname'])), 0, 100);
$email = substr(strip_tags(stripslashes($_POST['email'])), 0, 254);
$content = substr(strip_tags(stripslashes($_POST['message'])), 0, 2000);

// Some simple Date & Time JS

$date = date("l, F j, Y");
$time = date("g:i:s a");

// OPTION: Could also run in just an if method = POST statement. "You do you!" - Haley Townsend 

if ($HTTP_SERVER_VARS['REQUEST_METHOD'] == "GET") {
    echo "<h3>You can't get me!</h3>\n";
    echo "<p>If you see this, you can't get me bruh!</p>";
} elseif ($name != "" && $email != "" && $content != "") {
    $subject = "Contact Form Submission)";
    $checkbox = implode(", ", $_POST['cbarray']);
    $prepend = "This message was submitted by " .
            "$firstname $lastname ($email) on $date at $time\n" . str_repeat("-", 3) . "\n\n";
    $content = $prepend . $checkbox . "\n\n" . $content . "\n\n" . str_repeat("-", 3);
    

    $email = new PHPMailer(true);
    $email->isSMTP();                                      // Set mailer to use SMTP
    $email->SMTPDebug = 0;
    $email->Host = 'smtp.dreamhost.com';                  // Specify main and backup SMTP servers
    $email->SMTPAuth = true;                               // Enable SMTP authentication
    $email->Username = '!-*example@dreamhostemail.com*-!';             // SMTP username
    $email->Password = '!-*abracadabra*-!';                           // SMTP password
    $email->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
    $email->Port = 465;                                    // TCP port to connect to

    $email->SetFrom($sendto); //Name is optional
    $email->Subject   = $subject;
    $email->Body      = $content;
    
    $email->AddAddress($sendto);

    if($email->send()){header('Location: /success.html');}
    else{header('Location: /404.html');}
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Dreamhost Basic Simple PHPMailer Contact Form</title>
</head>
<body>
<h1>Contact us</h1>

    <form method="post">
        <label for="firstname">First name: <input type="text" name="firstname" id="firstname" maxlength="255" required></label><br>
        <label for="lasdtname">Last name: <input type="text" name="lasdtname" id="lasdtname" maxlength="255" required></label><br>
        <label for="email">Your email address: <input type="email" name="email" id="email" maxlength="255"></label><br>
        <input type="checkbox" name="cbarray[]" value="Checkbox 1">Checkbox 1<br>
        <input type="checkbox" name="cbarray[]" value="Checkbox 2">Checkbox 2<br>
        <input type="checkbox" name="cbarray[]" value="Checkbox 3">Checkbox 3<br>
        <label for="message">Your question:</label><br>
        <textarea cols="30" rows="8" name="message" id="message" placeholder="Your question" required></textarea><br>
        <button type="submit" value="Submit">Submit</button>
    </form>

</body>
</html>