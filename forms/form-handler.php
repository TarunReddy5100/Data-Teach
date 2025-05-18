<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST['first_name'] ?? ''));
    $lastName = htmlspecialchars(trim($_POST['last_name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $countryCode = htmlspecialchars(trim($_POST['country_code'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $graduationYear = htmlspecialchars(trim($_POST['graduation_year'] ?? ''));
    $experience = htmlspecialchars(trim($_POST['experience'] ?? ''));

    // Basic validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($graduationYear) || empty($experience)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.'); window.history.back();</script>";
        exit;
    }

    // Send email
    $to = "no-reply@datateach.ai";  // Replace with your real receiving email
    $subject = "New Callback Request";
    $message = "First Name: $firstName\n"
             . "Last Name: $lastName\n"
             . "Email: $email\n"
             . "Phone: $countryCode $phone\n"
             . "Graduation Year: $graduationYear\n"
             . "Experience: $experience\n";

    $headers = "From: no-reply@datateach.ai";

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Thank you! Your request has been submitted.'); window.history.back();</script>";
    } else {
        echo "<script>alert('Error sending your request. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.history.back();</script>";
}
?>
