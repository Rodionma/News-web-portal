<?php
    include "/includes/config.php";
    $page_name="Головна";
    include "/includes/database.php";
    include "/includes/headerf.php";

    $res = mysqli_query($connect, "SELECT * FROM Article");
    $ress = mysqli_query($connect, "SELECT * FROM Article ORDER BY Views ASC ");
$last = mysqli_query($connect, "SELECT * FROM Article ORDER BY Date DESC LIMIT 0,3");
$pop  = mysqli_query($connect, "SELECT * FROM Article ORDER BY Likes DESC LIMIT 0,3");
$categ= mysqli_query($connect, "SELECT * FROM Category LIMIT 0,3");
    ?>


<div class="slider-parrent">
<div class="slider-container">

    <button id="prev" class="slider-button" > < </button>
    <div id="1" class="art-curry" data-number="1">
            <? $slider=mysqli_fetch_assoc($ress);?>
            <a href ='/article.php?id=<?php echo $slider['id'] ?>'>
            <img src="/images/<?php echo $slider["Image"] ?>" width="800" height="500"> </a> <div class="art-curry-content"><?
            echo  "<h1>".$slider['Name']."</h1>";
            echo "<p>".mb_substr(strip_tags($slider['Text']),0,350,'utf-8')."...</p>";
            ?></div>  </div>
    <div id="2"  class="art" data-number="2">  <? $slider=mysqli_fetch_assoc($ress);?>
            <a href ='/article.php?id=<?php echo $slider['id'] ?>'>
                <img src="/images/<?php echo $slider["Image"] ?>" width="800" height="500"><div class="art-curry-content"> </a> <?
            echo  "<h1>".$slider['Name']."</h1>";
            echo "<p>".mb_substr(strip_tags($slider['Text']),0,350,'utf-8')."...</p>";
            ?></div> </div>
    <div id="3"  class="art" data-number="3">  <? $slider=mysqli_fetch_assoc($ress); ?>
            <a href ='/article.php?id=<?php echo $slider['id'] ?>'>
                <img src="/images/<?php echo $slider["Image"] ?>" width="800" height="500"><div class="art-curry-content"> </a> <?
            echo  "<h1>".$slider['Name']."</h1>";
            echo "<p>".mb_substr(strip_tags($slider['Text']),0,350,'utf-8')."...</p>";
            ?></div> </div>
        <p id="resart"></p>
    <button id="next" class="slider-button"> > </button>

</div>
</div>




<script type="text/javascript">
    var counter=1;



    $( document ).ready(function() {

        $("#next").click(function () {

            if(counter<3){
           current=$('body').find("#" + counter);
          // current.css("display", "none");
                current.animate({width:'hide'},200);
                setTimeout(function () {
                    current.removeClass();
                    current.toggleClass('art');
                },200);




            counter++;

         resrt = $('body').find('#' + counter);
                resrt.animate({width:'show'},200);
                setTimeout(function () {
                    resrt.removeClass();
                    resrt.toggleClass('art-curry');
                },200);

        // resrt.css("display", "block");
            };
        });



        $("#prev").click(function () {

            if(counter>1){
                current=$('body').find("#" + counter);
                // current.css("display", "none");
                current.animate({width:'hide'},200);
                setTimeout(function () {
                    current.removeClass();
                    current.toggleClass('art');
                },201);


                counter--;

                resrt = $('body').find('#' + counter);
                resrt.animate({width:'show'},200);
                setTimeout(function () {
                    resrt.removeClass();
                    resrt.toggleClass('art-curry');
                },201);
                // resrt.css("display", "block");
            };
        });




    });
</script>

<?php if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>
    <p> <a href="addform.php">Додати</a></p>


 <?php } ?>


<? echo "<h1 class='art-n'>Нове на порталі кущ</h1>";

while ( $arl = mysqli_fetch_assoc($last)){
    ?>
    <div class="art-p">

    <?php if($_SESSION['role_id']==1||$_SESSION['role_id']==2){?>
        <div class="editblock">
        <a href ='/delete_art.php?id=<?php echo $arl['id'] ?>'><img src="/utility/delete.png"> </a> <br>
        <a href ='/updateform.php?id=<?php echo $arl['id'] ?>'><img src="/utility/edit.png"> </a> <br>
        </div>
            <?php } ?>




        <br>
        <div class="art-p-img"> <h1>   <a href ='/article.php?id=<?php echo $arl['id'] ?>'> <img src="/images/<?php echo $arl["Image"] ?>" alt=""> </a> </h1> </div> <br>

        <div class="art-p-content">

            <h1> <a href ='/article.php?id=<?php echo $arl['id'] ?>'><?php echo $arl['Name']; ?> </a> </h1>
            <?php $text=strip_tags($arl['Text']);
            echo "<p>".mb_substr($text,0,100,'utf-8')."</p>";?>
        </div>

    </div>

<?php } ?>
<div>
<h2>Рекомендації</h2>


</div>

<div class="art-pop">
    <h2>Популярні</h2>
    <div class="art-pop-parent">
<?while($arp=mysqli_fetch_assoc($pop)){ ?>
    <div class="art-pop-child">


        <br>
        <div class="art-pop-child-img"> <h1>   <a href ='/article.php?id=<?php echo $arp['id'] ?>'> <img src="/images/<?php echo $arp["Image"] ?>" alt=""> </a> </h1> </div> <br>

        <div class="art-pop-child-content">

            <h1> <a href ='/article.php?id=<?php echo $arp['id'] ?>'><?php echo $arp['Name']; ?> </a> </h1>
            <?php $text=strip_tags($arp['Text']);
            echo "<p>".mb_substr($text,0,100,'utf-8')."</p>";?>
        </div>

    </div>

<?
}

?>
    </div>
    <a href="/articles.php" class="block-footer"><p>Всі статті</p></a>
</div>






<div class="сat-in" style="background-color: #FFC059;color: #262626; margin-top: -35px;">
    <h2 style=" position: relative;
    font-size: 40px;
    padding-left: 5%;
    padding-top: 1%;">Категорії</h2>
    <div class="cat-in-parent">
        <? while($catin=mysqli_fetch_assoc($categ)) {

            ?>
            <div class="cat-in-child">

                <div class="cat-in-child-img"> <h1>   <a href ='/cat_search.php?id=<?php echo $catin['id'] ?>'> <img src="/categories/<?php echo $catin["Image"] ?>" alt=""> </a> </h1> </div>

                <div class="cat-in-child-content">

                    <h1> <a href ='/cat_search.php?id=<?php echo $catin['id'] ?>'><?php echo $catin['Category']; ?> </a> </h1>

                </div>

            </div>

            <?
        }
        ?>
    </div>
    <a href="/categories.php" class="block-footer" style="color: #262626"><p>Всі категорії</p></a>
</div>





<?
include "/includes/footer.php";
//--------------------------------------------------------------------
?>



