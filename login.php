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

        checkLogin();

        //navigation bar.
        include("Navbar.php");

        //login & registreer box.
        $form = "<div class='container'>"
            . "<div class='row myrow'>"
            . "<div class='col-md-6'>"
            . "<form class='form-signin' action='' method='POST'>"
            . "<h2 class='form-signin-heading'>Login</h2>"
            // Input email adres.
            . "<label for=\"Emailadres\" class=\"sr-only\">Emailadres</label>
                   <input type=\"email\" id=\"Emailadres\" name=\"emailadres\" class=\"form-control\" placeholder=\"emailadres\" required='required'> <br>"
            // Input wachtwoord.
            . "<label for=\"Wachtwoord\" class=\"sr-only\">Wachtwoord</label>
                   <input type=\"password\" id=\"wachtwoord\" name=\"pass\" class=\"form-control\" placeholder=\"wachtwoord\" required='required' autofocus> <br>"
            // login button.
            . "<button id=\"RegisButton\" class=\"btn btn-lg btn-primary btn-fixed\" type=\"submit\" name=\"submit\">Inloggen</button>"
            . "</form>"
            . "</div>"
            . "<div class='col-md-6'>"
            . "<form class='login-register' action='#'>"
            . "<h2>Nog geen account?</h2>"
            // registreer button.
            . "<a href='registreren.php' class=\"btn btn-lg btn-primary btn-fixed\" id=\"RegisButton\" role=\"button\">Registreren</a>"
            . "</form>"
            . "<form class='login-register' action='#'>"
            . "<h2>Wachtwoord vergeten?</h2>"
            // wachtwoord vergeten button.
            . "<a href='#' class=\"btn btn-lg btn-primary btn-fixed\" id=\"RegisButton\" role=\"button\">Wachtwoord Resetten</a>"
            . " </form>"
            . "</div>"
            . "</div>"
            . "</div>";
        //footer
        include("footer.php");



        if (!isset($_POST['submit'])) {
            print $form;
        }
        
       // if (isset($_SESSION['emailadres'])) {
        //    header("location:index.php");
        //}else {}

        function checkLogin() {
            global $pdo;
            // checked submit knop, en of waardes zijn ingevuld. Anders melding gebruikersnaam of wachtwoord is incorrect.
            if (isset($_POST['submit'])) {
                $user = $_POST['emailadres'];
                $pass = $_POST['pass'];
                // checked database op ingevoerde waardes.
                $sql2 = "SELECT emailadres, rechten FROM account WHERE wachtwoord='" . $pass . "' AND emailadres='" . $user . "'";

                if ($res = $pdo->query($sql2)) {
                    if ($res->rowCount() > 0) {
                        $result = $res->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['rechten'] = $result["rechten"];
                        $_SESSION['emailadres'] = $user;
                        print ($result["rechten"]);

                    } else {
                        print "Gebruikersnaam of wachtwoord is incorrect! <br>";
                        print "<a href='login.php' class=\"btn btn-lg btn-primary btn-fixed\" id=\"RegisButton\" role=\"button\">Terug naar Login</a></container>";
                    }
                }
            }
        }
        ?>


