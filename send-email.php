<?php
if (isset($_POST['submit'])) {
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $message = $_POST['message'];


    //validation for email
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        echo "<p class='error_message'>The email address you entered is not valid.</p>";
        exit;
    }

    //If everything above is ok then move further to send emails using PHPMailer

    //Use PHPmailer
    require "vendor/autoload.php";
    $mail = new PHPMailer\PHPMailer\PHPMailer;

    //Mailbody to send in an email
    $mailbody = '<h2>Customer contact details:-</h2>
	<p><b>Name:</b> ' . $name . '</p>
	<p><b>Email:</b> ' . $email . '</p>
	<p><b>Message:</b> ' . $message . '</p>';

    //Sender email address
    $sender = "manrabrar@gmail.com"; // Gmail SMTP username
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->SMTPDebug = 0; //See errors, change it to 4
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = $sender; // SMTP username
    $mail->Password = 'ifncboeysnpbzrcb'; // Gmail SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to	 

    $mail->setFrom($email, $name);

    $mail->addAddress('manrabrar@gmail.com', 'Manraj Brar'); // Add a recipient
    //$mail->addAddress('name@example.com'); //add more recipient (optional)
    $mail->addReplyTo($email, $name);
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Contact Form Submitted by ' . $name;
    $mail->Body = $mailbody;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //Email your contact form data using Gmail SMTP with PHPMailer
    if (!$mail->send()) {
        echo "Message could not be sent. Please try again.";
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "<p class='success_message'>Message has been sent successfully.</p>";
    }
}
?>