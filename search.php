<?php
    include "/includes/config.php";
    include "/includes/database.php";
    $page_name="Результаты запроса";
    include "/includes/headerf.php";

    $querysubtext='';
$request =$_POST['request'];



    for($i=0;$i<(mysqli_num_rows($cat))+1;$i++){
        if(isset($_POST[$i])){
            $querysubtext=$querysubtext." OR Category_id=$i";

        }

    }
    $querysubtext=substr($querysubtext,3);

    $querytext="SELECT * FROM Article WHERE (Article.Name LIKE '%$request%' OR Article.Text LIKE '%$request%') ";


    if($querysubtext!=''){
        $querytext=$querytext."AND (".$querysubtext.")";
    }

    $searchres=mysqli_query($connect,$querytext);
    $count=mysqli_num_rows($searchres);
    echo "<h2>За запитом: ".$request." Знайдено записів: ".$count."</h2>";
while ( $ar = mysqli_fetch_assoc($searchres)){
    ?>
    <div class="art-p">
    <?php if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>

        <div class="editblock">
            <a href ='/delete_art.php?id=<?php echo $ar['id'] ?>'><img src="/utility/delete.png"> </a> <br>
            <a href ='/updateform.php?id=<?php echo $ar['id'] ?>'><img src="/utility/edit.png"> </a> <br>
        </div> <?php } ?>



        <br>
        <div class="art-p-img"> <h1>   <a href ='/article.php?id=<?php echo $ar['id'] ?>'> <img src="/images/<?php echo $ar["Image"] ?>" alt=""> </a> </h1> </div> <br>

        <div class="art-p-content">

            <h1> <a href ='/article.php?id=<?php echo $ar['id'] ?>'><?php echo $ar['Name']; ?> </a> </h1>
            <?php $text=strip_tags($ar['Text']);
            echo "<p>".mb_substr($text,0,100,'utf-8')."</p>";?>
        </div>

    </div>
<?php }




    include "/includes/footer.php";