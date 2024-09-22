<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title ?? "") . " ". base64_decode("S2ltYmVybHkgQW5uIEFyYm9sZWRhIFdlYnNpdGU="); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffe6f1;
            color: #ff5ea6;
        }
        .btn-pink {
            background-color: #ff5ea6;
            color: white;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff5ea6;">
    <a class="navbar-brand" href="#" style="color: white;">My Website</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="main.php" style="color: white;">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" style="color: white;">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" style="color: white;">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php" style="color: white;">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container">