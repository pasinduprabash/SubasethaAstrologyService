<?php
session_start ();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing</title>

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

        .nav-link{
            color: white;
            margin-left: 30px;
        }

        .nav-link:hover{
            color: white;
        }

        .form-title a {
            text-decoration: none;
            color: inherit;
        }

        .row {
          margin-top: 20px;
          margin-left: 20px;
        }

        .card {
          border-radius: 10px;
          box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
          transition: transform 0.3s ease-in-out;
          width: 350px;
          height: 280px;
          margin-bottom: 20px;
        }

        .card:hover {
          transform: translateY(-5px);
        }

        .card-body {
          text-align: center;
          padding: 20px;
        }

        .card-title {
          font-size: 1.25rem;
          font-weight: bold;
          color: #333;
        }

        .card-text {
          color: #666;
        }

        .btn-primary {
          background-color: #007bff;
          border-color: #007bff;
          border-radius: 5px;
        }

        .btn-primary:hover {
          background-color: #0056b3;
          border-color: #004085;
        }

    footer {
            color: #B2BEB5;
            padding: 20px 5px;
            text-align: center;
            margin-top: 50px;
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
</header><br>

<div class="container">
<div class = "row">    
<div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Marriage Proposals</h5>
        <p class="card-text">Marriage proposals help elevate your love and relationship to a whole new level. Proposing a marriage is a message of love, affection, and future aspirations combined.</p>
        <button type = "button" class="btn btn-danger">Free</button>
      </div>
    </div>
  </div>    

<div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Horoscope Matching</h5>
        <p class="card-text">Horoscope matching is a cultural practice in Sinhala traditions. It helps to determine whether a harmonious and lasting relationship can be built within the marriage.</p>
        <button type = "button" class="btn btn-danger">Rs.2000.00</button>
      </div>
    </div>
  </div>

<div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Suitable Partner for Horoscope</h5>
        <p class="card-text">When finding your perfect match, it's important to consider your personality, preferences, and mental state. Astrology guides you in this process to help you find the right partner.</p>
        <button type = "button" class="btn btn-danger">Rs.2000.00</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
<div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Wedding Date Selection</h5>
        <p class="card-text">Astrology can guide you in selecting the most auspicious wedding date, considering various astrological factors to ensure the best outcome for your marriage.</p>
        <button type = "button" class="btn btn-danger">Rs.2000.00</button>
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

</body>
</html>
