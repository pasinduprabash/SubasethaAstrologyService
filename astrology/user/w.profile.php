<?php
session_start();
include 'db_connect.php';

$logged_id = $_SESSION['user_id'] ?? null;
$message = "";
$match_found = false;
$showAlert = false;

$sql = "SELECT id FROM marriage_reg WHERE user_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $logged_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $match_found = true;
    } else {
        $showAlert = true;
    }
    $stmt->close();
}

if ($logged_id) {
    $stmt = $conn->prepare("SELECT * FROM marriage_reg WHERE user_id = ?");
    $stmt->bind_param("i", $logged_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $logged_id == $user['user_id']) {
    $name = $_POST['name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $age = (int) $_POST['age'];
    $profession = $_POST['profession'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $relationship_status = $_POST['relationship_status'] ?? '';
    $education_level = $_POST['education_level'] ?? '';
    $caste = $_POST['caste'] ?? '';
    $monthly_income = (float) $_POST['monthly_Income'];
    $mother_profession = $_POST['mother_profession'] ?? '';
    $father_profession = $_POST['father_profession'] ?? '';
    $height = (float) $_POST['height'];
    $weight = (float) $_POST['weight'];
    $smoking = $_POST['smoking'] ?? '';
    $drinking = $_POST['drinking'] ?? '';
    $hobbies = $_POST['hobbies'] ?? '';
    $bio = $_POST['bio'] ?? '';

    $update_stmt = $conn->prepare("UPDATE marriage_reg 
        SET name=?, gender=?, age=?, profession=?, nationality=?, religion=?, relationship_status=?, education_level=?, caste=?, monthly_Income=?, mother_profession=?, father_profession=?, height=?, weight=?, smoking=?, drinking=?, hobbies=?, bio=? 
        WHERE user_id=?");

    $update_stmt->bind_param(
        "ssissssssiiissssssi", 
        $name, $gender, $age, $profession, $nationality, $religion, $relationship_status, $education_level, $caste, 
        $monthly_income, $mother_profession, $father_profession, $height, $weight, $smoking, $drinking, $hobbies, $bio, $logged_id
    );

    if ($update_stmt->execute()) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile: " . $conn->error;
    }

    $update_stmt->close();
}

$conn->close();

if (!empty($message)) {
    echo "<p>$message</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

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
            text-align: left;
            margin-top: 25px;
            text-decoration: none;
            color: inherit;
        }
        
        button.btn-register {
            margin-top: 20px;
            width: 30%;
            padding: 10px 18px;
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

<?php if (!empty($showAlert)): ?>
    <div class="container">
    <div class="alert alert-danger" role="alert">
        <center>You Don't Have A Marriage Profile. Click Here to <a href="w.marrage_reg.php">Register</a></center>
    </div>
</div>
<?php endif; ?>

<?php if ($match_found): ?>
<div class="container">
    <h5 class="form-title">Update Marriage Profile</h5>
    <hr>
    <p class="text-success"><?php echo $message; ?></p>
    <div class="row">
        <div class="col-md-9">
            <form method="POST">
                <div class="row g-3">

                    <!-- Name Input -->
                    <div class="col-md-3">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                    </div>

                    <!-- Gender Selection -->
                    <div class="col-md-3">
                        <label>Gender:</label>
                        <select class="form-control" name="gender" required>
                            <option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <!-- Age Input -->
                    <div class="col-md-3">
                        <label>Age:</label>
                        <input type="number" class="form-control" name="age" value="<?php echo $user['age']; ?>" required>
                    </div>

                    <!-- Profession Selection -->
                    <div class="col-md-3">
                        <label>Profession:</label>
                        <select id="profession" name="profession" class="form-control" required>
                            <option value="" disabled selected>Profession</option>
                            <option value="teacher" <?php echo ($user['profession'] == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                            <option value="engineer" <?php echo ($user['profession'] == 'engineer') ? 'selected' : ''; ?>>Engineer</option>
                            <option value="doctor" <?php echo ($user['profession'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                            <option value="lawyer" <?php echo ($user['profession'] == 'lawyer') ? 'selected' : ''; ?>>Lawyer</option>
                            <option value="artist" <?php echo ($user['profession'] == 'artist') ? 'selected' : ''; ?>>Artist</option>
                            <option value="businessperson" <?php echo ($user['profession'] == 'businessperson') ? 'selected' : ''; ?>>Businessperson</option>
                            <option value="chef" <?php echo ($user['profession'] == 'chef') ? 'selected' : ''; ?>>Chef</option>
                            <option value="nurse" <?php echo ($user['profession'] == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
                            <option value="software-engineer" <?php echo ($user['profession'] == 'software-engineer') ? 'selected' : ''; ?>>Software Engineer</option>
                            <option value="architect" <?php echo ($user['profession'] == 'architect') ? 'selected' : ''; ?>>Architect</option>
                            <option value="accountant" <?php echo ($user['profession'] == 'accountant') ? 'selected' : ''; ?>>Accountant</option>
                            <option value="journalist" <?php echo ($user['profession'] == 'journalist') ? 'selected' : ''; ?>>Journalist</option>
                            <option value="police-officer" <?php echo ($user['profession'] == 'police-officer') ? 'selected' : ''; ?>>Police Officer</option>
                            <option value="firefighter" <?php echo ($user['profession'] == 'firefighter') ? 'selected' : ''; ?>>Firefighter</option>
                            <option value="pilot" <?php echo ($user['profession'] == 'pilot') ? 'selected' : ''; ?>>Pilot</option>
                            <option value="pharmacist" <?php echo ($user['profession'] == 'pharmacist') ? 'selected' : ''; ?>>Pharmacist</option>
                            <option value="mechanic" <?php echo ($user['profession'] == 'mechanic') ? 'selected' : ''; ?>>Mechanic</option>
                            <option value="social-worker" <?php echo ($user['profession'] == 'social-worker') ? 'selected' : ''; ?>>Social Worker</option>
                            <option value="farmer" <?php echo ($user['profession'] == 'farmer') ? 'selected' : ''; ?>>Farmer</option>
                            <option value="scientist" <?php echo ($user['profession'] == 'scientist') ? 'selected' : ''; ?>>Scientist</option>
                            <option value="musician" <?php echo ($user['profession'] == 'musician') ? 'selected' : ''; ?>>Musician</option>
                            <option value="dancer" <?php echo ($user['profession'] == 'dancer') ? 'selected' : ''; ?>>Dancer</option>
                            <option value="writer" <?php echo ($user['profession'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
                            <option value="civil-servant" <?php echo ($user['profession'] == 'civil-servant') ? 'selected' : ''; ?>>Civil Servant</option>
                            <option value="military-officer" <?php echo ($user['profession'] == 'military-officer') ? 'selected' : ''; ?>>Military Officer</option>
                            <option value="photographer" <?php echo ($user['profession'] == 'photographer') ? 'selected' : ''; ?>>Photographer</option>
                            <option value="psychologist" <?php echo ($user['profession'] == 'psychologist') ? 'selected' : ''; ?>>Psychologist</option>
                            <option value="consultant" <?php echo ($user['profession'] == 'consultant') ? 'selected' : ''; ?>>Consultant</option>
                            <option value="real-estate-agent" <?php echo ($user['profession'] == 'real-estate-agent') ? 'selected' : ''; ?>>Real Estate Agent</option>
                            <option value="interior-designer" <?php echo ($user['profession'] == 'interior-designer') ? 'selected' : ''; ?>>Interior Designer</option>
                            <option value="fashion-designer" <?php echo ($user['profession'] == 'fashion-designer') ? 'selected' : ''; ?>>Fashion Designer</option>
                            <option value="event-planner" <?php echo ($user['profession'] == 'event-planner') ? 'selected' : ''; ?>>Event Planner</option>
                            <option value="dentist" <?php echo ($user['profession'] == 'dentist') ? 'selected' : ''; ?>>Dentist</option>
                            <option value="veterinarian" <?php echo ($user['profession'] == 'veterinarian') ? 'selected' : ''; ?>>Veterinarian</option>
                            <option value="sports-coach" <?php echo ($user['profession'] == 'sports-coach') ? 'selected' : ''; ?>>Sports Coach</option>
                            <option value="athlete" <?php echo ($user['profession'] == 'athlete') ? 'selected' : ''; ?>>Athlete</option>
                            <option value="tour-guide" <?php echo ($user['profession'] == 'tour-guide') ? 'selected' : ''; ?>>Tour Guide</option>
                            <option value="librarian" <?php echo ($user['profession'] == 'librarian') ? 'selected' : ''; ?>>Librarian</option>
                            <option value="translator" <?php echo ($user['profession'] == 'translator') ? 'selected' : ''; ?>>Translator</option>
                            <option value="public-relations-specialist" <?php echo ($user['profession'] == 'public-relations-specialist') ? 'selected' : ''; ?>>Public Relations Specialist</option>
                            <option value="marketing-specialist" <?php echo ($user['profession'] == 'marketing-specialist') ? 'selected' : ''; ?>>Marketing Specialist</option>
                            <option value="graphic-designer" <?php echo ($user['profession'] == 'graphic-designer') ? 'selected' : ''; ?>>Graphic Designer</option>
                            <option value="data-analyst" <?php echo ($user['profession'] == 'data-analyst') ? 'selected' : ''; ?>>Data Analyst</option>
                            <option value="cybersecurity-specialist" <?php echo ($user['profession'] == 'cybersecurity-specialist') ? 'selected' : ''; ?>>Cybersecurity Specialist</option>
                            <option value="other" <?php echo ($user['profession'] == 'other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>

                    <!-- Nationality Selection -->
                    <div class="col-md-3">
                        <label for="nationality">Nationality:</label>
                        <select id="nationality" name="nationality" class="form-control" required>
                            <option value="" disabled selected>Nationality</option>
                            <option value="srilankan" <?php echo ($user['nationality'] == 'srilankan') ? 'selected' : ''; ?>>Sri Lankan</option>
                            <option value="other" <?php echo ($user['nationality'] == 'other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>

                    <!-- Religion Selection -->
                    <div class="col-md-3">
                        <label for="religion">Religion:</label>
                        <input type="text" name="religion" class="form-control" value ="<?php echo ($user['religion']); ?>" required>
                    </div>

                    <!-- Relationship Status -->
                    <div class="col-md-3">
                        <label for="relationship_status">Relationship Status:</label>
                        <select id="relationship_status" name="relationship_status" class="form-control" required>
                            <option value="" disabled selected>Relationship Status</option>
                            <option value="single" <?php echo ($user['relationship_status'] == 'single') ? 'selected' : ''; ?>>Single</option>
                            <option value="divorced" <?php echo ($user['relationship_status'] == 'divorced') ? 'selected' : ''; ?>>Divorced</option>
                            <option value="widowed" <?php echo ($user['relationship_status'] == 'widowed') ? 'selected' : ''; ?>>Widowed</option>
                        </select>
                    </div>
            
        <div class="col-md-3">    
    <label for="education_level">Education Level:</label>
    <select id="education_level" name="education_level" class="form-control" required>
        <option value="" disabled selected>Education Level</option>
        <option value="ol" <?php echo ($user['education_level'] == 'ol') ? 'selected' : ''; ?>>O/L</option>
        <option value="al" <?php echo ($user['education_level'] == 'al') ? 'selected' : ''; ?>>A/L</option>
        <option value="diploma" <?php echo ($user['education_level'] == 'diploma') ? 'selected' : ''; ?>>Diploma</option>
        <option value="hnd" <?php echo ($user['education_level'] == 'hnd') ? 'selected' : ''; ?>>Higher National Diploma</option>
        <option value="bachelor" <?php echo ($user['education_level'] == 'bachelor') ? 'selected' : ''; ?>>Bachelor's Degree</option>
        <option value="master" <?php echo ($user['education_level'] == 'master') ? 'selected' : ''; ?>>Master's Degree</option>
        <option value="phd" <?php echo ($user['education_level'] == 'phd') ? 'selected' : ''; ?>>PhD</option>
        <option value="other" <?php echo ($user['education_level'] == 'other') ? 'selected' : ''; ?>>Other</option>
    </select>
</div>

<div class="col-md-3">
    <label for="caste">Caste:</label>
    <select id="caste" name="caste" class="form-control" required>
        <option value="Govigama" <?php echo ($user['caste'] == 'Govigama') ? 'selected' : ''; ?>>Govigama</option>
        <option value="Radala" <?php echo ($user['caste'] == 'Radala') ? 'selected' : ''; ?>>Radala</option>
        <option value="Salagama" <?php echo ($user['caste'] == 'Salagama') ? 'selected' : ''; ?>>Salagama</option>
        <option value="Durava" <?php echo ($user['caste'] == 'Durava') ? 'selected' : ''; ?>>Durava</option>
        <option value="Karawe" <?php echo ($user['caste'] == 'Karawe') ? 'selected' : ''; ?>>Karawe</option>
        <option value="Berava" <?php echo ($user['caste'] == 'Berava') ? 'selected' : ''; ?>>Berava</option>
        <option value="Nawabadda (Hena)" <?php echo ($user['caste'] == 'Nawabadda (Hena)') ? 'selected' : ''; ?>>Nawabadda (Hena)</option>
        <option value="Bathgama" <?php echo ($user['caste'] == 'Bathgama') ? 'selected' : ''; ?>>Bathgama</option>
    </select>
</div>

<div class="col-md-3">
    <label for="monthly_Income">Monthly Income:</label>
    <input type="number" class="form-control" name="monthly_Income" value="<?php echo $user['monthly_Income']; ?>" required>
</div>

<div class="col-md-3">
    <label for="mother_profession">Mother's Profession:</label>
    <select id="mother_profession" name="mother_profession" class="form-control" required>
        <option value="" disabled selected>Profession</option>
        <option value="teacher" <?php echo ($user['mother_profession'] == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
        <option value="engineer" <?php echo ($user['mother_profession'] == 'engineer') ? 'selected' : ''; ?>>Engineer</option>
        <option value="doctor" <?php echo ($user['mother_profession'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
        <option value="lawyer" <?php echo ($user['mother_profession'] == 'lawyer') ? 'selected' : ''; ?>>Lawyer</option>
        <option value="artist" <?php echo ($user['mother_profession'] == 'artist') ? 'selected' : ''; ?>>Artist</option>
        <option value="businessperson" <?php echo ($user['mother_profession'] == 'businessperson') ? 'selected' : ''; ?>>Businessperson</option>
        <option value="chef" <?php echo ($user['mother_profession'] == 'chef') ? 'selected' : ''; ?>>Chef</option>
        <option value="nurse" <?php echo ($user['mother_profession'] == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
        <option value="software-engineer" <?php echo ($user['mother_profession'] == 'software-engineer') ? 'selected' : ''; ?>>Software Engineer</option>
        <option value="architect" <?php echo ($user['mother_profession'] == 'architect') ? 'selected' : ''; ?>>Architect</option>
        <option value="accountant" <?php echo ($user['mother_profession'] == 'accountant') ? 'selected' : ''; ?>>Accountant</option>
        <option value="journalist" <?php echo ($user['mother_profession'] == 'journalist') ? 'selected' : ''; ?>>Journalist</option>
        <option value="police-officer" <?php echo ($user['mother_profession'] == 'police-officer') ? 'selected' : ''; ?>>Police Officer</option>
        <option value="firefighter" <?php echo ($user['mother_profession'] == 'firefighter') ? 'selected' : ''; ?>>Firefighter</option>
        <option value="pilot" <?php echo ($user['mother_profession'] == 'pilot') ? 'selected' : ''; ?>>Pilot</option>
        <option value="pharmacist" <?php echo ($user['mother_profession'] == 'pharmacist') ? 'selected' : ''; ?>>Pharmacist</option>
        <option value="mechanic" <?php echo ($user['mother_profession'] == 'mechanic') ? 'selected' : ''; ?>>Mechanic</option>
        <option value="social-worker" <?php echo ($user['mother_profession'] == 'social-worker') ? 'selected' : ''; ?>>Social Worker</option>
        <option value="farmer" <?php echo ($user['mother_profession'] == 'farmer') ? 'selected' : ''; ?>>Farmer</option>
        <option value="scientist" <?php echo ($user['mother_profession'] == 'scientist') ? 'selected' : ''; ?>>Scientist</option>
        <option value="musician" <?php echo ($user['mother_profession'] == 'musician') ? 'selected' : ''; ?>>Musician</option>
        <option value="dancer" <?php echo ($user['mother_profession'] == 'dancer') ? 'selected' : ''; ?>>Dancer</option>
        <option value="writer" <?php echo ($user['mother_profession'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
        <option value="civil-servant" <?php echo ($user['mother_profession'] == 'civil-servant') ? 'selected' : ''; ?>>Civil Servant</option>
        <option value="military-officer" <?php echo ($user['mother_profession'] == 'military-officer') ? 'selected' : ''; ?>>Military Officer</option>
        <option value="photographer" <?php echo ($user['mother_profession'] == 'photographer') ? 'selected' : ''; ?>>Photographer</option>
        <option value="psychologist" <?php echo ($user['mother_profession'] == 'psychologist') ? 'selected' : ''; ?>>Psychologist</option>
        <option value="consultant" <?php echo ($user['mother_profession'] == 'consultant') ? 'selected' : ''; ?>>Consultant</option>
        <option value="real-estate-agent" <?php echo ($user['mother_profession'] == 'real-estate-agent') ? 'selected' : ''; ?>>Real Estate Agent</option>
        <option value="interior-designer" <?php echo ($user['mother_profession'] == 'interior-designer') ? 'selected' : ''; ?>>Interior Designer</option>
        <option value="fashion-designer" <?php echo ($user['mother_profession'] == 'fashion-designer') ? 'selected' : ''; ?>>Fashion Designer</option>
        <option value="event-planner" <?php echo ($user['mother_profession'] == 'event-planner') ? 'selected' : ''; ?>>Event Planner</option>
        <option value="dentist" <?php echo ($user['mother_profession'] == 'dentist') ? 'selected' : ''; ?>>Dentist</option>
        <option value="veterinarian" <?php echo ($user['mother_profession'] == 'veterinarian') ? 'selected' : ''; ?>>Veterinarian</option>
        <option value="sports-coach" <?php echo ($user['mother_profession'] == 'sports-coach') ? 'selected' : ''; ?>>Sports Coach</option>
        <option value="athlete" <?php echo ($user['mother_profession'] == 'athlete') ? 'selected' : ''; ?>>Athlete</option>
        <option value="tour-guide" <?php echo ($user['mother_profession'] == 'tour-guide') ? 'selected' : ''; ?>>Tour Guide</option>
        <option value="librarian" <?php echo ($user['mother_profession'] == 'librarian') ? 'selected' : ''; ?>>Librarian</option>
        <option value="translator" <?php echo ($user['mother_profession'] == 'translator') ? 'selected' : ''; ?>>Translator</option>
        <option value="public-relations-specialist" <?php echo ($user['mother_profession'] == 'public-relations-specialist') ? 'selected' : ''; ?>>Public Relations Specialist</option>
        <option value="marketing-specialist" <?php echo ($user['mother_profession'] == 'marketing-specialist') ? 'selected' : ''; ?>>Marketing Specialist</option>
        <option value="graphic-designer" <?php echo ($user['mother_profession'] == 'graphic-designer') ? 'selected' : ''; ?>>Graphic Designer</option>
        <option value="data-analyst" <?php echo ($user['mother_profession'] == 'data-analyst') ? 'selected' : ''; ?>>Data Analyst</option>
        <option value="cybersecurity-specialist" <?php echo ($user['mother_profession'] == 'cybersecurity-specialist') ? 'selected' : ''; ?>>Cybersecurity Specialist</option>
        <option value="other" <?php echo ($user['mother_profession'] == 'other') ? 'selected' : ''; ?>>Other</option>
    </select>
</div>


<div class="col-md-3">
    <label>Father Profession:</label>
    <select id="profession" name="profession" class="form-control" required>
        <option value="" disabled selected>Profession</option>
        <option value="teacher" <?php echo ($user['profession'] == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
        <option value="engineer" <?php echo ($user['profession'] == 'engineer') ? 'selected' : ''; ?>>Engineer</option>
        <option value="doctor" <?php echo ($user['profession'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
        <option value="lawyer" <?php echo ($user['profession'] == 'lawyer') ? 'selected' : ''; ?>>Lawyer</option>
        <option value="artist" <?php echo ($user['profession'] == 'artist') ? 'selected' : ''; ?>>Artist</option>
        <option value="businessperson" <?php echo ($user['profession'] == 'businessperson') ? 'selected' : ''; ?>>Businessperson</option>
        <option value="chef" <?php echo ($user['profession'] == 'chef') ? 'selected' : ''; ?>>Chef</option>
        <option value="nurse" <?php echo ($user['profession'] == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
        <option value="software-engineer" <?php echo ($user['profession'] == 'software-engineer') ? 'selected' : ''; ?>>Software Engineer</option>
        <option value="architect" <?php echo ($user['profession'] == 'architect') ? 'selected' : ''; ?>>Architect</option>
        <option value="accountant" <?php echo ($user['profession'] == 'accountant') ? 'selected' : ''; ?>>Accountant</option>
        <option value="journalist" <?php echo ($user['profession'] == 'journalist') ? 'selected' : ''; ?>>Journalist</option>
        <option value="police-officer" <?php echo ($user['profession'] == 'police-officer') ? 'selected' : ''; ?>>Police Officer</option>
        <option value="firefighter" <?php echo ($user['profession'] == 'firefighter') ? 'selected' : ''; ?>>Firefighter</option>
        <option value="pilot" <?php echo ($user['profession'] == 'pilot') ? 'selected' : ''; ?>>Pilot</option>
        <option value="pharmacist" <?php echo ($user['profession'] == 'pharmacist') ? 'selected' : ''; ?>>Pharmacist</option>
        <option value="mechanic" <?php echo ($user['profession'] == 'mechanic') ? 'selected' : ''; ?>>Mechanic</option>
        <option value="social-worker" <?php echo ($user['profession'] == 'social-worker') ? 'selected' : ''; ?>>Social Worker</option>
        <option value="farmer" <?php echo ($user['profession'] == 'farmer') ? 'selected' : ''; ?>>Farmer</option>
        <option value="scientist" <?php echo ($user['profession'] == 'scientist') ? 'selected' : ''; ?>>Scientist</option>
        <option value="musician" <?php echo ($user['profession'] == 'musician') ? 'selected' : ''; ?>>Musician</option>
        <option value="dancer" <?php echo ($user['profession'] == 'dancer') ? 'selected' : ''; ?>>Dancer</option>
        <option value="writer" <?php echo ($user['profession'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
        <option value="civil-servant" <?php echo ($user['profession'] == 'civil-servant') ? 'selected' : ''; ?>>Civil Servant</option>
        <option value="military-officer" <?php echo ($user['profession'] == 'military-officer') ? 'selected' : ''; ?>>Military Officer</option>
        <option value="photographer" <?php echo ($user['profession'] == 'photographer') ? 'selected' : ''; ?>>Photographer</option>
        <option value="psychologist" <?php echo ($user['profession'] == 'psychologist') ? 'selected' : ''; ?>>Psychologist</option>
        <option value="consultant" <?php echo ($user['profession'] == 'consultant') ? 'selected' : ''; ?>>Consultant</option>
        <option value="real-estate-agent" <?php echo ($user['profession'] == 'real-estate-agent') ? 'selected' : ''; ?>>Real Estate Agent</option>
        <option value="interior-designer" <?php echo ($user['profession'] == 'interior-designer') ? 'selected' : ''; ?>>Interior Designer</option>
        <option value="fashion-designer" <?php echo ($user['profession'] == 'fashion-designer') ? 'selected' : ''; ?>>Fashion Designer</option>
        <option value="event-planner" <?php echo ($user['profession'] == 'event-planner') ? 'selected' : ''; ?>>Event Planner</option>
        <option value="dentist" <?php echo ($user['profession'] == 'dentist') ? 'selected' : ''; ?>>Dentist</option>
        <option value="veterinarian" <?php echo ($user['profession'] == 'veterinarian') ? 'selected' : ''; ?>>Veterinarian</option>
        <option value="sports-coach" <?php echo ($user['profession'] == 'sports-coach') ? 'selected' : ''; ?>>Sports Coach</option>
        <option value="athlete" <?php echo ($user['profession'] == 'athlete') ? 'selected' : ''; ?>>Athlete</option>
        <option value="tour-guide" <?php echo ($user['profession'] == 'tour-guide') ? 'selected' : ''; ?>>Tour Guide</option>
        <option value="librarian" <?php echo ($user['profession'] == 'librarian') ? 'selected' : ''; ?>>Librarian</option>
        <option value="translator" <?php echo ($user['profession'] == 'translator') ? 'selected' : ''; ?>>Translator</option>
        <option value="public-relations-specialist" <?php echo ($user['profession'] == 'public-relations-specialist') ? 'selected' : ''; ?>>Public Relations Specialist</option>
        <option value="marketing-specialist" <?php echo ($user['profession'] == 'marketing-specialist') ? 'selected' : ''; ?>>Marketing Specialist</option>
        <option value="graphic-designer" <?php echo ($user['profession'] == 'graphic-designer') ? 'selected' : ''; ?>>Graphic Designer</option>
        <option value="data-analyst" <?php echo ($user['profession'] == 'data-analyst') ? 'selected' : ''; ?>>Data Analyst</option>
        <option value="cybersecurity-specialist" <?php echo ($user['profession'] == 'cybersecurity-specialist') ? 'selected' : ''; ?>>Cybersecurity Specialist</option>
        <option value="other" <?php echo ($user['profession'] == 'other') ? 'selected' : ''; ?>>Other</option>
    </select>
</div>
                    <div class="col-md-3">
                        <label>Height (cm):</label>
                        <input type="number" class="form-control" name="height" value="<?php echo $user['height']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label>Weight (kg):</label>
                        <input type="number" class="form-control" name="weight" value="<?php echo $user['weight']; ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label>Smoking Habits:</label>
                        <select class="form-control" name="smoking" required>
                            <option value="non-smoker" <?php echo ($user['smoking'] == 'non-smoker') ? 'selected' : ''; ?>>Non-Smoker</option>
                            <option value="occasional-smoker" <?php echo ($user['smoking'] == 'occasional-smoker') ? 'selected' : ''; ?>>Occasional Smoker</option>
                            <option value="regular-smoker" <?php echo ($user['smoking'] == 'regular-smoker') ? 'selected' : ''; ?>>Regular Smoker</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Drinking Habits:</label>
                        <select class="form-control" name="drinking" required>
                            <option value="non-drinker" <?php echo ($user['drinking'] == 'non-drinker') ? 'selected' : ''; ?>>Non-Drinker</option>
                            <option value="occasional-drinker" <?php echo ($user['drinking'] == 'occasional-drinker') ? 'selected' : ''; ?>>Occasional Drinker</option>
                            <option value="regular-drinker" <?php echo ($user['drinking'] == 'regular-drinker') ? 'selected' : ''; ?>>Regular Drinker</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                    <label>Hobbies:</label>
                    <textarea class="form-control" name="hobbies" rows="2" required><?php echo htmlspecialchars($user['hobbies']); ?></textarea>
                    </div>

                    <div class="col-md-12">
                    <label>About Me:</label>
                    <textarea class="form-control" name="bio" rows="4" required><?php echo htmlspecialchars($user['bio']); ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn-register">Update Dating Profile</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?> 

<footer>
    <div class="footer">
        &copy; 2025 Subasetha Astrology Service. All Rights Reserved.
    </div>
</footer>

</body>
</html>
