<?php
session_start();
include "db_connect.php";

$message = '';
$alertType = '';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("Unauthorized access.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_type = $_POST['delete_type'] ?? '';

    if ($delete_type === 'marriage_profile') {
        $stmt = $conn->prepare("DELETE FROM marriage_reg WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $message = "Marriage profile deleted successfully.";
            $alertType = "success";
        } else {
            $message = "No marriage profile found or already deleted.";
            $alertType = "warning";
        }

        $stmt->close();

    } elseif ($delete_type === 'user_account') {
        $conn->begin_transaction();

        $stmt1 = $conn->prepare("DELETE FROM marriage_reg WHERE user_id = ?");
        $stmt1->bind_param("i", $user_id);
        $stmt1->execute();
        $stmt1->close();

        $stmt2 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt2->bind_param("i", $user_id);
        $stmt2->execute();
        $stmt2->close();

        if ($conn->commit()) {
            session_destroy();
            header("Location: w.login.php");
            exit;
        } else {
            $message = "Failed to complete deletion.";
            $alertType = "danger";
        }
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Checkout Page">
    <meta name="author" content="Company Name">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Settings</title>
    
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
            <!-- Logo -->
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"/>
                </svg>
            </a>

            <!-- Title -->
            <h5 class="form-title m-0"><a href ="w.index.php">Subasetha Astrology Service</h5>

            <!-- Navigation Menu -->
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
                <li><a class="dropdown-item" href="w.services.php"><i class="bi bi-person"></i> My Services</a></li>
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
</header>
<body>

<br>
<?php if (!empty($message)): ?>
    <div class="container">
    <div class="col-md-12">
    <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
        <?php echo $message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<div class="container"><br>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Marriage Profile</h5>
            <p class="card-text text-muted">Manage your marriage-related information. You can delete your Marriage profile permanently if you wish.</p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMarriageProfileModal">Delete Marriage Profile</button>
        </div>
    </div>

    <!-- User Account Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">My Account</h5>
            <p class="card-text text-muted">This will permanently remove your user account and all related data.</p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserAccountModal">Delete User Account</button>
        </div>
    </div>
</div>

<!-- Delete Marriage Profile Modal -->
<div class="modal fade" id="deleteMarriageProfileModal" tabindex="-1" aria-labelledby="deleteMarriageProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMarriageProfileModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your marriage profile? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="" method="post">
                    <input type="hidden" name="delete_type" value="marriage_profile">
                    <button type="submit" class="btn btn-outline-danger">Delete Marriage Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Account Modal -->
<div class="modal fade" id="deleteUserAccountModal" tabindex="-1" aria-labelledby="deleteUserAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserAccountModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your entire account? This action is permanent.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="" method="post">
                    <input type="hidden" name="delete_type" value="user_account">
                    <button type="submit" class="btn btn-outline-danger">Delete User Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>