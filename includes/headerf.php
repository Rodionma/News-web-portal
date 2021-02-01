<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <link rel="stylesheet" href="/styles/styles.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="/utility/Logo%20Icon.png" type="image/x-icon">
    <title><?php echo $page_name; ?>-Журнал ЗНТУ</title>




    <div class="mainmenu">

        <a href="index.php" class="logo"><img src="/utility/Logo%20Icon.png"></a>
         <h2> Кущ </h2>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cloud.tinymce.com/5-testing/tinymce.min.js?apiKey=b5sn2t57gpp6nbv319mqck7kas7mnky9tbabrtaubt5qlzr6"></script>
    <script>tinymce.init({



            selector:'textarea',
             width:620,
            height:500,

            plugins: 'link image imagetools quickbars',
            toolbar: "undo redo | styleselect | bold italic | alignleft"
                + "aligncenter alignright alignjustify | "
                + "bullist numlist outdent indent | link image | forecolor |backcolor",
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
    });</script>



<div class="iconbar">
   <?php $cat = mysqli_query($connect, "SELECT * FROM Category");
    ?>

        <li class="catbutton"> <img src="/utility/Menu%20Icon.png" alt="">
            <div class="cats">
                <?php //Вывод категорий

                //-----------------------------------------------------------------
                while ( $ca = mysqli_fetch_assoc($cat)){
                ?>

        <ul> <a href ='/cat_search.php?id=<?php echo $ca['id'] ?>'><?php echo $ca['Category']; ?> </a> </ul>

    <?php }
    //--------------------------------------------------------------------
    ?> </div>
        </li>

        <li class="usbutton"><img src="/utility/Login%20Icon.png" alt="">
            <div class="user">
            <?php

            if(isset($_COOKIE['id'])){
                $_SESSION["id"]=$_COOKIE["id"];
                $_SESSION["username"]=$_COOKIE['username'];
                $_SESSION["role_name"]=$_COOKIE["role_name"];
                $_SESSION["role_id"]=$_COOKIE["role_id"];
                $_SESSION["Avatar"]=$_COOKIE["Avatar"];?>
                <img  class="avatar" width="100" height="100" src="/avatars/<? echo $_SESSION['Avatar'];?>">
                <p><? echo $_SESSION['role_name'];?></p>
                <p class="username"><strong><? echo $_SESSION['username']; ?></strong></p>

                <p><a href='/userdata.php?id= <?php echo $_SESSION['id'];  ?>'>Перейти в профіль</a></p>
                <p><a href='/logout.php'>Вийти</a></p>
            <?php }
            else if(isset($_SESSION['id'])){ ?>
                <img class="avatar" width="100" height="100" src="/avatars/<? echo $_SESSION['Avatar'];?>">
                <p ><? echo $_SESSION['role_name'];?></p>
                <p class="username"><strong><? echo $_SESSION['username']; ?></strong></p>

                <p><a href='/userdata.php?id= <?php echo $_SESSION['id'];  ?>'>Перейти в профіль</a></p>
                <p><a href='/logout.php'>Вийти</a></p>
            <?php   }
            else {echo "<p class='logmsg'>Вы не авторизовані   <a href=\"authorizeform.php\">Авторизація</a>
    <a href=\"registrationform.php\">Реєстрация</a></p>"; }
            ?>


            </div>
        </li>


    <li id="searchbutton"><img src="/utility/Search%20Icon.png" alt=""> </li>
</div>
    </div>

<div class="searchbox">
    <h1>Пошук</h1>
    <form name="search" method="post" action="search.php">
        <input type="text" name="request" placeholder="Введить ваш запит">
        <input type="submit" value="Знайти">
        <h3>Пошук за категоріями</h3>
        <?php   foreach ($cat as $art_c){ ?>
            <p class="checkblock2">
            <input type="checkbox" name="<?php echo $art_c['id']; ?>" id="<?php echo "s".$art_c['id']; ?>" value="true">
               <label for="<?php echo "s".$art_c['id']; ?>"> <?php echo $art_c['Category'] ?></label>
            </p>
      <?php  } ?>


    </form>
</div>

    <script type="text/javascript">
        $('#searchbutton').click(function () {
            $(".searchbox").animate({width:"show"},200);
        });
        $(document).mouseup(function (e){
            var div = $(".searchbox");
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                $(".searchbox").animate({width:"hide"},200);
            }
        });



    </script>



</head>


<body>
