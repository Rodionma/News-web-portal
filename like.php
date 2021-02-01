<?php
include "/includes/config.php";
include "/includes/database.php";

$userdata=$_POST['user'];
$articledata=$_POST['article'];


if($_POST["isliked"]==0){
    mysqli_query($connect,"INSERT INTO Likes(Article_id,User_id) VALUES ('$articledata','$userdata')");
    mysqli_query($connect,"UPDATE Article SET Likes = Likes+1 WHERE (id=$articledata)");
}
else
{
    mysqli_query($connect,"DELETE FROM Likes WHERE (Article_id=$articledata) AND (User_id=$userdata)");
    mysqli_query($connect,"UPDATE Article SET Likes = Likes-1 WHERE (id=$articledata)");
}

