<?php
    include "/includes/config.php";
    include "/includes/database.php";

    $id=$_GET['id'];
    $userid=$_SESSION["id"];
    mysqli_query($connect,"UPDATE Article SET Views = Views+1 WHERE (id=$id)");

    $res2 = mysqli_query($connect, "SELECT * FROM Article WHERE Article.id=$id");
    $rescom= mysqli_query($connect,"SELECT * FROM Comment WHERE Article_id=$id" );
    $resus=mysqli_query($connect,"SELECT * FROM User");

    if(isset($_SESSION['id'])){

        mysqli_query($connect,"INSERT INTO Recommendations(user_id,article_id)  VALUES('$userid','$id')");
    $reslike=mysqli_query($connect,"SELECT * FROM Likes WHERE Article_id=$id AND User_id=$userid");
    $datalike=mysqli_num_rows($reslike);}

$ar2 = mysqli_fetch_assoc($res2);
    $page_name=$ar2["Name"];

    include "/includes/headerf.php";


    ?>


   <br>
<div class="art-img">
    <img src="/images/<?php echo $ar2["Image"] ?>">
    <h1> <?php echo $ar2['Name']; ?> </h1>
</div>
<div class="formparrent">

    <div class="art-v">

  <div class="art-content"> <?php echo $ar2['Text']; ?> </div>

        <div class="side">

        <div class="sideblock1">
<img src="/utility/archive.png" height="20">
            <?php
            foreach ($cat as $art_c){
                if($art_c['id']==$ar2['Category_id']){
                    echo $art_c['Category'];
                }
            }

            ?>
            <img src="/utility/date.png" height="20">
            <?php //echo $ar2['Date'];
            $phpdate = strtotime( $ar2['Date'] );
            $mysqldate = date( 'd.m.Y', $phpdate );
            echo $mysqldate;
            ?>


        </div>

        <div class="sideblock2">
   <img src="utility/views.png" height="20"> <?php echo $ar2['Views']; ?>



    <div id="like"><img src='/utility/Like.png'> <p><?php echo $ar2['Likes']; ?></p> </div>



        </div>
        </div>
        <script type="text/javascript">
            $( document ).ready(function() {

                var likecount =<?=$ar2['Likes']; ?>;
                var isliked= <?=$datalike; ?>;
                var user=<?=$userid; ?>;
                var article=<?=$id; ?>;




                if (isliked==0){
                    $('#like').html("<p><img src='/utility/Like.png'>" + likecount + "</p>");
                }
                else{
                    $('#like').html("<p><img src='/utility/Like%20pressed.png'>" + likecount + "</p>");
                }


                $("#like").click(function (event) {
                    event.preventDefault();

                    if(user!=0) {
                        if (isliked == 0) {


                            $.ajax({
                                type: "POST",
                                url: "/like.php",
                                data: {"isliked": isliked, "user": user, "article": article},
                                success: function (result) {

                                    likecount += 1;
                                    $('#like').html("<p><img src='/utility/Like%20pressed.png'>" + likecount + "</p>");
                                    isliked = 1;
                                }
                            });
                        } else {


                            $.ajax({
                                type: "POST",
                                url: "/like.php",
                                data: {"isliked": isliked, "user": user, "article": article},
                                success: function (result) {
                                    likecount -= 1;
                                    $('#like').html("<p><img src='/utility/Like.png'>" + likecount + "</p>");
                                    isliked = 0;
                                }
                            });


                        }
                    }
                });
            });


        </script>



<hr class="art-divide">

<h2> Комментарі</h2>
<?php

while($users=mysqli_fetch_assoc($resus)){
    if ($users['id'] == $_SESSION['id']) {
        $avatartmp = "/avatars/" . $users['Avatar'];

    }
    }


    while( $comments = mysqli_fetch_assoc($rescom)) {
        foreach ($resus as $us) {
            if ($us['id'] == $comments['User_id']) {

                $idtemp = $comments['User_id'];
                $imgtemp = "/avatars/" . $us['Avatar'];
                echo "<div class='commentuser'>";
                echo "<a href='/userdata.php?id=$idtemp'>" . "<img width='50' height='50' src='$imgtemp'>" . "</a>";
                echo "<p><a href='/userdata.php?id=$idtemp'>" . $us['Nickname'] . "</a></p></div>";

            }

        }

        echo "<div class='commentcontent'><p>" . $comments["Text"] . "</p></div>";
    }



?>
<?php if (isset($_SESSION['id'])) { ?>
<p id="newcomment"></p>
<div class="commentform">
<form name="comment" id="comment" method="post" accept-charset="UTF-8"  ">
    <h1>Текст комментаря</h1>
<textarea  name="textcom"></textarea>
<input type="hidden" name="articleid" value="<?php echo $id; ?>">
<input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
    <input type="submit" value="Комментувати">
</form>
</div>

<?php
}
else echo "Зареєструйтесь або авторизуйтесь,щоб лишати комментарі \n"

?>

</div>
</div>

<script type="text/javascript">
    $("#comment").submit(function(event){
        var sign=$(this).find('input, select, textarea, button').serialize();

        event.preventDefault();
        var text= "<div class='commentcontent' >"+$("#textcom").val()+"</div>";

        $.ajax({
            type: "POST",
            url: "/comment.php",
            data: sign,
            success: function (res) {
                 if(res==1){


                     var user= "<div class='commentuser'></a></p><a href='/userdata.php?id=<?php echo $_SESSION['id'] ?>'> <img width='50' height='50' src='<?=$avatartmp ?>'></a><p><a href='/userdata.php?id=<?php echo $_SESSION['id'] ?>'><?=$_SESSION['username'];  ?></div>";
                     $("#newcomment").append(user);
                     $("#newcomment").append(text);
                 }
                 else if (res==2){
                     alert("Ошибка");
                 }


            }
        });

            $("#comment").trigger('reset');

         return false;
        });
    </script>
    <?php
    include "/includes/footer.php";
    ?>


