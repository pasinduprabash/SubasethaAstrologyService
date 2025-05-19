<?php
session_start();

include "db_connect.php";

if (isset($_SESSION['user_id'])) {
    $loggedInUser = $_SESSION['user_id'];
} else {
    header("Location: w.login.php");
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$showAlert =false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boy_full_name = $_POST['boy_full_name'];
    $boy_phone = $_POST['boy_phone'];
    $boy_dob = $_POST['boy_dob'];
    $boy_pob = $_POST['boy_pob'];
    $boy_tob = $_POST['boy_tob'];
    $boy_nakatha = $_POST['boy_nakatha']; 
    $girl_full_name = $_POST['girl_full_name'];
    $girl_phone = $_POST['girl_phone'];
    $girl_dob = $_POST['girl_dob'];
    $girl_pob = $_POST['girl_pob'];
    $girl_tob = $_POST['girl_tob'];
    $girl_nakatha = $_POST['girl_nakatha']; 

    $service_name = "Horoscope Matching";
    $price = "2000";

    $sql = "INSERT INTO horoscope_matching(user_id, boy_full_name, boy_phone, boy_dob, boy_pob, boy_tob, boy_nakatha, girl_full_name, girl_phone, girl_dob, girl_pob, girl_tob, girl_nakatha, service_name, price) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssssssssss", $loggedInUser, $boy_full_name, $boy_phone, $boy_dob, $boy_pob, $boy_tob, $boy_nakatha, $girl_full_name, $girl_phone, $girl_dob, $girl_pob, $girl_tob, $girl_nakatha, $service_name, $price);
        
        if ($stmt->execute()) {
            $showAlert = true;
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Prepared statement error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horascope Match</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url('img/bg3.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .left-section {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 2px;
        }

        .form-title {
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
            <h5 class="form-title">Horoscope (Boy Side)</h5>

            <?php if ($showAlert): ?>

            <div class="alert alert-success" role="alert">
            <strong>Successfully Added to My Services !</strong> <a href="w.services.php" class="alert-link">My Services</a>
            </div>

            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="boy_full_name">Full Name</label>
                        <input type="text" id="boy_full_name" name="boy_full_name" class="form-control" placeholder="Enter Your Full Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="boy_phone">Phone Number</label>
                        <input type="text" id="boy_phone" name="boy_phone" class="form-control" placeholder="Enter your Phone Number" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="boy_dob">Date of Birth</label>
                        <input type="date" id="boy_dob" name="boy_dob" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="boy_pob">Place of Birth: </label>
                        <input type="text" id="boy_pob" name="boy_pob" class="form-control" placeholder="Enter Your Address" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="boy_tob">Time of Birth (24Hrs): </label>
                        <input type="time" id="boy_tob" name="boy_tob" class="form-control" required>
                    </div>

                <div class="col-md-6">
                    <label for="boy_nakatha">Born Nakatha: </label>
                    <select id="boy_nakatha" name="boy_nakatha" class="form-control">
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

                <h5 class="form-title">Horoscope (Girl Side)</h5>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="girl_full_name">Full Name</label>
                    <input type="text" id="girl_full_name" name="girl_full_name" class="form-control" placeholder="Enter Your Full Name" required>
                </div>
                <div class="col-md-6">
                    <label for="girl_phone">Phone Number</label>
                    <input type="text" id="girl_phone" name="girl_phone" class="form-control" placeholder="Enter your Phone Number" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="girl_dob">Date of Birth</label>
                    <input type="date" id="girl_dob" name="girl_dob" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="girl_pob">Place of Birth: </label>
                    <input type="text" id="girl_pob" name="girl_pob" class="form-control" placeholder="Enter Your Address" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="girl_tob">Time of Birth (24Hrs): </label>
                    <input type="time" id="girl_tob" name="girl_tob" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="girl_nakatha">Born Nakatha: </label>
                    <select id="girl_nakatha" name="girl_nakatha" class="form-control">
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

                <div class="btn-submit">
                    <button type="submit" class="btn-register">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>