<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    if (empty($email)) {
        $error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            // In a real application, you would:
            // 1. Generate a unique token
            // 2. Store it in the database with an expiration time
            // 3. Send an email to the user with a link containing the token
            
            // For demonstration purposes:
            $success = "If your email exists in our system, you will receive password reset instructions shortly.";
            
            // In a real application, uncomment this code and implement email sending
            /*
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
            $stmt->execute([$token, $expires, $email]);
            
            // Send email with reset link
            $reset_link = "http://yourdomain.com/reset_confirm.php?token=$token";
            mail($email, "Password Reset Request", "Click the following link to reset your password: $reset_link");
            */
        } else {
            // Don't reveal if the email exists for security reasons
            $success = "If your email exists in our system, you will receive password reset instructions shortly.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Reset Password | Modern Login System</title>
    <style>
    .reset-container {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        padding: 40px;
        width: 400px;
        max-width: 100%;
        text-align: center;
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: #512da8;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="reset-container">
        <h1>Reset Your Password</h1>
        <p>Enter your email address and we'll send you instructions to reset your password.</p>

        <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
        <?php else: ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="email" placeholder="Your Email Address" required>
            <button type="submit">Send Reset Instructions</button>
        </form>
        <?php endif; ?>

        <a href="index.php" class="back-link">Back to Login</a>
    </div>
</body>

</html>