<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Sam Blog</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/dashboard.css">

    <script src="js/main.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/3b6311e0b4.js" crossorigin="anonymous"></script>

</head>
<body>
    
    <?php include "header.php" ?>
    <div class="menu">
        <ul>
            <li class="active">Dashboard</li>
            <li onclick="document.location.href='posts.php'">Posts</li>
            <li>Categories</li>
            <li>About Me</li>
            <li>Contact Me</li>
            <li>Settings</li>
        </ul>
    </div>
    <div class="content">

    </div>

</body>
</html>

<script>
    var datee = new Date()
    document.getElementById("timeHere").innerHTML = datee
</script>