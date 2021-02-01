<?php $connect = mysqli_connect( "localhost","root", "", "BlogSQL");
if($connect==false){
    echo "Error:Cannot connect to database.Reason: <br>";
    echo mysqli_connect_error();
}

