<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subasetha Astrology Services</title>
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
        }

        /* Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #333;
            padding: 25px 30px;
            color: white;
        }

        .logo {
            font-size: 16px;
            text-align: center;
            font-weight: bold;
            width: 100%;
        }

        .menu-toggle {
            font-size: 28px;
            cursor: pointer;
        }

        /* Side Menu */
        .side-menu {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #444;
            padding-top: 60px;
            transition: 0.3s;
            z-index: 2;
        }

        .side-menu.active {
            left: 0;
        }

        .side-menu ul {
            list-style: none;
            padding: 0;
        }

        .side-menu ul li {
            padding: 15px;
            text-align: center;
        }

        .side-menu ul li a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            display: block;
        }

        .side-menu ul li:hover {
            background: #555;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 25px;
            cursor: pointer;
            color: white;
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            background-color: #f8f8f8;
        }

        /* Card Styles */
        .card {
            max-width: 450px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        /* Card Image */
        .card img {
            width: 100%;
            height: auto;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px ;
            border-bottom-left-radius: 12px;
        }

        /* Card Content */
        .card h4 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .card h5 {
            font-size: 16px;
            color: #777;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #555;
            padding: 0 15px 15px;
        }

        /* Anchor Tag */
        .card a {
            text-decoration: none;
            color: inherit;
            display: block;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .services {
                flex-direction: column;
                align-items: center;
            }
        }

        .projects {
                padding: 50px;
                background-color: #f9f9f9;
                text-align: center;
            }

            .section-title {
                font-size: 20px;
                color: #333;
                text-align: center;
                width: 100%;
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

            .project-card h5 {
                margin: 15px 0;
                color: #333;
                font-size: 20px;
            }

            .project-card p {
                color: #666;
                padding: 0 15px 15px;
                font-size: 14px;
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
                padding: 25px;
                max-width: 350px;
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
                text-align: center;
                width: 100%;
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
            padding: 20px 5px;
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

    <header>
    	<div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo">Subasetha Astrology Service</div>
    </header>

    <!-- Side Menu -->
    <div class="side-menu" id="sideMenu">
        <span class="close-btn" onclick="toggleMenu()">✖</span>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>

   <section class="services">
    <div class="card">
        <a href="m.marriage_proposal.php">
            <img src="img/img7.jpg" alt="Service 7">
            <h4><br><strong>Marriage Proposals</strong></h4>
            <h5><center>(Subasetha Marriage Service)</center></h5>
            <p><br>විවාහ යෝජනා මඟින් ඔබගේ ආදරය සහ සම්බන්ධතාවය එකම මට්ටමකට වර්දනයට උදව් කරයි. යෝජනාවක් සිදු කිරීම පණිවිඩයක් වන අතර, එය ආදරය, කැමැත්ත සහ අනාගතයට වූ බලාපොරොත්තු එකට පෙන්වයි.</p>
        </a>
    </div>
    <div class="card">
        <a href="m.horascope_match.php">
            <img src="img/img4.jpg" alt="Service 4">
            <h4><br><strong>Horoscope Matching</strong></h4>
            <p><br>පොරොන්දම් ගැලපීම යනු සිංහල සංස්කෘතික ආචාරයකි.විවාහය තුළ දී යහපත් සහසම්බන්ධතාවයක් පවත්වාගෙන යා හැකිද යන්න පරික්ෂා කිරීමය. මෙයට පවුල් ජීවිතය, ආර්ථිකය, සෞඛ්‍යය, සහ එකිනෙකාගේ ගුණාංගය බලපායි.</p>
        </a>
    </div>
    <div class="card">
        <a href="m.find_your_partner.php">
            <img src="img/img8.jpg" alt="Service 8">
            <h4><br><strong>Suitable Partner for Horoscope</strong></h4>
            <h5><center>(Subasetha Marriage Service)</center></h5>
            <p><br>ඔබේ හදවත පිරිසිදු වශයෙන් කැමති සහකරු/සහකාරිය සොයා ගැනීමේදී, ඔබගේ අභිප්‍රේරණ, සංකල්ප සහ මනෝභාවය, එක්ක ගැලපෙන විශේෂාංගයන් සලකා බැලීම වැදගත්ය. සුදුසු සහකරු/සහකාරිය සොයා ගැනීමේදී ජ්‍යෝතිෂ්‍ය ඒ සදහා මග පෙන්වීම සිදු කරයි</p>
        </a>
    </div>
    <div class="card">
        <a href="m.wedding_date.php">
            <img src="img/img9.jpg" alt="Service 8">
            <h4><br><strong>Wedding Date Selection</strong></h4>
            <h5><center>(Subasetha Horascope Service)</center></h5>
            <p><br>ඔබේ හදවත පිරිසිදු වශයෙන් කැමති සහකරු/සහකාරිය සොයා ගැනීමේදී, ඔබගේ අභිප්‍රේරණ, සංකල්ප සහ මනෝභාවය, එක්ක ගැලපෙන විශේෂාංගයන් සලකා බැලීම වැදගත්ය. සුදුසු සහකරු/සහකාරිය සොයා ගැනීමේදී ජ්‍යෝතිෂ්‍ය ඒ සදහා මග පෙන්වීම සිදු කරයි</p>
        </a>
    </div>
</section>

 <section class="projects">
    <h2 class="section-title"><strong>Successful Projects Completed</strong></h2>
    <div class="project-cards">
    <div class="project-card">
            <h5>Ideal Life Partner Analysis</h5>
            <p>Helped over 800 individuals find their perfect life partners using astrological insights.</p>
        </div>
        <div class="project-card">
            <h5>Relationship Compatibility Reports</h5>
            <p>Generated detailed compatibility reports for more than 600 couples to ensure a strong bond.</p>
        </div>
        <div class="project-card">
            <h5>Astrological Marriage Counseling</h5>
            <p>Provided guidance to 300+ couples to strengthen their marriage through astrology.</p>
        </div>
        <div class="project-card">
            <h5>Lucky Wedding Dates</h5>
            <p>Suggested auspicious wedding dates for over 400 couples for a prosperous married life.</p>
        </div>
    </div>
    </section>

    <section class="testimonials">
    <br><h2 class="section-title">What Our Clients Say</h2>
    <div class="testimonials-container">
        <div class="testimonial">
            <img src="img/client1.jpg" alt="Client 1">
            <p>"Most Trusted Online Astrology Service in Sri Lanka"</p>
            <h3>– Nimasha Fernando</h3>
        </div>
        <div class="testimonial">
            <img src="img/client2.jpg" alt="Client 2">
            <p>"Fastest Service and Friendly Service"</p>
            <h3>– Ramesh Pathirana</h3>
        </div>
        <div class="testimonial">
            <img src="img/client3.jpg" alt="Client 3">
            <p>"Check compatibility before start any relationship."</p>
            <h3>– Chamathka Sewmini</h3>
        </div>
    </div>
</section>

    <script>
        function toggleMenu() {
            document.getElementById("sideMenu").classList.toggle("active");
        }
    </script>

<br><br><footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>About Us</h3>
                <p>Subasetha Astrology Service, your trusted source for authentic astrology guidance in Sri Lanka. Rooted in centuries-old traditions, we combine the wisdom of Vedic astrology with modern insights to help you navigate life’s journey with clarity and confidence.</p>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: subasethaastro.com</p>
                <p>Phone: 034-3120800</p>
                <p>Address: No.639/C Kithulawa Kaluthara South.</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 Subasetha Astrology Service. All Rights Reserved.
        </div>
    </footer>

</body>
</html>

