<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function is_mobile($user_agent) {
    return preg_match('/(android|iphone|ipad|ipod|blackberry|windows phone)/i', $user_agent);
}

if (is_mobile($user_agent)) {
    header("Location: m.index.php");
} else {
    header("Location: w.index.php");
}
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        window.onload = function() {
            if (window.innerWidth <= 768) {
                window.location.href = "m.index.php"; 
            } else {
                window.location.href = "w.index.php";
            }
        };
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>
