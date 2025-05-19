<?php
session_start();
include "db_connect.php";

$successMessage = "";
$errorMessage = "";

if (empty($_SESSION['user_id']) || empty($_SESSION['email'])) {
    header("Location: w.login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    $stmt->close();
    header("Location: w.login.php");
    exit();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['delete_service']) && !empty($_POST['service_id'])) {
        $service_id = (int)$_POST['service_id'];
        $table = $_POST['service_table'] ?? '';
        $allowed_tables = ['marriage_reg', 'horoscope_matching', 'find_your_partner', 'wedding_date'];

        if (in_array($table, $allowed_tables)) {
            $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->bind_param("i", $service_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Deleted successfully from $table.";
            } else {
                $_SESSION['error'] = "Error deleting service.";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Invalid table.";
        }
    }

    if (!empty($_FILES['bank_slip']) && $_FILES['bank_slip']['error'] === 0) {
        $file = $_FILES['bank_slip'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];

        if (in_array($ext, $allowed)) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . "_" . basename($file['name']);
            $target = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                $_SESSION['message'] = "Bank slip uploaded successfully!";
            } else {
                $_SESSION['error'] = "File upload failed.";
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Only JPG, PNG, and PDF allowed.";
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$services = [];
$totalPrice = 0;
$tables = ['find_your_partner', 'horoscope_matching', 'wedding_date'];

foreach ($tables as $table) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $row['table_name'] = $table;
        $row['service_name'] = ucfirst(str_replace("_", " ", $table));
        $services[] = $row;
        $totalPrice += $row['price'];
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white; 
            margin: 0;
            padding: 0;
            color: #333;
        }
        .form-title a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body class="bg-light">

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"/>
                </svg>
            </a>
            <h5 class="form-title m-0"><a href="w.index.php">Subasetha Astrology Service</a></h5>
            <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="w.index.php" class="nav-link text-white">Home</a></li>
                <li><a href="w.pricing.php" class="nav-link text-white">Pricing</a></li>
                <li><a href="w.about_us.php" class="nav-link text-white">About Us</a></li>
                <li><a href="w.policies.php" class="nav-link text-white">Policies</a></li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['email'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?php echo $_SESSION['email']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="w.profile.php"><i class="bi bi-person"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="w.services.php"><i class="bi bi-list"></i> My Services</a></li>
                            <li><a class="dropdown-item" href="w.settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="w.login.php" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Log In</a>
                    <a href="w.sign_up.php" class="btn btn-secondary ms-2"><i class="bi bi-person-plus"></i> Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header><br>

<div class="container">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Services</span>
                <span class="badge bg-secondary rounded-pill"><?= count($services); ?></span>
            </h4>
            <ul class="list-group mb-3">
                <?php foreach ($services as $service): ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <strong><?= htmlspecialchars($service['service_name']); ?></strong>
                            <span class="text-muted d-block">Rs.<?= number_format($service['price'], 2); ?></span>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="service_id" value="<?= $service['id']; ?>">
                            <input type="hidden" name="service_table" value="<?= $service['table_name']; ?>">
                            <button type="submit" name="delete_service" value="1" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>Rs.<?= number_format($totalPrice, 2); ?></strong>
                </li>
            </ul>
        </div>

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Payment</h4>
            <hr class="mb-4">
            <h6>Bank Account Details</h6><br>
            Name: <strong>Pasindu Prabashwara</strong><br>
            Account Number: <strong>32557544758</strong><br>
            Bank Name and Branch: <strong>NSB Bank - Kaluthara</strong><br><br>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="bank-slip" class="form-label"><strong>Upload Bank Slip (PDF or Captured Photo)</strong></label>
                    <input type="file" class="form-control" id="bank-slip" name="bank_slip" required>
                </div>
                <button class="btn btn-primary" type="submit">Submit Payment</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
