<?php

session_start();
if(isset($_SESSION["uuid"]))
{

}
else
{
    header("Location: login.php");
}

?>
<div class="header">
        <div class="left">
            <h1><i class="fas fa-blog"></i>&nbsp;&nbsp;Sam Blog</h1>
        </div>
        <div class="right">
            <p id="timeHere"></p>&nbsp;&nbsp;&nbsp;
            <button><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
        </div>
    </div>