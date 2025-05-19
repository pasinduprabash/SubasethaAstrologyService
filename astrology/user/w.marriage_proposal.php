<?php

session_start();

include "db_connect.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : '';

$limit = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$profiles = [];

if ($type == 'male' || $type == 'female') {
    $sql = "SELECT * FROM marriage_reg WHERE gender = '$type' LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }

    $count_sql = "SELECT COUNT(*) as total FROM marriage_reg WHERE gender = '$type'";
    $count_result = $conn->query($count_sql);
    $count_row = $count_result->fetch_assoc();
    $total_records = $count_row['total'];
    $total_pages = ceil($total_records / $limit);
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Marriage Proposal</title>
    
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

        .form-title a{
            text-decoration: none;
            color: inherit;
        }

        .nav-link{
            color: white;
            margin-left: 30px;
        }

        .nav-link:hover{
            color: white;
        }

        .btn1 {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn1:hover {
            background-color: #c82333;
        }

        .btn2 {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: blue;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn2:hover {
            background-color: #00008B;
        }

        .btn3 {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: green;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn3:hover {
            background-color: #006400;
        }

        footer {
            margin-top: 50px;
            color: black;
            width: 100%;
            z-index: 1000;
            text-align: center;
            font-size: 15px;
        }

        .form-container {
            margin-top: 20px;
            text-align: center;
        }

        .form-container form {
            display: inline-block;
            text-align: left;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .profile-card {
            width: 220px;
            height: 320px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
            text-align: center;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .profile-card .profile-img img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-card h5 {
            font-size: 1rem;
            margin-top: 10px;
        }

        .profile-card p {
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .interest-btn {
            padding: 8px 16px;
            font-size: 0.85rem;
        }


        a {
  			text-decoration: none;
		}

    </style>
</head>

<body>

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
            <h5 class="form-title m-0"><a href ="w.index.php">Subasetha Astrology Service</a></h5>

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

    <div class="container">
        <br>
        <h6>
            <center>I am Looking For</center>
        </h6>

        <center>
            <form method="get" action="">
                <button type="submit" name="type" value="male" class="btn1">Husband</button>
                <button type="submit" name="type" value="female" class="btn2">Wife</button>
                <a href="w.marrage_reg.php" class="btn3">Register</a>
            </form>
        </center>

        <br><div id="results" style="margin-top: 20px; text-align: center;">

            <?php
            if ($type == 'male' || $type == 'female') {
                if (count($profiles) > 0) {
                    echo '<div class="row justify-content-center">'; // Center align cards
                    foreach ($profiles as $profile) {
                        echo '<div class="col-md-3 col-sm-6 mb-4">'; // 4 cards in a row on medium+ screens
                        echo '<div class="profile-card">';
						echo '<div class="profile-img">';
						echo '<img src="' . $profile['profile_photo'] . '" alt="Profile Image">';
						echo '</div>';
						echo '<h5>' . $profile['name'] . '</h5>';
						echo '<p><strong>Age: </strong> ' . $profile['age'] . '</p>';
						echo '<p><strong>Profession: </strong> ' . $profile['profession'] . '</p>';
                        echo '<p><strong>Nationality: </strong> ' . $profile['nationality'] . '</p>';
                        echo '<p><strong>Religion: </strong> ' . $profile['religion'] . '</p>';
                        echo '<p><strong>Education Level: </strong> ' . $profile['education_level'] . '</p>';


						// Update the link to the profile detail page
						echo '<a href="w.view_profile.php?id=' . $profile['id'] . '" class="interest-btn">View Profile</a>';
						echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No results found.</p>';
                }

                // Pagination links
                echo '<div class="pagination">';
                if ($page > 1) {
                    echo '<a href="?type=' . $type . '&page=' . ($page - 1) . '" class="btn btn-primary">Previous</a>';
                }

                if ($page < $total_pages) {
                    echo '<a href="?type=' . $type . '&page=' . ($page + 1) . '" class="btn btn-primary">Next</a>';
                }

                echo '</div>';
            }
            ?>
        </div>
    </div> <!-- End of .container -->

    <footer>
        <div class="footer">
            &copy; 2025 Subasetha Astrology Service. All Rights Reserved.
        </div>
    </footer>

</body>

</html>
