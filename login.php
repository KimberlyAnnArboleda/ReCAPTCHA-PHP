<?php
session_start();
require 'includes/db.php';
require 'includes/config.php'; // Load reCAPTCHA keys
$title = "Login";
require 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $secretKey = $config['recaptcha_secret_key']; // Get secret key from config.php
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // reCAPTCHA verification
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        $stmt = $pdo->prepare("SELECT * FROM `kimberly_ann_arboleda_users` WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: main.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Login failed. Invalid credentials.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>reCAPTCHA verification failed. Please try again.</div>";
    }
}
?>

<h2>Login</h2>
<form action="login.php" method="POST">
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
    <button type="submit" class="btn btn-pink">Login</button>
</form>

<?php require 'includes/footer.php'; ?>