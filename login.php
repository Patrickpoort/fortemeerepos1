<?php include "HTML HEAD.php";


        //database connectie.
        include 'database.php';
        $pdo = connecttodb();

        //cookies.
        include("cookies.php");

        checkLogin();

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
        include("Footer.php");



        if (!isset($_POST['submit'])) {
            print $form;
        }

        //functie welke rol krijgt welke gebruiker.
        function getRol() { //geef rol 1 aan klanten.
            global $pdo;
            $rol = 0; // Geef waarde 0 voor gast.
            if (isset($_SESSION['logged_in']) AND isset($_SESSION['emailadres']) AND $_SESSION['logged_in'] == true AND ! empty($_SESSION['emailadres'])) {
                $query = $pdo->prepare("SELECT * FROM emailadres WHERE emailadres = :email");
                $query->execute(array(':email' => $_SESSION['emailadres']));
                $gebruiker = $query->fetch(PDO::FETCH_OBJ);

                //Geef waarde 1 aan klant.
                if ($gebruiker->rol == 1) {
                    $rol = 1;
                }
                //Geef waarde 2 aan medewerker.
                elseif ($gebruiker->rol == 2) {
                    $rol = 2;
                }
                //Geef waarde 3 aan admin.
                elseif ($gebruiker->rol == 3) {
                    $rol = 3;
                }
            }
            return $rol;
        }

// Redirect gebruikers naar index pagina.
        function userExit() {
            if (getRol() <= 1) {
                header('Location: /');
                exit;
            }
        }

// Redirect gast naar login page.
        function guestExit() {
            if (getRol() == 0) {
                header('Location: registreren.php');
                exit;
            }
        }

// Redirect iedereen behalve medewerker.
        function medewerkerOnly($rol) {
            if (getRol() < 2) {
                header('Location: /');
                exit;
            }
        }

// Redirect iedereen behalve admin.
        function adminOnly($rol) {
            if (getRol() < 3) {
                header('Location: /adminpanel/overview.php');
                exit;
            }
        }

        function checkLogin() {
            global $pdo;
            // checked submit knop, en of waardes zijn ingevuld. Anders melding gebruikersnaam of wachtwoord is incorrect.
            if (isset($_POST['submit'])) {
                $user = $_POST['emailadres'];
                $pass = $_POST['pass'];
                // checked database op ingevoerde waardes.
                $sql2 = "SELECT emailadres FROM account WHERE wachtwoord='" . $pass . "' AND emailadres='" . $user . "'";

                if ($res = $pdo->query($sql2)) {
                    if ($res->rowCount() > 0) {

                        $_SESSION['emailadres'] = $user;

                    } else {
                        print "Gebruikersnaam of wachtwoord is incorrect! <br>";
                        print "<a href='login.php' class=\"btn btn-lg btn-primary btn-fixed\" id=\"RegisButton\" role=\"button\">Terug naar Login</a></container>";
                    }
                }
            }
        }
        ?>


