<?php
include "/includes/config.php";
$page_name="Видалення статті";
    include "/includes/database.php";
    include "/includes/headerf.php";


    $id=$_GET['id'];
  if( mysqli_query($connect,"DELETE FROM Article WHERE (id=$id)")){
      echo "Стаття успішно видалена";
  }
mysqli_query($connect,"DELETE FROM Likes WHERE (Article_id=$id)");
mysqli_query($connect,"DELETE FROM Comment WHERE (Article_id=$id)");
   include "/includes/footer.php";
?>