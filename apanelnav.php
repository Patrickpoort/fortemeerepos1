<!--
    MIT License

    Copyright (c) 2016 Niels Helmantel

    see LICENSE file for more information
-->
<nav class="navbar navbar-inverse navbar-static-top topbar">
    <div class="container-fluid">
        <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            <!--logo placeholder-->
            <a class="navbar-brand" href="index.php">
              <!-- Tijdelijke Tekst -->
            <p style="color: white">Autoquest</p>
            </a>
        </div>

    <!--apanelnavbar-->
        <div class="nav-items navbar-left navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="rechten.php">Rechten</a> </li>
                <li><a href="klanten.php">Klanten</a> </li>
                <li><a href="producten.php">Producten</a> </li>
                <li><a href="CategorieAdd.php">Categorie toevoegen</a> </li>
                <li><a href="besteloverzicht.php">Bestellingen</a> </li>
                <li><a href="index.php">Homepagina</a> </li>
            </ul>
        </div>

        <!--Naam persoon ingelogd-->
        <div class="nav-items navbar-right navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <?php
                // Geeft weer als iemand ingelogd is en anders de optie om te registreren.
                if (isset($_SESSION['emailadres'])) {
                    print "<li><a href='profilepage.php'>" . $_SESSION['emailadres'] . "</a></li>";
                    print "<li><a href='logout.php'><span>Logout</span></a></li>";
                } else {
                    print"<li><a href='../login.php'><span>Login</span></a></li>";
                    print"<li><a href='#'><span>Registeren</span></a></li>";
                }
                ?>   
            </ul>
        </div>
    </div>
</nav>
        
