<?php
    include "/includes/config.php";
    include "/includes/database.php";

    $remember=$_POST["Remember"];
$login=$_POST["Login"];
$password=$_POST["Password"];

$password = password_hash($password,PASSWORD_BCRYPT,['salt' => SALT]);

$res = mysqli_query($connect, "SELECT * FROM User WHERE BINARY User.Nickname='$login' AND BINARY User.Password='$password'");
$user=mysqli_fetch_assoc($res);
$data=mysqli_num_rows($res);

 if ($remember=="true"){

        setcookie('id',$user['id'],time()+3600*24*21);
        setcookie('username',$user['Nickname'],time()+3600*24*21);
        setcookie('role_id',$user['Role_id'],time()+3600*24*21);
        setcookie('Avatar',$user['Avatar'],time()+3600*24*21);
     $r_id = $user['Role_id'];
     $query = mysqli_query($connect, "SELECT * FROM Role WHERE Role.id='$r_id'");
     $r_name = mysqli_fetch_assoc($query);
        setcookie('role_name',$r_name['Role'],time()+3600*24*21);
    }


    $page_name="Авторизация";



    if($data==0){
        echo 2;

    }
    else {

      // echo "Авторизация успешна вернитесь на <a href='index.php'>главную страницу</a> ";
    echo 1;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['Nickname'];
        $_SESSION['role_id'] = $user['Role_id'];
        $_SESSION['Avatar']=$user['Avatar'];
        $r_id = $user['Role_id'];
        $query = mysqli_query($connect, "SELECT * FROM Role WHERE Role.id='$r_id'");
        $r_name = mysqli_fetch_assoc($query);
        $_SESSION['role_name'] = $r_name['Role'];

    }


    ?>

