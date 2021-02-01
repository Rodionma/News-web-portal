<?php
include "/includes/config.php";
$page_name="Редактирование статьи";

include "/includes/database.php";
include "/includes/headerf.php";

$errors=0;
if($_POST['name']==""||$_POST['Text']==""){
    echo "<p class='error'>Будь ласка заповніть всі поля</p>";?>

    <?php $errors=1;
}


$id=$_POST['id'];
$name=$_POST['name'];
$Text=$_POST['Text'];
$cate=$_POST['cat'];
$filename=0;

if($_FILES["image"]["name"]!=""){


    $filebasename = iconv('utf-8','utf-8' , basename($_FILES["image"]["name"]));
    $ext = strtolower(substr($filebasename,strpos($filebasename,'.')+1));

    $filename = iconv('utf-8','utf-8',$_FILES["image"]["name"]);

    if($ext=="jpg"||$ext=="tiff"||$ext=="png"||$ext=="bmp"||$ext=="gif"){
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
        echo "<p class='error'>Помилка.Невірний формат файлу зображення</p>";
        $errors =1;
    }
}

if($errors==0){
    if($filename!=0) {
        if (mysqli_query($connect, "UPDATE Article SET Name='$name', Text='$Text' , Category_id='$cate' ,Image='$filename' WHERE (id=$id)")) {
            echo "<p class='success'>Стаття успішно редагована</p>";
        }
        else echo "<p class='error'>Помилка оновлення</p>";
    }
    else{

        if (mysqli_query($connect, "UPDATE Article SET Name='$name', Text='$Text', Category_id='$cate' WHERE id=$id")) {
            echo "<p class='success'>Стаття успішно редагована</p>";
        }
        else echo "<p class='error'>Помилка оновлення</p>";

    }

}

include "/includes/footer.php";
