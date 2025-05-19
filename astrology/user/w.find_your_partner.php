<?php
session_start();
include "db_connect.php";

if (isset($_SESSION['user_id'])) {
    $loggedInUser = $_SESSION['user_id'];
} else {
    header("Location: w.login.php");
    exit;
}

$showAlert = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $nakatha = $_POST['nakatha'];
    $dob = $_POST['dob'];
    $pob = $_POST['pob'];
    $tob = $_POST['tob'];

    $service_name = "Find your Partner";
    $price = "2000";

    $sql = "INSERT INTO find_your_partner (user_id, full_name, phone, gender, nakatha, dob, pob, tob, service_name,price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("isssssssss", $loggedInUser, $full_name, $phone, $gender, $nakatha, $dob, $pob, $tob, $service_name, $price);


    if ($stmt->execute()) {
        $showAlert = true;
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Your Partner</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('img/bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .left-section {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 2px;
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

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #ff5a5f;
            outline: none;
            background-color: #fff;
        }

        button.btn-register {
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

        button.btn-register:hover {
            background-color: #e14c4f;
        }
        
    </style>
</head>
<body>

<div class="container">
    <div class="left-section">
        <h2 class="form-title">Register to Find Your Match</h2>

        <form action="w.find_your_partner.php" method="POST">

        <?php if ($showAlert): ?>

            <div class="alert alert-success" role="alert">
            <strong>Successfully Added to My Services !</strong> <a href="w.services.php" class="alert-link"><br>My Services</a>
            </div>

            <?php endif; ?>
            
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter Your Full Name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="phone" id="phone" name="phone" class="form-control" placeholder="Enter your Phone" required>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="" disabled selected>Select your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                </div>
                <div class="col-md-6">
                    <label for="nakatha">Born Nakatha: </label>
                    <select id="nakatha" name="nakatha" class="form-control">
                        <option value="" disabled selected>Select Nakatha</option>
                        <option value="අස්විද">අස්විද</option>
                        <option value="බෙරණ">බෙරණ</option>
                        <option value="කැති">කැති</option>
                        <option value="රෙහෙන">රෙහෙන</option>
                        <option value="මුවසිරස">මුවසිරස</option>
                        <option value="අද">අද</option>
                        <option value="පුනාවස">පුනාවස</option>
                        <option value="පුෂ">පුෂ</option>
                        <option value="අස්ලිය">අස්ලිය</option>
                        <option value="මා">මා</option>
                        <option value="පුවපල්">පුවපල්</option>
                        <option value="උතුරුපල්">උතුරුපල්</option>
                        <option value="හත">හත</option>
                        <option value="සිත">සිත</option>
                        <option value="සා">සා</option>
                        <option value="විසා">විසා</option>
                        <option value="අනුර">අනුර</option>
                        <option value="දෙට">දෙට</option>
                        <option value="මුල">මුල</option>
                        <option value="පුවසල">පුවසල</option>
                        <option value="උතුරුසල">උතුරුසල</option>
                        <option value="සුවණ">සුවණ</option>
                        <option value="දෙනට">දෙනට</option>
                        <option value="සියාවස">සියාවස</option>
                        <option value="පුවපුටුප">පුවපුටුප</option>
                        <option value="උත්‍රපුටුප">උත්‍රපුටුප</option>
                        <option value="රේවතී">රේවතී</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pob">Place of Birth (Need Complete Address)</label>
                <input type="text" id="pob" name="pob" class="form-control" placeholder="Ex:- No.23, Deshamanya H.K Dharmadasa Mawatha, Colombo" required>
            </div>
            <div class="form-group">
                <label for="tob">Time of Birth (24Hrs)</label>
                <input type="time" id="tob" name="tob" class="form-control" placeholder="Ex:- 14:05" required>
            </div>
            <button type="submit" class="btn-register">Register</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
