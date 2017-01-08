
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

        <!--auto-onderdelen -->
        <div class="nav-items navbar-left navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="aanbodpagina.php">Auto-onderdelen</a></li>
            </ul>
        </div>

        <!--aanmelden registreren-->
        <div class="nav-items navbar-right navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                // Geeft weer als iemand ingelogd is en anders de optie om te registreren.
                if (isset($_SESSION['emailadres'])) {
                    print "<li><a href='profilepage.php'>" . $_SESSION['emailadres'] . "</a></li>";
                    print "<li><a href='logout.php'><span>Logout</span></a></li>";
                } else {
                    print"<li><a href='login.php'><span>Login</span></a></li>";
                    print"<li><a href='registreren.php'><span>Registeren</span></a></li>";
                }
                ?>  
                <li><a href="#">Winkelmandje</a> </li>
            </ul>
        </div>

        <!--zoekbar-->
        <form class="navbar-form navbar-right navbar-collapse collapse" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Zoek">
            </div>
        </form>



    </div>
</nav>

