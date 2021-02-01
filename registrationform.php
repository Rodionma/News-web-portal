<?php
include "/includes/config.php";
$page_name="Реєстрация";
include "/includes/database.php";
include "/includes/headerf.php";?>

<form id="register" action="register.php" enctype="multipart/form-data" name="register" method="post" accept-charset="UTF-8" >
    <div class="formblock">

        <h1>Реєстрація</h1>

    <input type="text" placeholder="Ім'я користувача" name="Login"><br><br>

    <input type="email" placeholder="E-mail" name="Email"><br><br>

    <input type="password" placeholder="Пароль" name="Password"><br><br>

    <input type="password" placeholder="Повторіть пароль" name="Confirm"><br><br>
        <div class="checkblock">
    <input id="remcheck" type="checkbox" name="Remember" value="true">
    <label for="remcheck">Залишатись в системі</label><br><br>
        </div>
    <p id="result"> </p>
    <input type="submit" value="Реєстрація">
</form>
</div>
<script type="text/javascript">
    $("#register").submit(function(event){

        var sign=$(this).find('input, select, textarea, button').serialize();
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/register.php",
            data: sign,
            success: function (res) {
                $("#result").html(res);


            }
        });
        return false;
    });
</script>
