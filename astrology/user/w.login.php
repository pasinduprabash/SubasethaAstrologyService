<?php
session_start();
require 'db_connect.php';

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT user_id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {  
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            sleep(5);
            header("Location: w.index.php");
            exit;
        } else {
            $errorMsg = "Incorrect password.";
        }
    } else {
        $errorMsg = "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

     <style>
        body {
            background-image: url('img/bg2.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center; 
            background-size: cover;
        }

        .center-section {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus {
            border-color: #ff5a5f;
            outline: none;
            background-color: #fff;
        }

        .btn-register {
            width: 100%;
            padding: 12px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #ff5a5f;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-register:hover {
            background-color: #e14c4f;
        }
    </style>

</head>
<body>

    <div class="container">
        <div class="center-section">
            <h2 class="form-title">Log In</h2>

                <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
                <?php endif; ?>  

            <form method="POST" action="">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email Address" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-register">Log In</button>
                </div>
            </form>

            <h6 class="text-center">Still don't have an account?</h6>
            <center><a href="w.sign_up.php">Sign Up here</a></center>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
