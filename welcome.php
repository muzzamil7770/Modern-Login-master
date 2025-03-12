<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Welcome | Modern Login System</title>
    <style>
    .welcome-container {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        padding: 40px;
        text-align: center;
        max-width: 600px;
        width: 100%;
    }

    h1 {
        color: #512da8;
        margin-bottom: 20px;
    }

    .welcome-message {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .user-info {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: left;
    }

    .logout-btn {
        background-color: #512da8;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .logout-btn:hover {
        background-color: #4527a0;
    }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>

        <div class="welcome-message">
            You have successfully logged into your account.
        </div>

        <div class="user-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>

</html>