<?php

session_start();

require_once("../config/database.php");

if(isset($_POST["username"]))
{
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    
    if($username != "")
    {
        $conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM admin WHERE username='" . $username . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($password == $row["password"])
            {
                $uuid = uniqid();
                $sql = "UPDATE admin SET uuid='" . $uuid . "' WHERE username='" . $username . "'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION["uuid"] = $uuid;
                    header('Location: dashboard.php ');
                  } else {
                    echo "<p class='error'>Please check your username and password!</p>";
                  }                  
            }
            else
            {
                echo "<p class='error'>Please check your username and password!</p>";
            }
        }
        } else {
        echo "0 results";
        }
        $conn->close();
    }
    else
    {

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || Hi Sam</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <script src="js/main.js"></script>
</head>
<body>
    <div class="login_header">
        <h3>Welcome Sam :)</h3>
    </div>
    <div class="login_div">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <center><h2>Sign In</h2></center><br>
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <button>Login</button>
        </form>
    </div>
</body>
</html>