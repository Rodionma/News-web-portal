<?php
include "/includes/config.php";
include "/includes/database.php";



$errors=0;

$remember=$_POST["Remember"];
$login=$_POST["Login"];
$password=$_POST["Password"];
$confirm=$_POST["Confirm"];
$email=$_POST["Email"];


if($login==""||$password==""||$confirm==""||$email==""){
    echo "<p class='error'>Будь ласка заповніть всі поля</p>";
    $errors=1;
}

if($password!=$confirm){
    echo "<p class='error'>Паролі повинні співпадати</p>";
    $errors=1;
}

$reg = mysqli_query($connect, "SELECT * FROM User WHERE User.Nickname='$login' OR User.Email='$email'");
$data=mysqli_num_rows($reg);
if($data!=0){
    echo "<p class='error'>Дані ім'я користувача або пароль вже використані будь ласка виберіть інший</p>";
    $errors=1;
}

if($errors==0){?>
    <?php
    $code=null;
    for ($i=0;$i<4;$i++){
      $code=$code.rand(0,9);
    }
    $password = password_hash($password,PASSWORD_BCRYPT,['salt' => SALT]);

    mail($email,"Реєстрація","Доброго дня, ".$login." Раді вітати на веб порталі Кущ. Щоб завершити реєстрацію введіть в спеціальному полі код: ".$code);
 echo"<p class='success'>На вказану вами адресу электронної пошти був відправлен лист з кодом. Будь ласка введіть його в поле </p>";
    ?>
    <div class="formblock">
    <form id="auth" action="authentification.php" name="auth" method="post">
        <input type="text" name="code">
        <input type="hidden" name="code_act" value="<?php echo $code?>">
        <input type="hidden" name="remember" value="<?php echo $remember?>">
        <input type="hidden" name="login" value="<?php echo $login?>">
        <input type="hidden" name="password" value="<?php echo $password?>">
        <input type="hidden" name="email" value="<?php echo $email?>">
        <input type="submit" value="Відправити">
        <p id="result"></p>
    </form>
    </div>
    <script type="text/javascript">
        $("#auth").submit(function(event){

            var sign2=$(this).find('input, select, textarea, button').serialize();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "/authentification.php",
                data: sign2,
                success: function (res) {
                   // $("#result").html(html);
                    if(res==1){
                        window.location.replace("/index.php");
                    }
                    else if (res==2){
                        $("#result").html("<p class='error'>Введений код не співпадає з дійсним</p>");
                    }

                }
            });
            return false;
        });
    </script>
<?php }
?>




