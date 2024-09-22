<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = "Main Page";
require 'includes/header.php';

// Query to get all users
$stmt = $pdo->query("SELECT username, email FROM kimberly_ann_arboleda_users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
<p>This is your main page after login.</p>

<h3>List of all users:</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'includes/footer.php'; ?>
