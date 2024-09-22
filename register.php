<?php
session_start();
require 'includes/db.php';
require 'includes/config.php'; // Load reCAPTCHA keys
$title = "Register";
require 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $secretKey = $config['recaptcha_secret_key']; // Get secret key from config.php
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    // reCAPTCHA verification
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        // Sanitize and hash inputs
        $username = htmlspecialchars($_POST['username']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Insert the user into the database
        $stmt = $pdo->prepare("INSERT INTO kimberly_ann_arboleda_users (username, email, `password`) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            echo "<div class='alert alert-success'>Registration successful!</div>";
        } else {
            echo "<div class='alert alert-danger'>Registration failed. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>reCAPTCHA verification failed. Please try again.</div>";
    }
}
?>

<h2>Register</h2>
<form action="register.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <!-- reCAPTCHA widget -->
    <div class="g-recaptcha" data-sitekey="<?php echo $config['recaptcha_site_key']; ?>"></div>
    <br/>
    <button type="submit" class="btn btn-pink">Register</button>
</form>

<?php require 'includes/footer.php'; ?>