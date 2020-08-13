<?php

session_start();

require_once("../../functions/admin.php");



$conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if(getAdminUuid() == $_SESSION["uuid"])
{
    if($_POST["type"] == "ADD")
    {
        $postTitle = $_POST["postTitle"];
        $postData = $_POST["postData"];
        $isCommentsAllowed = $_POST["isCommentsAllowed"];
        $currentDate = $_POST["currentDateTime"];
        $query = "INSERT INTO post (`title`,`created_date`,`modified_date`,`post_data`,`views`,`status`,`comments`) VALUES ('" . $postTitle . "','" . $currentDate .  "','" . $currentDate .  "','" . $postData .  "',0,'CREATED','" . $isCommentsAllowed .  "')";
        // echo($query);
        if ($conn->query($query) === TRUE) {
            header('Content-Type: application/json');
            echo json_encode(array('STATUS' => 'SUCCESS'));
          } else {
            header('Content-Type: application/json');
            echo json_encode(array('STATUS' => 'ERROR',"ERRMSG" => "DB_ERROR"));
          }
    }
}
else
{
    header('Content-Type: application/json');
    echo json_encode(array('STATUS' => 'ERROR',"ERRMSG" => "UUID MisMatch please relogin!"));
}

?>