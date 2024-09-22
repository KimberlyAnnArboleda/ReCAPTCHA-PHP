<?php
session_start();
require 'includes/db.php';
require 'includes/config.php'; // Load the reCAPTCHA keys from config.php
$title = "Contact";
require 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $secretKey = $config['recaptcha_secret_key']; // Get secret key from config.php
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // reCAPTCHA verification
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        // Process form submission (e.g., send an email)
        echo "<div class='alert alert-success'>Thank you for contacting us, $name.</div>";
    } else {
        echo "<div class='alert alert-danger'>reCAPTCHA verification failed. Please try again.</div>";
    }
}
?>

<h2>Contact Us</h2>
<form action="contact.php" method="POST">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
    </div>
    <!-- reCAPTCHA widget -->
    <div class="g-recaptcha" data-sitekey="<?php echo $config['recaptcha_site_key']; ?>"></div> <!-- Get site key from config.php -->
    <br/>
    <button type="submit" class="btn btn-pink">Submit</button>
</form>

<?php require 'includes/footer.php'; ?>