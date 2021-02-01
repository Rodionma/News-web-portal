<?php
include "/includes/config.php";
$page_name="Створити статтю";
include "/includes/database.php";
include "/includes/headerf.php";
?>
<div class="formparrent">
<div class="invisible"></div>

<div class="formblock">
<form id="addform" action="article_add.php" enctype="multipart/form-data" name="article_add" method="post" accept-charset="UTF-8" ,>
<label>Заголовок:</label></br>
    <input type="text" name="name" placeholder="Заголовок"> </br></br></br>
    <label>Текст статті</label></br>
    <textarea name="Text" id="editor" rows="10" cols="45" placeholder="Текст"></textarea></br></br></br>



    <label>Зображення</label></br>
    <input type="file" name="image"></br></br></br>
    <label>Категорія</label></br>
    <select name="cat">
       <?php
       foreach ($cat as $art_c){

           ?><option value="<?php echo $art_c['id']?>"><?php echo $art_c['Category'];?></option>
       <?php  }
       ?>
    </select> </br></br></br>

    <input type="submit" value="Додати">

</form></br>

</div>
</div>

<?php
include "/includes/footer.php";
?>


