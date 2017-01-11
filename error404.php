<!-- 
    MIT License

    Copyright (c) 2016 Cor van Dokkum

    see LICENSE file for more information
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Inloggen</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap-3.3.7-dist/css/main.css" rel="stylesheet">
    </head>
    <body>
        <?php
        //database connectie.
        include("database.php");

        //cookies.
        include("include/cookies.php");

        //navigation bar.
        include("Navbar.php");
        ?>
        <div class="errormessage">
            <h2>404 ERROR</h2>
            <h3>Sorry, deze pagina is niet beschikbaar!</h3>
        </div>
        <?php
        //footer
        include("footer.php");
        ?>


