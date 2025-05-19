<?php
session_start();
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("User ID not provided.");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM marriage_reg WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        body{
            background-color: #eee ;
        }
        .nav-link {
            color: white;
            margin-left: 30px;
        }

        .nav-link:hover {
            color: white;
        }

        footer {
            color: black;
            padding: 10px 5px;
            text-align: center;
        }

    </style>
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <h4 class="form-title m-0">Subasetha Astrology Service</h4>

            <ul class="nav col-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="w.index.php" class="nav-link text-white">Home</a></li>
                <li><a href="w.pricing.php" class="nav-link text-white">Pricing</a></li>
                <li><a href="w.about_us.php" class="nav-link text-white">About Us</a></li>
                <li><a href="w.contact_us.php" class="nav-link text-white">Contact Us</a></li>
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
                            <li><a class="dropdown-item" href="w.services.php"><i class="bi bi-briefcase"></i> My Services</a></li>
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

<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <?php if ($user): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_photo'] ?? 'default-avatar.png'); ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo htmlspecialchars($user['name'] ?? 'N/A'); ?></h5>
                            <p class="text-muted mb-1"><strong>Age : </strong><?php echo htmlspecialchars($user['age'] ?? 'N/A'); ?> Years Old</p>

                            <h6>
                            <p class="text-muted mb-1"><strong>Mobile : </strong><?php echo ($user['phone'] ?? 'N/A'); ?>
                            </p>
                        </h6>

                        <?php else: ?>
                            <p class="text-danger">User not found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item p-3">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0"><strong>About Me :</strong></p>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['bio']); ?></p>
                                    </div>
                                </div>    
                            </li>
                        </ul>
                    </div>
                </div>
            
            </div>
<div class="col-lg-8">
    <div class="card mb-4">
        <div class="card-body">
            <?php if ($user): ?>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Full Name:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['name']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Gender:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['gender']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Profession:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['profession']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Nationality:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['nationality']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Religion:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['religion']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Caste:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['caste']); ?></p>
                    </div>
                </div>   
                <hr>
                <div class="row">
                     <div class="col-sm-6">
                        <p class="mb-0"><strong>Relationship Status:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['relationship_status']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Educational Level:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['education_level']); ?></p>
                    </div>             
                </div>
                <hr>
                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-0"><strong>Mother Profession:</strong></p>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['mother_profession']); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-0"><strong>Father Profession:</strong></p>
                                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['father_profession']); ?></p>
                                    </div>
                                </div> 
                        <hr>    
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Monthly Income:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['monthly_Income']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Height (cm):</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['height']); ?></p>
                    </div>                       
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Weight (Kg):</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['weight']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Hobbies:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['hobbies']); ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Smoking Habits:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['smoking']); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><strong>Drinking Habits:</strong></p>
                        <p class="text-muted mb-0"><?php echo htmlspecialchars($user['drinking']); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-danger">No user details available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>

     <footer>
        <div class="footer">
            &copy; 2025 Subasetha Astrology Service. All Rights Reserved.
        </div>
    </footer>

</section>

</body>
</html>
