<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input fields
    $name = filter_var(trim($_POST["name"] ?? ''), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"] ?? ''), FILTER_SANITIZE_STRING);
    $subject_type = filter_var(trim($_POST["subject"] ?? 'General Enquiry'), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"] ?? ''), FILTER_SANITIZE_STRING);

    // Check required fields
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Recipient email address
    $to = "kaustubh@nammaashram.com, parthbuilds@gmail.com";

    // Email subject and body
    $subject = "Namma Ashram Website Enquiry: [$subject_type] from $name";
    $body = "You have received a new enquiry from Namma Ashram contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Enquiry Type: $subject_type\n\n";
    $body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (@mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent. Our team will get back to you shortly.";
    } else {
        echo "Thank you! Your enquiry has been received. Our team will contact you shortly.";
    }
} else {
    echo "Invalid request.";
}
?>
