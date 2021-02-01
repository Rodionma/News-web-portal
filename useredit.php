<?php
include "/includes/config.php";
$page_name="Редагування";

include "/includes/database.php";

include "/includes/headerf.php";


$errors=0;
$name=$_POST['Nickname'];
$id=$_POST['id'];

if(isset($_POST["role"])){
    $role=$_POST["role"];

}

if($name==""){
    echo "Введить ім'я\n";
    $errors=1;
}

$query1="UPDATE User SET Nickname='$name' ";
$query2="WHERE (id=$id)";


if($_FILES["avatar"]["name"]!=""){


    $filebasename = iconv('utf-8','utf-8' , basename($_FILES["avatar"]["name"]));
    $ext = strtolower(substr($filebasename,strpos($filebasename,'.')+1));

    $filename = iconv('utf-8','utf-8',$_FILES["avatar"]["name"]);

    if($ext=="jpg"||$ext=="tiff"||$ext=="png"||$ext=="bmp"||$ext=="gif"||$ext=="jpeg"){
        $dir="avatars/";
        $add="";

        if (file_exists($dir.$filename)){

            $add=$add.rand();
            $filename=$add.$filename;
            move_uploaded_file($_FILES["avatar"]["tmp_name"],$dir.$filename);
            $query1=$query1.", Avatar='$filename'";

        }
        else{

            move_uploaded_file($_FILES["avatar"]["tmp_name"],$dir.$filename);}//Перемещение файла в папку
        $query1=$query1.", Avatar='$filename' ";

    }
    else {
        echo "<p class='error'>Помилка невірний формат файлу зображення</p>";
        $errors =1;
    }
}

if(isset($_POST["role"])){
    $role=$_POST["role"];
    $query1=$query1.", Role_id='$role' ";
}

$query=$query1.$query2;

if($errors==0){
    if (mysqli_query($connect, $query)) {
        $_SESSION['username'] = $name;
        $_SESSION['Avatar'] = $filename;
        if(isset($_COOKIE['id'])){
            $_COOKIE['username']= $name;
            $_COOKIE['Avatar']=$filename;
        }
        echo "Данні успішно редагоовані";

    }
    else echo "Помилка оновлення";
}

include "/includes/footer.php";