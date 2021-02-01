<?php
include "/includes/config.php";
include "/includes/database.php";

$remember=$_POST["remember"];
$login=$_POST["login"];
$password=$_POST["password"];
$email=$_POST["email"];
$code=$_POST["code"];
$code_act=$_POST["code_act"];

if($code!=$code_act){
    echo 2;
   // echo "Введенный код не совпадает с действительным";
}

else{
    if(mysqli_query($connect,"INSERT INTO User(Nickname , Password , EMail, Role_id, Avatar) VALUES ('$login','$password','$email','3','avatar.jpeg')")){


        $data=mysqli_query($connect, "SELECT * FROM User WHERE User.Nickname='$login' AND User.Password='$password'");
        $user=mysqli_fetch_assoc($data);

        if(isset($_POST['remember'])){
            setcookie('id',$user['id'],time()+3600*24*21);
            setcookie('username',$user['Nickname'],time()+3600*24*21);
            setcookie('role_id',$user['Role_id'],time()+3600*24*21);
            setcookie('Avatar',$user['Avatar'],time()+3600*24*21);
            $r_id = $user['Role_id'];
            $query = mysqli_query($connect, "SELECT * FROM Role WHERE Role.id='$r_id'");
            $r_name = mysqli_fetch_assoc($query);
            setcookie('role_name',$r_name['Role'],time()+3600*24*21);
        }

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['Nickname'];
        $_SESSION['role_id'] = $user['Role_id'];
        $_SESSION['Avatar']=$user['Avatar'];
        $r_id = $user['Role_id'];
        $query = mysqli_query($connect, "SELECT * FROM Role WHERE Role.id='$r_id'");
        $r_name = mysqli_fetch_assoc($query);
        $_SESSION['role_name'] = $r_name['Role'];

        echo 1;
    }



}

?>
