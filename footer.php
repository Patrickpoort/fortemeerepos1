<?php
//database connectie.
include("database.php");

include ("include/cookies.php");




$email = $_SESSION['emailadres'];
$query = "SELECT * FROM account WHERE emailadres = :email";
$stmt = $pdo->prepare($query);
$stmt->execute(array('email'=>$email));

while ($row = $stmt->fetch()) {
    $rechten = $row ['rechten'];
    print_r ($row);
}







//if($_SESSION['rechten'] == 3) {
 //   print "<a href "


}






?>
<div class="navbar navbar-default navbar-fixed-bottom" id="footer">
    <div class="container">
        <p class="navbar-text"><a href="#">Contact</a></p>
        <p class="navbar-text">Autoquest copyright 2017, all rights reserved</p>
    </div>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

