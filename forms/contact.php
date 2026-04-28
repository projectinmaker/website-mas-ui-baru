<?php
// Pastikan request method POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Ambil data form
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Validasi sederhana
  if ( empty($name) || empty($email) || empty($subject) || empty($message) ) {
    echo "Please complete all fields.";
    exit;
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
  }

  // Email tujuan (ganti ke email kamu)
  $to = "office@masconsulting.co.id";

  // Header email
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

  // Kirim email
  if (mail($to, $subject, $message, $headers)) {
    echo "OK"; // Penting → validate.js akan menampilkan sent-message
  } else {
    echo "Failed to send email. Please try again.";
  }

} else {
  echo "Invalid request.";
}
?>
