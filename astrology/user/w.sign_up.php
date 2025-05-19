<?php
include "db_connect.php";

$showAlert = false;
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $full_name, $email, $password);

        if ($stmt->execute()) {
            $showAlert = true;
        } else {
            $errorMsg = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>

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


        .form-title{
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group{
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus, select:focus {
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
        <h2 class="form-title">Sign Up</h2>

        <?php if ($showAlert) : ?>
            <div class="alert alert-success" role="alert">
            <strong>Successfully Registered !... Please Log In</strong>
            </div>
        <?php endif; ?>    

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" class="form-control" placeholder="Enter Your Full Name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-register">Sign up</button>
            </div>

            <h6 class="text-center">Already Have an Account?</h6>
            <center><a href="w.login.php">Login here</a></center>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
