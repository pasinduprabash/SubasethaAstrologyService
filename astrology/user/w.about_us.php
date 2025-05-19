<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In/Sign Up Form</title>
    
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

        .about_us{
            max-width: 600px;
            text-align: center;
            margin-top: 20px;
            margin-left: 80px;
        }

         .right-section {
                position: absolute;
                top: 50%;
                left: 5%; 
                transform: translateY(-50%); 
                width: 100%;
                height: 100%;
                max-width: 400px;
                max-height: 520px;
                background-color: #fff;
                padding: 30px;
                border-radius: 15px;
                margin-top: 45px;
                margin-left: 750px;
        }

        .nav-link{
            color: white;
            margin-left: 30px;
        }

        .nav-link:hover{
            color: white;
        }

        .form-title {
            color: white;
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

        footer {
            color: #B2BEB5;
            padding: 20px 5px;
            text-align: center;
            margin-top: 20px;
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
            <h5 class="form-title m-0"><a href="w.index.php">Subasetha Astrology Service</a></h5>

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
    
    <div class="about_us">
    <div class="container">
        <br><h5><strong>About Us – Subasetha Astrology Service</strong></h5>
        <p>
            At Subasetha Astrology Service, we specialize in traditional Sri Lankan and Vedic astrology to help guide you through life's journey. Most of our services, especially in matters of relationships, focus on finding the right partner through horoscope matching. We believe that understanding astrological compatibility is key to fostering successful and harmonious relationships.
        </p>

        <h5><strong>Why Choose Us?</strong></h5>
        <p>
            Experienced astrologers with expertise in Sri Lankan and Vedic astrology.<br>
            Accurate, scientific predictions and customized remedies.<br>
            Specializing in horoscope matching for finding the right partner.<br>
            Online and in-person consultations available worldwide.<br>
        </p>

        <h5><strong>Our Services</strong></h5>
        <p>
            Wedding date Selection.<br>
            Personalized Birth Chart Analysis.<br>
            Marriage Compatibility (Porondam Matching).<br><br>
        </p>

        <strong>Subaseth Astrology Service</strong><br>
        No.639/C Kithulawa Kaluthara South.<br>
        Tele No 
        
    </div>
</div>

    <div class="container">
    <div class="right-section">

    <h5><center><strong>Contact Us</strong></center></h5>    
    <form action="w.contact_us.php" method="POST">
        <label for = "full_name">Full Name</label>
        <input type="text" name="full_name" id="full_name">

        <label for="Email">Email</label>
        <input type="email" name="email" id="email">

        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone">

        <div class = "form-group">
        <label for="Message">Message</label>
        <textarea id="message" name="message" rows="4" cols="43" required></textarea>
        </div>

         <input type="submit" class = "btn-register" name="Submit">
    </form>
</div>
</div>

    <!-- Footer Section -->
    <br><footer>
        <p>&copy; 2024 Subasetha Astrology Service. All Rights Reserved.</p>
    </footer>

</body>
</html>
