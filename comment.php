<?php
    include "/includes/config.php";
    include "/includes/database.php";

    $userid=$_POST["userid"];
    $articleid=$_POST["articleid"];
    $text=$_POST["textcom"];

    $date=date('Y.m.d');

    if(mysqli_query($connect,"INSERT INTO Comment(Text, Date, Article_id, User_id) VALUES ('$text','$date','$articleid','$userid')")){

        echo 1;

    }
    else echo 2;

?>