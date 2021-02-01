<?php
include "/includes/config.php";
$page_name="Авторизация";
include "/includes/database.php";
include "/includes/headerf.php";


?>

<div class="formblock">
<form id="authorize" action="authorize.php" enctype="multipart/form-data" name="authorize" method="post" accept-charset="UTF-8" >
    <h1>Авторизація</h1>

  <input type="text" placeholder="Ім'я користувача" name="Login"><br><br><br>

    <input type="password" placeholder="Пароль" name="Password"><br><br>

    <div class="checkblock">
    <input type="checkbox" id="remcheck" name="Remember" value="true">
    <label for="remcheck">Запам'ятати мене</label><br><br>
    </div>

    <input type="submit" value="Авторизація">

    <p id="result"> </p>
</form>
</div>


<script type="text/javascript">
    $("#authorize").submit(function(event){

        var sign=$(this).find('input, select, textarea, button').serialize();
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/authorize.php",
            data: sign,
            success: function (res) {
               // $("#result").html(res);
                if(res==1){
                    window.location.replace("/index.php");
                }
                else if (res==2){
                    $("#result").html("<p class='error'>Невірно введений логин та/або пароль</p>");
                }

            }
        });
        return false;
    });
</script>

<?php
include "/includes/footer.php";?>
