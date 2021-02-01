<?php
include "/includes/config.php";
$page_name="Редактирование";

include "/includes/database.php";
$id=$_GET['id'];

$res = mysqli_query($connect, "SELECT * FROM User WHERE User.id=$id");
$ar = mysqli_fetch_assoc($res);
$res22 =  mysqli_query($connect, "SELECT * FROM Role");

include "/includes/headerf.php";

?>
    <div class="formblock">
        <form id="userupdateform" action="useredit.php" enctype="multipart/form-data" name="userupdateform" method="post" accept-charset="UTF-8" ,>
            <p>Ім'я користувача</p>
            <input type="text" name="Nickname" placeholder="Ім'я користувача" value="<?php echo $ar['Nickname'] ?>">
            <p>Аватар</p>
            <input type="file" name="avatar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <?php if($_SESSION['role_id']==1){ ?>
            <p>Роль</p>
            <select name="role">

                <?php  while ($role = mysqli_fetch_assoc($res22)) {

                    ?><option value="<?php echo $role['id']?>"><?php echo $role['Role'];?></option>
                <?php  }
                } ?> </select>
            <p></p>
            <input type="submit" value="Редагувати">
        </form>
    </div>
<?php include "/includes/footer.php"; ?>