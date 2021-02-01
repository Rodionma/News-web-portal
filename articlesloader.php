<?php
include "/includes/config.php";
include "/includes/database.php";

$counter=$_POST['counter'];
//$upperlimit=(integer)($counter/10);

$upperlimit=$counter*10;
$lowerlimit=$upperlimit-10;

$res = mysqli_query($connect, "SELECT * FROM Article LIMIT $lowerlimit, $upperlimit");


while ( $ar = mysqli_fetch_assoc($res)){
    ?>



<div class="art-p">

    <?php if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>
        <div class="editblock">
            <a href ='/delete_art.php?id=<?php echo $ar['id'] ?>'><img src="/utility/delete.png"> </a> <br>
            <a href ='/updateform.php?id=<?php echo $ar['id'] ?>'><img src="/utility/edit.png"> </a> <br>
        </div> <?php } ?>

    <div class="art-p-img"> <h1>   <a href ='/article.php?id=<?php echo $ar['id'] ?>'> <img src="/images/<?php echo $ar["Image"] ?>" alt=""> </a> </h1> </div> <br>

    <div class="art-p-content">

        <h1> <a href ='/article.php?id=<?php echo $ar['id'] ?>'><?php echo $ar['Name']; ?> </a> </h1>
        <?php $text=strip_tags($ar['Text']);
        echo "<p>".mb_substr($text,0,100,'utf-8')."</p>";?>
    </div>

</div>

<?php }