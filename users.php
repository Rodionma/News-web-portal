<?php
include "/includes/config.php";
$page_name="Користувачі";
include "/includes/database.php";
include "/includes/headerf.php";
$res = mysqli_query($connect, "SELECT * FROM User ORDER BY Nickname");
while ( $us = mysqli_fetch_assoc($res)) {
?> <a href="/userdata.php?id=<?php echo $us['id'] ?>"> <?php echo $us['Nickname']."<br>"; ?> <a/>
<?php } ?>

