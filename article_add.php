<?php
include "/includes/config.php";
include "/includes/database.php";
include "/includes/headerf.php";
?>

<?php

$errors=0;
if($_POST['name']==""||$_POST['Text']==""){
    echo "<p class='error'>Будь ласка заповніть всі поля</p>";?><br>

<?php $errors=1;
}



$name=$_POST['name'];
$Text=$_POST['Text'];
$cate=$_POST['cat'];
$filebasename=basename($_FILES["image"]["name"]);
$ext = strtolower(substr($filebasename,strpos($filebasename,'.')+1));
$filename=$_FILES["image"]["name"];
if($ext=="jpg"||$ext=="tiff"||$ext=="png"||$ext=="bmp"||$ext=="gif"||$ext=="jpeg"){
    $dir="images/";
$add="";

if (file_exists($dir.$filename)){

    $add=$add.rand();
    $filename=$add.$filename;
    move_uploaded_file($_FILES["image"]["tmp_name"],$dir.$filename);
}
else{

    move_uploaded_file($_FILES["image"]["tmp_name"],$dir.$filename);}//Перемещение файла в папку
}
else {
    echo "<p class='error'>Помилка.Невірний формат зображення</p>";
    $errors =1;
}
$date=date('Y.m.d');

if($errors==0){

if(mysqli_query($connect,"INSERT INTO Article(Name , Text , Image, Date, Views, Likes ,Category_id) VALUES ('$name','$Text','$filename','$date','0','0','$cate')")){
    echo "<p class='success'>Стаття успішно створена</p>";
}
else echo "<p class='error'>Помилка завантаження</p>";
}

include "/includes/footer.php";?>