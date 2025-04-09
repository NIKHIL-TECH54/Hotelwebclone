<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';

require 'Exception.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$mail = new PHPMailer(true);

	try {
		// SMTP config for Gmail
		$mail->isSMTP('nikhilverma90682@gmail.com');
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;

		// Gmail credentials (use App Password instead of real password)
		$mail->Username = "nikhilverma90682@gmail.com";
		$mail->Password = "l@mb@rd@r"; // use App Password here

		$mail->setFrom("nikhilverma90682@gmail.com", "My Portfolio");
		$mail->addAddress("rrrrrrrr3363@gmail.com");

		$mail->isHTML(true);
		$mail->Subject = "Portfolio Query";

		// Build the email content
		if (!empty($_POST['jmail'])) {
			$jmail = htmlspecialchars($_POST['jmail']);
			$mail->Body = "<h1>Join Mailing List Query</h1><p>Email: $jmail</p>";
		} else {
			$cf_name = htmlspecialchars($_POST['name'] ?? '');
			$cf_email = htmlspecialchars($_POST['email'] ?? '');
			$cf_subject = htmlspecialchars($_POST['subject'] ?? '');
			$cf_message = htmlspecialchars($_POST['message'] ?? '');

			$mail->Body = "<h1>Contact Form Query</h1>
                           <p><strong>Name:</strong> $cf_name</p>
                           <p><strong>Email:</strong> $cf_email</p>
                           <p><strong>Subject:</strong> $cf_subject</p>
                           <p><strong>Message:</strong> $cf_message</p>";
		}

		// Optional: Attach file if needed
		// $mail->addAttachment('/path/to/file');

		// Send mail
		$mail->send();
		echo json_encode(["status" => 1, "message" => "Mail sent successfully"]);
	} catch (Exception $e) {
		echo json_encode(["status" => 0, "message" => "Mailer Error: {$mail->ErrorInfo}"]);
	}
}
