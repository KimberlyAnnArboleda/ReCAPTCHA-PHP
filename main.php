<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = "Main Page";
require 'includes/header.php';
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
<p>This is your main page after login.</p>

<?php require 'includes/footer.php'; ?>