<?php

require_once("../../config/database.php");

$conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

function getAdminUuid()
{
    $sql = "SELECT uuid FROM admin";
    $result = $GLOBALS['conn']->query($sql);
    $data=$result->fetch_assoc();
    $uuid =  $data['uuid'];
    return $uuid;
}

?>