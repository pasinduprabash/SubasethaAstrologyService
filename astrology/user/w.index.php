<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subasetha Astrology | Home</title>

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
        
        .nav-link{
            color: white;
            margin-left: 30px;
        }

        .nav-link:hover{
            color: white;
        }

        .services {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card h3 {
            margin: 20px 0 10px;
            color: #333;
        }
        .card p {
            color: #666;
            padding: 0 15px 20px;
        }

        .card a {
            text-decoration: none; 
            color: inherit;       
            display: block;       
        }

        .card a:hover {
            color: inherit;
        }

        .news-bar {
            background-color: #333;
            color: #fff;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            padding: 10px 0;
        }
        .news-bar .news-content {
            display: inline-block;
            animation: scroll 25s linear infinite;
        }
        .news-bar a {
            text-decoration: none;
            color: white;
            margin: 0 30px;
        }
        .news-bar a:hover {
            color: #fff;
        }

        @keyframes scroll {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }    

        .projects {
            padding: 40px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .section-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            display: inline-block;
            padding-bottom: 10px;
        }

        .project-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .project-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 280px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            text-align: center;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .project-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .project-card h3 {
            margin: 15px 0;
            color: #333;
            font-size: 20px;
        }

        .project-card p {
            color: #666;
            padding: 0 15px 15px;
            font-size: 14px;
        }

        .testimonials {
            padding: 60px;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            text-align: center;
            color: #333;
        }

        .section-title {
            font-size: 32px;
            color: #222;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .testimonials-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .testimonial {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonial:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .testimonial img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            float: left;
            margin-right: 15px;
            border: 2px solid #ddd;
        }

        .testimonial p {
            margin: 10px 0 15px 0;
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }

        .testimonial h3 {
            font-size: 18px;
            color: #111;
            font-weight: bold;
            margin: 0;
        }

        .testimonial .quote {
            font-size: 36px;
            color: #555;
            font-weight: bold;
            float: left;
            margin-right: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 40px 20px;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-column {
            flex: 1 1 200px;
            margin: 10px;
        }

        .footer-column h3 {
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #555;
            padding-bottom: 5px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            text-decoration: none;
            color: #ddd;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: #fff;
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .footer-social a {
            color: #ddd;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #fff;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #aaa;
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

 <br><div class="news-bar">
        <div class="news-content">
            <a href="#news1">Register now for free to find a suitable partner for your life (Subasetha Marriage Service)</a>
        </div>
    </div>

<section class="services">
        <div class="card">
            <a href="w.marriage_proposal.php">
            <img src="img/img7.jpg" alt="Service 2">
            <h5><br>Marriage Proposals</h5>
            <h6><center>(Subasetha Marriage Service)</center></h6>
            <p><br>Marriage proposals help to elevate your love and relationship to the next level. A proposal is a message that reflects love, consent, and expectations for the future.</p>
        </a>
        </div>
         <div class="card">
            <a href="w.horascope_match.php">
            <img src="img/img4.jpg" alt="Service 3">
            <h5><br>Horoscope Matching</h5>
            <h6><center>(Subasetha Horoscope Service)</center></h6>
            <p><br>Horoscope matching is a Sinhala cultural practice to check compatibility within marriage. It examines factors like family life, economy, health, and personal characteristics.</p>
        </a>
        </div>
         <div class="card">
            <a href="w.find_your_partner.php">
            <img src="img/img8.jpg" alt="Service 2">
            <h5><br>Suitable Partner for Horoscope</h5>
            <h6><center>(Subasetha Horoscope Service)</center></h6>
            <p><br>Finding a suitable partner means considering your desires, concepts, and mental state. Astrology provides guidance to find a compatible partner for a healthy relationship.</p>
        </a>
        </div>
        <div class="card">
            <a href="w.wedding_date.php">
            <img src="img/img9.jpg" alt="Service 2">
            <h5><br>Wedding Date Selection</h5>
            <h6><center>(Subasetha Horoscope Service)</center></h6>
            <p><br>Choosing the right wedding date based on astrology ensures a prosperous married life.</p>
        </a>
        </div>
</section>

<section class="projects">
    <h2 class="section-title">Successful Projects Completed</h2>
    <div class="project-cards">
        <div class="project-card">
            <h3>Ideal Life Partner Analysis</h3>
            <p>Helped over 800 individuals find their perfect life partners using astrological insights.</p>
        </div>
        <div class="project-card">
            <h3>Relationship Compatibility Reports</h3>
            <p>Generated detailed compatibility reports for more than 600 couples to ensure a strong bond.</p>
        </div>
        <div class="project-card">
            <h3>Astrological Marriage Counseling</h3>
            <p>Provided guidance to 300+ couples to strengthen their marriage through astrology.</p>
        </div>
        <div class="project-card">
            <h3>Lucky Wedding Dates</h3>
            <p>Suggested auspicious wedding dates for over 400 couples for a prosperous married life.</p>
        </div>
    </div>
</section>

    <section class="testimonials">
    <h2 class="section-title">What Our Clients Say</h2>
    <div class="testimonials-container">
        <div class="testimonial">
            <img src="img/client1.jpg" alt="Client 1">
            <p><span class="quote">“</span>It was a pleasure to work with Subasetha Astrology. They helped me find the perfect partner, and my marriage life has been fulfilling ever since. I highly recommend their service!</p>
            <h3>Nimasha Athukorala</h3>
        </div>
        <div class="testimonial">
            <img src="img/client2.jpg" alt="Client 2">
            <p><span class="quote">“</span>The horoscope matching service helped me make an informed decision about my marriage. It was a smooth and successful experience, and I’m grateful for the guidance!</p>
            <h3>Sahan Iduwara</h3>
        </div>
        <div class="testimonial">
            <img src="img/client3.jpg" alt="Client 3">
            <p><span class="quote">“</span>Choosing the right wedding date was essential, and Subasetha made sure it was the best. Their expert advice ensured a joyful wedding celebration.</p>
            <h3>Ramesh Balasuriya</h3>
        </div>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Contact Us</h3>
            <ul>
                <li><a href="#">+946397658</a></li>
                <li><a href="#">info@subasetha.com</a></li>
                <li><a href="#">123 Subasetha St., Colombo</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Follow Us</h3>
            <div class="footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Subasetha Astrology | All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
