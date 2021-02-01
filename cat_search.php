<?php
include "/includes/config.php";
include "/includes/database.php";

$cat_id=$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM Article WHERE Article.Category_id=$cat_id");

$page = mysqli_query($connect, "SELECT * FROM Category WHERE Category.id=$cat_id");

 $page_r = mysqli_fetch_assoc($page);
    $page_name=$page_r["Category"];


include "/includes/headerf.php";?>

<h1><?php echo "Всі статті з категорії:".$page_name ?></h1>


<?php
 //Вывод статей
//-----------------------------------------------------------------
while ( $ar = mysqli_fetch_assoc($res)){
   ?>
<?php /*if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>
    <a href ='/delete_art.php?id=<?php echo $ar['id'] ?>'>Удалить </a> <br>
    <a href ='/updateform.php?id=<?php echo $ar['id'] ?>'>Редактировать </a> <br> <?php  } ?>
   <h1> <a href ='/article.php?id=<?php echo $ar['id'] ?>'><?php echo $ar['Name']; ?> </a> </h1> <br>
    <h1> <a href ='/article.php?id=<?php echo $ar['id'] ?>'> <img src="/images/<?php echo $ar["Image"] ?>" alt=""> </a> </h1> <br>
<?php
*/
?>

    <div class="art-p">

        <?php if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>
            <div class="editblock">
                <a href ='/delete_art.php?id=<?php echo $ar['id'] ?>'><img src="/utility/delete.png"> </a> <br>
                <a href ='/updateform.php?id=<?php echo $ar['id'] ?>'><img src="/utility/edit.png"> </a> <br>
            </div>
        <?php } ?>




        <br>
        <div class="art-p-img"> <h1>   <a href ='/article.php?id=<?php echo $ar['id'] ?>'> <img src="/images/<?php echo $ar["Image"] ?>" alt=""> </a> </h1> </div> <br>

        <div class="art-p-content">

            <h1> <a href ='/article.php?id=<?php echo $ar['id'] ?>'><?php echo $ar['Name']; ?> </a> </h1>
            <?php $text=strip_tags($ar['Text']);
            echo "<p>".mb_substr($text,0,100,'utf-8')."</p>";?>
        </div>

    </div>

<?
}
include "/includes/footer.php";
?>
