<?php
// Prevent direct access to this file
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Direct access not allowed');
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Validate data
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    exit('All fields are required');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Invalid email format');
}

// Company email where you want to receive messages
$to = "info@hydrotechsolution.co.tz"; 

// Prepare email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Message:\n$message";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $email_content, $headers)) {
    echo 'success';
} else {
    echo 'error';
}
?>