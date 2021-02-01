<?php
include "/includes/config.php";
$page_name="Редактирование статьи";

include "/includes/database.php";
$id=$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM Article WHERE Article.id=$id");
$ar = mysqli_fetch_assoc($res);
include "/includes/headerf.php";


?>
<div class="formparrent">
    <div class="invisible"></div>

    <div class="formblock">
<form id="updateform" action="/update_art.php" enctype="multipart/form-data" name="article_update" method="post" accept-charset="UTF-8" ,>
    <label>Заголовок:</label></br>
    <input type="text" name="name" placeholder="Заголовок" value="<?php echo $ar['Name'] ?>"> </br></br></br>
    <label>Текст статьи</label></br>
    <textarea name="Text" id="editor" rows="10" cols="45" placeholder="Текст">
        <?php echo $ar["Text"] ?>
    </textarea></br></br></br>



    <label>Изображение</label></br>
    <input type="file" name="image"></br></br></br>
    <label>Категория</label></br>
    <select name="cat">
        <?php
        foreach ($cat as $art_c){

            ?><option <? if($art_c['id']==$ar['Category_id']){echo "selected";} ?> value="<?php echo $art_c['id']?>"><?php echo $art_c['Category'];?></option>
        <?php  }
        ?>
    </select> </br></br></br>
<input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="submit" value="Редагувати">

</form></br>

    </div>
</div>

<?php
include "/includes/footer.php";
?>
