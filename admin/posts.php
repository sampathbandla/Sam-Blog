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
    <link rel="stylesheet" href="css/posts.css">
    <link rel="stylesheet" href="css/jqueryui.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">

    <script src="js/jquery.js"></script>
    <script src="js/jqueryui.js"></script>
    <script src="js/main.js"></script>
    <script src="js/posts.js"></script>
    <script src="https://kit.fontawesome.com/3b6311e0b4.js" crossorigin="anonymous"></script>

</head>
<body>
    
    <?php include "header.php" ?>
    <div class="menu">
        <ul>
            <li onclick="document.location.href='dashboard.php'">Dashboard</li>
            <li class="active">Posts</li>
            <li>Categories</li>
            <li>About Me</li>
            <li>Contact Me</li>
            <li>Settings</li>
        </ul>
    </div>
    <div class="content"><br>
        <h1 class="title">Posts</h1><br>
        <hr>
        <br>
        <div class="filter">
            <select name="cat" id="cat" class="cat">
                <option value="0">Select Category</option>
                <option value="1">Google</option>
            </select>
            <input type="date" name="filter_date" id="filter_date">
            <input type="text" class="search" id="search" placeholder="Search for post...">
            <select name="filter_by" id="filter_by">
                <option value="0">Sort By Date</option>
                <option value="1">Sort By Views</option>
                <option value="2">Sort By Comments</option>
            </select>
            <button onclick="$('#window').show();"><i class="fas fa-plus"></i>&nbsp;Add New</button>
        </div><br>
        <hr>
       <table data-toggle="table">
           <thead>
               <tr class="table_head">
                    <th><input type="checkbox" name="" id="select_all"></th>
                   <th>Title</th>
                   <th>Modified Date</th>
                   <th>Views</th>
                   <th>Comments</th>
                   <th>Actions</th>
               </tr>
           </thead>
           <tbody>
               <?php

                    require_once("../config/database.php");

                    $conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM post ";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {
                        $sqlForCommentCount = "SELECT count(*) as total FROM comments where postid='" . $row['id'] . "'";
                        $commentCountResult = $conn->query($sqlForCommentCount);
                        $data=$commentCountResult->fetch_assoc();
                        $commentCount =  $data['total'];
                        echo '<tr>
                        <td><input type="checkbox" onclick="selectPost( ' . $row["id"] . ')" id=""></td>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['modified_date'] . '</td>
                        <td>' . $row['views'] . '</td>
                        <td>' . $commentCount . '</td>
                        <td><button id="Delete" onclick="deletePost(' . $row["id"] . ')" title="Delete"><i class="far fa-trash-alt"></i></button></td>
                    </tr>';
                    }


               ?>
           </tbody>
       </table>
    </div>

    <div id="window" class="resizable window">
        <div class="window_header">
            <div class="left">
                <div class="brand">
                    <i class="fas fa-blog"></i>
                </div>
            </div>
            <div class="right">
                <div class="controlbox">
                    <i onclick='$("#window").hide();' class="far fa-times-circle"></i>
                </div>
            </div>
        </div>
        <div class="window-content">
            <textarea id="postData">
                Welcome to TinyMCE!
            </textarea>
            <br><br><br>
                <input id="postTitle" type="text" placeholder="Title...">
                <div class="checkboxes">
                    <label for="commentsForNewPost">Comments Allowed</label>
                    <input type="checkbox" name="commentsForNewPost" value="1"  Checked id="commentsForNewPost">
                </div>
                <div class="postButtons">
                    <button onclick="savePost()" id="savePost">Publish</button>
                    <button id="draftPost">Draft</button>
                </div>
                <br>
        </div>
        
    </div>
</body>
</html>

<script>
    var datee = new Date()
    document.getElementById("timeHere").innerHTML = datee
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.tiny.cloud/1/m3pkbw7z1fbzbxeyy3t4yrj8cufzhyl6cwatvectt0d2t9v4/tinymce/5/tinymce.min.js"></script>


<script>
// div = document.getElementById("window")
// div.addEventListener('mousedown', function(e) {
//     isDown = true;
//     offset = [
//         div.offsetLeft - e.clientX,
//         div.offsetTop - e.clientY
//     ];
// }, true);

// document.addEventListener('mouseup', function() {
//     isDown = false;
// }, true);

// document.addEventListener('mousemove', function(event) {
//     event.preventDefault();
//     if (isDown) {
//         mousePosition = {

//             x : event.clientX,
//             y : event.clientY

//         };
//         div.style.left = (mousePosition.x + offset[0]) + 'px';
//         div.style.top  = (mousePosition.y + offset[1]) + 'px';
//     }
// }, true);



$("#window").hide();
$(function() {
    $("#window").draggable()
    // $('.resizable').resizable({'handles': 'w'});
    $('.resizable').resizable()
});


tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
    });
</script>


<style>
    .tox-notification {display:none!important;}
</style>