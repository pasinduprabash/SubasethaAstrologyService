<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: w.login.php");
    exit;
}

$loggedInUser = $_SESSION['user_id'];
$showAlert = false;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $bio = trim($_POST['bio']);
    $gender = $_POST['gender'];
    $nakatha = $_POST['nakatha'];
    $age = (int)$_POST['age'];
    $profession = $_POST['profession'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $caste = $_POST['caste'];
    $relationship_status = $_POST['relationship_status'];
    $education_level = $_POST['education_level'];
    $monthly_Income = (int)$_POST['monthly_Income'];
    $mother_profession = $_POST['mother_profession'];
    $father_profession = $_POST['father_profession'];
    $height = (int)$_POST['height'];
    $weight = (int)$_POST['weight'];
    $hobbies = $_POST['hobbies'];
    $smoking = $_POST['smoking'];
    $drinking = $_POST['drinking'];

    $profilePhoto = ($gender === "male") ? "uploads2/male.jpg" : "uploads2/female.jpg";

    $sql = "INSERT INTO marriage_reg 
        (user_id, phone, profile_photo, name, bio, gender, nakatha, age, profession, nationality, religion, caste,
         relationship_status, education_level, monthly_Income, mother_profession, father_profession, height, weight, hobbies, smoking, drinking) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
    $stmt->bind_param(
    "issssssisssssssisiiisss",
    $loggedInUser, $phone, $profilePhoto, $name, $bio, $gender, $nakatha, $age,
    $profession, $nationality, $religion, $caste, $relationship_status, $education_level,
    $monthly_Income, $mother_profession, $father_profession, $height, $weight,
    $hobbies, $smoking, $drinking
    );

        if ($stmt->execute()) {
            $showAlert = true;
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }

        $stmt->close();
    } else {
        die("Error preparing SQL: " . htmlspecialchars($conn->error));
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

        body {
            background-image: url('img/bg5.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .left-section {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 2px; 

         }   

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-control{
            width: 200px;
        }

        label {
            font-size: 14px;
            color: #666;
            display: block;
            margin-bottom: 8px;
        }

        button.btn-register {
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

        button.btn-register:hover {
            background-color: #e14c4f;
        }

    </style>
</head>

        <body>
            <div class="container">
            <div class="left-section">
            <form id="Form" method="POST">
                    <h4><b><center>Enter Your Details</center></b></h4><br>

            <?php if ($showAlert): ?>
            
                <div class="alert alert-success" role="alert">
                    <strong>Successfully Registered.</strong>
                    <a href="w.marriage_proposal.php" class="alert-link">Go to Marriage Profiles</a>
                </div>
            
            <?php endif; ?>                

        <div class="form-group row">
            <div class="col-md-6">        
                <div class="form-group"> 
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Name" required>
                </div>
            </div>    

            <div class="col-md-6">
                <div class="form-group"> 
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="" disabled selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                </div>
            </div>
        </div>

            <div class="form-group row">
                <div class="col-md-6">
                   <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                    placeholder="Enter your Number" required>
                   </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group"> 
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" class="form-control" placeholder="Enter your Age" min="18" required>
                </div>
            </div>
            </div>

        <div class="form-group row">        
            <div class="col-md-6">
                <div class="form-group"> 
                <label for="profession">Profession:</label>
                <select id="profession" name="profession" class="form-control" required>
                    <option value="" disabled selected>Profession</option>
                    <option value="teacher">Teacher</option>
                    <option value="engineer">Engineer</option>
                    <option value="doctor">Doctor</option>
                    <option value="lawyer">Lawyer</option>
                    <option value="artist">Artist</option>
                    <option value="businessperson">Businessperson</option>
                    <option value="chef">Chef</option>
                    <option value="nurse">Nurse</option>
                    <option value="software-engineer">Software Engineer</option>
                    <option value="architect">Architect</option>
                    <option value="accountant">Accountant</option>
                    <option value="journalist">Journalist</option>
                    <option value="police-officer">Police Officer</option>
                    <option value="firefighter">Firefighter</option>
                    <option value="pilot">Pilot</option>
                    <option value="pharmacist">Pharmacist</option>
                    <option value="mechanic">Mechanic</option>
                    <option value="social-worker">Social Worker</option>
                    <option value="farmer">Farmer</option>
                    <option value="scientist">Scientist</option>
                    <option value="musician">Musician</option>
                    <option value="dancer">Dancer</option>
                    <option value="writer">Writer</option>
                    <option value="civil-servant">Civil Servant</option>
                    <option value="military-officer">Military Officer</option>
                    <option value="photographer">Photographer</option>
                    <option value="psychologist">Psychologist</option>
                    <option value="consultant">Consultant</option>
                    <option value="real-estate-agent">Real Estate Agent</option>
                    <option value="interior-designer">Interior Designer</option>
                    <option value="fashion-designer">Fashion Designer</option>
                    <option value="event-planner">Event Planner</option>
                    <option value="dentist">Dentist</option>
                    <option value="veterinarian">Veterinarian</option>
                    <option value="sports-coach">Sports Coach</option>
                    <option value="athlete">Athlete</option>
                    <option value="tour-guide">Tour Guide</option>
                    <option value="librarian">Librarian</option>
                    <option value="translator">Translator</option>
                    <option value="public-relations-specialist">Public Relations Specialist</option>
                    <option value="marketing-specialist">Marketing Specialist</option>
                    <option value="graphic-designer">Graphic Designer</option>
                    <option value="data-analyst">Data Analyst</option>
                    <option value="cybersecurity-specialist">Cybersecurity Specialist</option>
                    <option value="biologist">Biologist</option>
                    <option value="chemist">Chemist</option>
                    <option value="physicist">Physicist</option>
                    <option value="geologist">Geologist</option>
                    <option value="environmentalist">Environmentalist</option>
                    <option value="astronomer">Astronomer</option>
                    <option value="anthropologist">Anthropologist</option>
                    <option value="sociologist">Sociologist</option>
                    <option value="historian">Historian</option>
                    <option value="economist">Economist</option>
                    <option value="urban-planner">Urban Planner</option>
                    <option value="carpenter">Carpenter</option>
                    <option value="electrician">Electrician</option>
                    <option value="plumber">Plumber</option>
                    <option value="construction-worker">Construction Worker</option>
                    <option value="driver">Driver</option>
                    <option value="bartender">Bartender</option>
                    <option value="waiter">Waiter</option>
                    <option value="maid">Maid</option>
                    <option value="gardener">Gardener</option>
                    <option value="tailor">Tailor</option>
                    <option value="barber">Barber</option>
                    <option value="beautician">Beautician</option>
                    <option value="personal-trainer">Personal Trainer</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
                    <div class="col-md-6">
                    <label for="nakatha">Born Nakatha: </label>
                    <select id="nakatha" name="nakatha" class="form-control">
                        <option value="" disabled selected>Select Nakatha</option>
                        <option value="අස්විද">අස්විද</option>
                        <option value="බෙරණ">බෙරණ</option>
                        <option value="කැති">කැති</option>
                        <option value="රෙහෙන">රෙහෙන</option>
                        <option value="මුවසිරස">මුවසිරස</option>
                        <option value="අද">අද</option>
                        <option value="පුනාවස">පුනාවස</option>
                        <option value="පුෂ">පුෂ</option>
                        <option value="අස්ලිය">අස්ලිය</option>
                        <option value="මා">මා</option>
                        <option value="පුවපල්">පුවපල්</option>
                        <option value="උතුරුපල්">උතුරුපල්</option>
                        <option value="හත">හත</option>
                        <option value="සිත">සිත</option>
                        <option value="සා">සා</option>
                        <option value="විසා">විසා</option>
                        <option value="අනුර">අනුර</option>
                        <option value="දෙට">දෙට</option>
                        <option value="මුල">මුල</option>
                        <option value="පුවසල">පුවසල</option>
                        <option value="උතුරුසල">උතුරුසල</option>
                        <option value="සුවණ">සුවණ</option>
                        <option value="දෙනට">දෙනට</option>
                        <option value="සියාවස">සියාවස</option>
                        <option value="පුවපුටුප">පුවපුටුප</option>
                        <option value="උත්‍රපුටුප">උත්‍රපුටුප</option>
                        <option value="රේවතී">රේවතී</option>
                    </select>
                </div>
            </div>

        <div class="form-group row">
            <div class="col-md-6">
            <div class="form-group"> 
                <label for="nationality">Nationality:</label>
                <select id="nationality" name="nationality" class="form-control" required>
                    <option value="" disabled selected>Nationality</option>
                    <option value="srilankan">Sri Lankan</option>
                    <option value="other">Other</option>
                </select>
            </div>
           </div> 

            <div class="col-md-6">
            <div class="form-group"> 
                <label for="religion">Religion:</label>
                <select id="religion" name="religion" class="form-control" required>
                    <option value="" disabled selected>Religion</option>
                    <option value="buddhism">Buddhism</option>
                    <option value="christianity">Christianity</option>
                    <option value="islam">Islam</option>
                    <option value="hinduism">Hinduism</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-6">       
            <div class="form-group"> 
                <label for="relationship_status">Relationship Status:</label>
                <select id="relationship_status" name="relationship_status" class="form-control" required>
                    <option value="" disabled selected>Relationship Status</option>
                    <option value="single">Single</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-6">    
            <div class="form-group"> 
                <label for="education_level">Education Level:</label>
                <select id="education_level" name="education_level" class="form-control" required>
                    <option value="" disabled selected>Education Level</option>
                    <option value="ol">O/L</option>
                    <option value="al">A/L</option>
                    <option value="diploma">Diploma</option>
                    <option value="hnd">Higher National Diploma</option>
                    <option value="bachelor">Bachelor's Degree</option>
                    <option value="master">Master's Degree</option>
                    <option value="phd">PhD</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class = "form-group row">
        <div class="col-md-6">    
            <div class="form-group"> 
                <label for="height">Cast :</label>
                <select id="caste" name="caste" class="form-control" required>
                    <option value="Govigama">Govigama</option>
                    <option value="Radala">Radala</option>
                    <option value="Salagama">Salagama</option>
                    <option value="Durava">Durava</option>
                    <option value="Karawe">Karawe</option>
                    <option value="Berava">Berava</option>
                    <option value="Nawabadda (Hena)">Nawabadda (Hena)</option>
                    <option value="Bathgama">Bathgama</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group"> 
                <label for="monthly_Income">Monthly Income (Rs.):</label>
                <input type="number" id="monthly_Income" name="monthly_Income" class="form-control" placeholder = "Enter Your Income" required>
            </div>
        </div>
        </div>

    <div class="form-group row">
                <div class="col-md-6">
                <div class="form-group"> 
                <label for="mother_profession">Mother Profession:</label>
                <select id="mother_profession" name="mother_profession" class="form-control" required>
                    <option value="" disabled selected>Profession</option>
                    <!-- Options for Profession -->
                    <option value="teacher">Teacher</option>
                    <option value="engineer">Engineer</option>
                    <option value="doctor">Doctor</option>
                    <option value="lawyer">Lawyer</option>
                    <option value="artist">Artist</option>
                    <option value="businessperson">Businessperson</option>
                    <option value="chef">Chef</option>
                    <option value="nurse">Nurse</option>
                    <option value="software-engineer">Software Engineer</option>
                    <option value="architect">Architect</option>
                    <option value="accountant">Accountant</option>
                    <option value="journalist">Journalist</option>
                    <option value="police-officer">Police Officer</option>
                    <option value="firefighter">Firefighter</option>
                    <option value="pilot">Pilot</option>
                    <option value="pharmacist">Pharmacist</option>
                    <option value="mechanic">Mechanic</option>
                    <option value="social-worker">Social Worker</option>
                    <option value="farmer">Farmer</option>
                    <option value="scientist">Scientist</option>
                    <option value="musician">Musician</option>
                    <option value="dancer">Dancer</option>
                    <option value="writer">Writer</option>
                    <option value="civil-servant">Civil Servant</option>
                    <option value="military-officer">Military Officer</option>
                    <option value="photographer">Photographer</option>
                    <option value="psychologist">Psychologist</option>
                    <option value="consultant">Consultant</option>
                    <option value="real-estate-agent">Real Estate Agent</option>
                    <option value="interior-designer">Interior Designer</option>
                    <option value="fashion-designer">Fashion Designer</option>
                    <option value="event-planner">Event Planner</option>
                    <option value="dentist">Dentist</option>
                    <option value="veterinarian">Veterinarian</option>
                    <option value="sports-coach">Sports Coach</option>
                    <option value="athlete">Athlete</option>
                    <option value="tour-guide">Tour Guide</option>
                    <option value="librarian">Librarian</option>
                    <option value="translator">Translator</option>
                    <option value="public-relations-specialist">Public Relations Specialist</option>
                    <option value="marketing-specialist">Marketing Specialist</option>
                    <option value="graphic-designer">Graphic Designer</option>
                    <option value="data-analyst">Data Analyst</option>
                    <option value="cybersecurity-specialist">Cybersecurity Specialist</option>
                    <option value="biologist">Biologist</option>
                    <option value="chemist">Chemist</option>
                    <option value="physicist">Physicist</option>
                    <option value="geologist">Geologist</option>
                    <option value="environmentalist">Environmentalist</option>
                    <option value="astronomer">Astronomer</option>
                    <option value="anthropologist">Anthropologist</option>
                    <option value="sociologist">Sociologist</option>
                    <option value="historian">Historian</option>
                    <option value="economist">Economist</option>
                    <option value="urban-planner">Urban Planner</option>
                    <option value="carpenter">Carpenter</option>
                    <option value="electrician">Electrician</option>
                    <option value="plumber">Plumber</option>
                    <option value="construction-worker">Construction Worker</option>
                    <option value="driver">Driver</option>
                    <option value="bartender">Bartender</option>
                    <option value="waiter">Waiter</option>
                    <option value="maid">Maid</option>
                    <option value="gardener">Gardener</option>
                    <option value="tailor">Tailor</option>
                    <option value="barber">Barber</option>
                    <option value="beautician">Beautician</option>
                    <option value="personal-trainer">Personal Trainer</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
            
            <div class="col-md-6">
                <div class="form-group"> 
                <label for="father_profession">Father Profession:</label>
                <select id="father_profession" name="father_profession" class="form-control" required>
                    <option value="" disabled selected>Profession</option>
                    <!-- Options for Profession -->
                    <option value="teacher">Teacher</option>
                    <option value="engineer">Engineer</option>
                    <option value="doctor">Doctor</option>
                    <option value="lawyer">Lawyer</option>
                    <option value="artist">Artist</option>
                    <option value="businessperson">Businessperson</option>
                    <option value="chef">Chef</option>
                    <option value="nurse">Nurse</option>
                    <option value="software-engineer">Software Engineer</option>
                    <option value="architect">Architect</option>
                    <option value="accountant">Accountant</option>
                    <option value="journalist">Journalist</option>
                    <option value="police-officer">Police Officer</option>
                    <option value="firefighter">Firefighter</option>
                    <option value="pilot">Pilot</option>
                    <option value="pharmacist">Pharmacist</option>
                    <option value="mechanic">Mechanic</option>
                    <option value="social-worker">Social Worker</option>
                    <option value="farmer">Farmer</option>
                    <option value="scientist">Scientist</option>
                    <option value="musician">Musician</option>
                    <option value="dancer">Dancer</option>
                    <option value="writer">Writer</option>
                    <option value="civil-servant">Civil Servant</option>
                    <option value="military-officer">Military Officer</option>
                    <option value="photographer">Photographer</option>
                    <option value="psychologist">Psychologist</option>
                    <option value="consultant">Consultant</option>
                    <option value="real-estate-agent">Real Estate Agent</option>
                    <option value="interior-designer">Interior Designer</option>
                    <option value="fashion-designer">Fashion Designer</option>
                    <option value="event-planner">Event Planner</option>
                    <option value="dentist">Dentist</option>
                    <option value="veterinarian">Veterinarian</option>
                    <option value="sports-coach">Sports Coach</option>
                    <option value="athlete">Athlete</option>
                    <option value="tour-guide">Tour Guide</option>
                    <option value="librarian">Librarian</option>
                    <option value="translator">Translator</option>
                    <option value="public-relations-specialist">Public Relations Specialist</option>
                    <option value="marketing-specialist">Marketing Specialist</option>
                    <option value="graphic-designer">Graphic Designer</option>
                    <option value="data-analyst">Data Analyst</option>
                    <option value="cybersecurity-specialist">Cybersecurity Specialist</option>
                    <option value="biologist">Biologist</option>
                    <option value="chemist">Chemist</option>
                    <option value="physicist">Physicist</option>
                    <option value="geologist">Geologist</option>
                    <option value="environmentalist">Environmentalist</option>
                    <option value="astronomer">Astronomer</option>
                    <option value="anthropologist">Anthropologist</option>
                    <option value="sociologist">Sociologist</option>
                    <option value="historian">Historian</option>
                    <option value="economist">Economist</option>
                    <option value="urban-planner">Urban Planner</option>
                    <option value="carpenter">Carpenter</option>
                    <option value="electrician">Electrician</option>
                    <option value="plumber">Plumber</option>
                    <option value="construction-worker">Construction Worker</option>
                    <option value="driver">Driver</option>
                    <option value="bartender">Bartender</option>
                    <option value="waiter">Waiter</option>
                    <option value="maid">Maid</option>
                    <option value="gardener">Gardener</option>
                    <option value="tailor">Tailor</option>
                    <option value="barber">Barber</option>
                    <option value="beautician">Beautician</option>
                    <option value="personal-trainer">Personal Trainer</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>        

    <div class = "form-group row">
        <div class="col-md-6">    
            <div class="form-group"> 
                <label for="height">Height (cm):</label>
                <input type="number" id="height" name="height" class="form-control" placeholder="Enter Height" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group"> 
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" name="weight" class="form-control" placeholder="Enter weight" required>
            </div>
        </div>
        </div>

    <div class="form-group row">
        <div class = "col-md-6">
            <div class="form-group"> 
                <label for="smoking">Smoking Habits:</label>
                <select id="smoking" name="smoking" class="form-control" required>
                    <option value="" disabled selected>Smoking Habits</option>
                    <option value="non-smoker">Non-Smoker</option>
                    <option value="occasional-smoker">Occasional Smoker</option>
                    <option value="regular-smoker">Regular Smoker</option>
                </select>
            </div>
        </div>    

        <div class = "col-md-6">
            <div class="form-group"> 
                <label for="drinking">Drinking Habits:</label>
                <select id="drinking" name="drinking" class="form-control" required>
                    <option value="" disabled selected>Drinking Habits</option>
                    <option value="non-drinker">Non-Drinker</option>
                    <option value="occasional-drinker">Occasional Drinker</option>
                    <option value="regular-drinker">Regular Drinker</option>
                </select>
            </div>
         </div>   
     </div>

   <div class="form-group row">
    <div class="col-md-12">
        <div class="form-group"> 
            <label for="hobbies">Hobbies:</label>
            <textarea id="hobbies" name="hobbies" rows="2" cols="45"></textarea>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="bio">About Me:</label>
            <textarea id="bio" name="bio" rows="5" cols="45"></textarea>
        </div>
    </div>
</div>

        <!-- Submit Button -->
        <br><center><button type="submit" class="btn-register">Submit</button></center>
    </form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
