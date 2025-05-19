<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subasetha Astrology Service - Policy Agreement</title>

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

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #333;
            margin-top: 30px;
        }

        h2 {
            font-size: 1.6em;
            color: #2c3e50;
            margin-top: 30px;
        }

        h3 {
            font-size: 1.4em;
            color: #34495e;
            margin-top: 20px;
        }

        p {
            font-size: 1em;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        ul {
            margin-left: 20px;
            margin-bottom: 15px;
        }

        ul li {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        .agreement {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 35px;
        }

        hr {
            border: 0;
            border-top: 2px solid #eee;
            margin: 30px 0;
        }

        footer {
            color: #B2BEB5;
            padding: 20px 5px;
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

    <div class="agreement">
        <h3><center>HOROSCOPE-BASED DATING WEBSITE POLICY AGREEMENT</center></h3>

        <p><strong>Last Updated:</strong> 31/01/2025</p>

        <p>Welcome to Subasetha Astrology Service! Your privacy and safety are important to us. Please read the following agreement carefully.</p>

        <hr>

        <h2>1. Terms of Service</h2>

        <h3>1.1 Acceptance of Terms</h3>
        <p>By accessing or using Subasetha Astrology Service, you agree to abide by these Terms of Service and our Privacy Policy. If you do not agree, please discontinue use immediately.</p>

        <h3>1.2 Eligibility</h3>
        <ul>
            <li>You must be at least 18 years old to use this service.</li>
            <li>You must provide accurate and complete information.</li>
            <li>You are responsible for your account security and activities.</li>
        </ul>

        <h3>1.3 Account Termination</h3>
        <p>We reserve the right to suspend or terminate accounts that violate our policies, including but not limited to:</p>
        <ul>
            <li>Providing false information</li>
            <li>Engaging in harassment or offensive behavior</li>
            <li>Using the platform for illegal activities</li>
        </ul>

        <h3>1.4 User Conduct</h3>
        <ul>
            <li>Be respectful to other users.</li>
            <li>Do not share personal or financial information publicly.</li>
            <li>Do not engage in spamming or fraudulent activities.</li>
        </ul>

        <hr>

        <h2>2. Privacy Policy</h2>

        <h3>2.1 Information We Collect</h3>
        <ul>
            <li>Personal details: Name, email, birth date, zodiac sign, and preferences.</li>
            <li>User activity: Messages, matches, interactions, and login details.</li>
            <li>Device and browser information.</li>
        </ul>

        <h3>2.2 How We Use Your Information</h3>
        <ul>
            <li>To provide matchmaking services based on astrology.</li>
            <li>To improve user experience and security.</li>
            <li>To send updates and promotional content (you can opt out at any time).</li>
        </ul>

        <h3>2.3 Data Protection & Sharing</h3>
        <ul>
            <li>Your data is stored securely and encrypted.</li>
            <li>We do not sell your data to third parties.</li>
            <li>We may share data with legal authorities when required.</li>
        </ul>

        <hr>

        <h2>3. Disclaimer & Liability</h2>

        <h3>3.1 No Guarantee of Matches</h3>
        <p>Subasetha Astrology Service does not guarantee successful matches or relationships.</p>

        <h3>3.2 Limitation of Liability</h3>
        <p>We are not responsible for:</p>
        <ul>
            <li>The behavior of other users.</li>
            <li>Emotional distress or damages caused by interactions.</li>
            <li>Third-party actions, including hacking or data breaches.</li>
        </ul>

        <h3>3.3 External Links</h3>
        <p>We may provide links to external websites. We are not responsible for their content or privacy practices.</p>

        <hr>

        <h2>4. Payment & Subscription (If Applicable)</h2>

        <h3>4.1 Fees & Billing</h3>
        <ul>
            <li>Features may require payment.</li>
            <li>All payments are final and non-refundable unless stated otherwise.</li>
        </ul>

        <hr>

        <h2>5. Intellectual Property Rights</h2>

        <h3>5.1 Ownership</h3>
        <p>All content, trademarks, logos, and designs on Subasetha Astrology Service are our property or licensed for use.</p>

        <h3>5.2 User-Generated Content</h3>
        <ul>
            <li>You retain ownership of your content but grant us a license to use it within the platform.</li>
            <li>We reserve the right to remove any inappropriate content.</li>
        </ul>

        <hr>

        <h2>6. Governing Law & Dispute Resolution</h2>

        <h3>6.1 Applicable Laws</h3>
        <p>These terms are governed by the laws of Sri Lanka.</p>

        <h3>6.2 Dispute Resolution</h3>
        <ul>
            <li>Any disputes will be settled through arbitration in Sri Lanka.</li>
            <li>Users waive the right to participate in class-action lawsuits.</li>
        </ul>

        <hr>

        <h2>7. Contact Information</h2>
        <p>If you have any questions or concerns, please contact us at [Email Address].</p>

        <p>By using Subasetha Astrology Service, you acknowledge and agree to this policy agreement.</p>

        <hr>

        <p><strong><center>*End of Policy Agreement*</center></strong></p>
    </div>

    <div class = "footer">
        <p><center>&copy; 2024 Subasetha Astrology Service. All Rights Reserved.</center></p>
    </div>

</body>
</html>
