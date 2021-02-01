<?php
include "/includes/config.php";
include "/includes/database.php";

$id=$_GET['id'];

$res2 = mysqli_query($connect, "SELECT * FROM User WHERE User.id=$id");

$us = mysqli_fetch_assoc($res2);
$page_name=$us['Nickname'];



include "/includes/headerf.php";

$r_id=$us["Role_id"];

?>
<h1> Профіль користувача </h1> <br>

<div class="profile">

 <img width="300" height="300" src="/avatars/<?php echo $us["Avatar"];?>">


<div class="profile-data">
    <p> <?php echo $us['Nickname']; ?> </p>

<p> E-mail: <?php echo $us["EMail"]; ?></p>
<?php
$query = mysqli_query($connect, "SELECT * FROM Role WHERE Role.id='$r_id'");
$r_name = mysqli_fetch_assoc($query); ?>

<p> Роль: <?php echo $r_name["Role"]; ?></p>
<?php if ($_SESSION["role_id"]==1||$id==$_SESSION["id"]){ ?>

     <a href="usereditform.php?id=<?php echo $id; ?>"> Редагувати</a> <?php }?>
    </div>

    </div>



<?php
include "/includes/footer.php"; ?>