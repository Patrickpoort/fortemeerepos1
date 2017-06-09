<!--
    MIT License

    Copyright (c) 2016 Niels Helmantel

    see LICENSE file for more information
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap-3.3.7-dist/css/main.css" rel="stylesheet">

    </head>
    <body>

        <?php
        //database include
        include 'database.php';

        //cookies.
        include("include/cookies.php");

        //navigation bar.
        include("Navbar.php");
        ?>
        <div class="container">
            <div class="row">
                <h1>Gegevens Autoquest:</h1>
                <br>
         
                <p style="font-size: 150%">
                    Adres: Het Rister 8B
                </p>
                <p style="font-size: 150%">
                    Postcode: 8314 RD, Bant
                </p>
                <p style="font-size: 150%">
                    Telefoonnummer: 0527 261 178
                </p>
                <p style="font-size: 150%">
                    Emailadres: autoquestbant@gmail.com
                </p>

            </div>
        </div>
        <?php
        //footer
        include("footer.php");
        ?>
