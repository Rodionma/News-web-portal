<?php
include "/includes/config.php";
$page_name="Розділи";
include "/includes/database.php";
include "/includes/headerf.php";
$categ= mysqli_query($connect, "SELECT * FROM Category");
?>

<?
$i=0;
?>



<div class="сat-full" >
    <h2 style=" position: relative;
    font-size: 40px;
    padding-left: 5%;
    padding-top: 1%;">Категорії</h2>

        <?
        $j=mysqli_num_rows($categ);
        $k=0;
        while($k<$j){
            ?> <div class="cat-full-parent"> <?
            $i=0;
        while($i<3) {
            $catin=mysqli_fetch_assoc($categ)
            ?>

            <div class="cat-full-child">

                <div class="cat-full-child-img"> <h1>   <a href ='/cat_search.php?id=<?php echo $catin['id'] ?>'> <img src="/categories/<?php echo $catin["Image"] ?>" alt=""> </a> </h1> </div>

                 <div class="cat-full-child-content">

                    <h1> <a href ='/cat_search.php?id=<?php echo $catin['id'] ?>'><?php echo $catin['Category']; ?> </a> </h1>

                    </div>

            </div>

            <?
     $i+=1;   }
     ?>
            </div>
       <? $k+=3;} ?>

</div>