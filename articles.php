<?php
include "/includes/config.php";
include "/includes/database.php";

$page_name="Всі статті";

include "/includes/headerf.php";

$res = mysqli_query($connect, "SELECT * FROM Article");

$amount=mysqli_num_rows($res);
?>

    <script type="text/javascript">


        function load(counter) {
            $.ajax({
                type: "POST",
                url: "/articlesloader.php",
                data: {"counter" :counter} ,
                success: function (res) {

                    $('.content').html(res);

                }
            });

        }

    </script>

<div class="content">

</div>



<script type="text/javascript">

    $(document).ready(function(){
       load(1);
    });



</script>
<div class="pages-parrent">
<div class="pages">
<?
$amount=(int)($amount / 10);
$amount+=1;
$i=1;
while ($i<=$amount){
    echo "<div class='page' id='".$i."'>".$i.'</div>';

    $i++;
} ?>
</div>

</div>

<script>
    $('.page').on('click', function(e) {

        var id_click =   e.target.id;
        load(id_click);
    });

</script>
<?php include "/includes/footer.php"; ?>