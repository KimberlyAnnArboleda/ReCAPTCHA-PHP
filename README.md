# reCAPTCHA Implementation

This project implements Google reCAPTCHA v2 for a PHP-based website with registration, login, and contact forms. It includes session management, user registration, login/logout functionality, and contact form verification.

### Features
- User registration and login with session management.
- reCAPTCHA v2 verification on both contact and login pages.
- Form validation and input sanitization.
- Pink and white themed UI using Bootstrap.

### Setup Instructions

1. Clone the repository.
2. Modify a `config.php` file inside the `/includes/` folder (see `config.php` for guidance).
3. Obtain your Google reCAPTCHA keys from [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin).
4. Update your database credentials in `db.php` and run the SQL script to create the `kimberly_ann_arboleda_users` table.
5. Ensure that `config.php` contains the following information:

```
<?php
$config = [
    'recaptcha_site_key' => 'YOUR_SITE_KEY',
    'recaptcha_secret_key' => 'YOUR_SECRET_KEY'
];
?>
```

### Security Notes
- Replace placeholder keys with your actual reCAPTCHA keys.

### Author 
- **Kimberly Ann Arboleda**