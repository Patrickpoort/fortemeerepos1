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

        //Resultaten weergeven
        $query = "SELECT * FROM product";
        $temp_array = [];
        if (isset($_GET['submit'])) {
            //zoekbalk
            if ($_GET['zoek'] != '') {
                // Vergelijkt ingevulde data met data uit de database. Zowel in de naam als in de omschrijving.
                $query = "SELECT * FROM product WHERE naam LIKE ? OR omschrijving LIKE ?";
                $temp_array[0] = "%" . $_GET['zoek'] . "%";
                $temp_array[1] = "%" . $_GET['zoek'] . "%";
            }
            // Vergelijkt de verschillende combinaties van merk, bouwjaar en categorie met de data uit de database en genereerd een query.
            elseif ($_GET['merk'] != '-') {
                $temp_array[0] = trim($_GET['merk']);
                $query = "SELECT * FROM product WHERE merk = ?";
            } elseif ($_GET['bouwjaar'] != '-') {
                $temp_array[0] = $_GET['bouwjaar'];
                $query = "SELECT * FROM product WHERE bouwjaar = ?";
            } elseif ($_GET['onderdeel'] != '-') {
                $temp_array[0] = trim($_GET['onderdeel']);
                $query = "SELECT * FROM product WHERE categorienaam = ?";
            } elseif ($_GET['merk'] != '-' && $_GET['bouwjaar'] != '-') {
                $temp_array[0] = trim($_GET['merk']);
                $temp_array[1] = $_GET['bouwjaar'];
                $query = "SELECT * FROM product WHERE merk = ? AND bouwjaar = ?";
            } elseif ($_GET['merk'] != '-' && $_GET['onderdeel'] != '-') {
                $temp_array[0] = trim($_GET['merk']);
                $temp_array[1] = trim($_GET['onderdeel']);
                $query = "SELECT * FROM product WHERE merk = ? AND categorienaam = ?";
            } elseif ($_GET['bouwjaar'] != '-' && $_GET['onderdeel'] != '-') {
                $temp_array[0] = $_GET['bouwjaar'];
                $temp_array[1] = trim($_GET['onderdeel']);
                $query = "SELECT * FROM product WHERE bouwjaar = ? AND categorienaam = ?";
            }
        }
        // query wordt hier uitgevoerd
        $stmt = $pdo->prepare($query);
        $stmt->execute($temp_array);
        ?>

        <div class="aanbod-wrapper" class="cod-md-3">
            <div class="aanbod-sidebar-wrapper">
                <ul class="aanbod-sidebar-nav">
                    <li class="aanbod-filter-title"><h4>Filter uw resultaten</h4></li>
                    <li>
                        <form method="get" action="aanbodpagina.php" class="aanbod-form-search"> Zoek:<br>
                            <input type="text" class="form-control" name="zoek" value="<?php
        if (isset($_GET['zoek'])) {
            print htmlentities($_GET['zoek']); // <= zorgt ervoor dat de zoekbalk alleen tekst leest. Er kan bijv. geen extra from aangemaakt worden.
        }
        ?>">

                            <Br>
                            </li>
                            <li class="aanbod-dropdown-merk"> Automerk:<Br>
                                <select name="merk" id="merk">
<?php
//dropdownlijstje merk. Vult het lijst je met data uit de kolom 'merk' in de database.
$stmt1 = $pdo->prepare("SELECT distinct merk FROM product");
$stmt1->execute();

print "<option>" . "-" . "</option>";
while ($row = $stmt1->fetch()) {
    $merk = $row["merk"];
    print "<option value= ' " . $row['merk'] . " '>" . $row['merk'] . "</option>";
}
?>
                                    <!-- Zorgt ervoor dat de ingevoerde waardes zichtbaar blijven nadat er op zoeken is gedrukt-->
                                    <script type="text/javascript">
                                        document.getElementById('merk').value = "<?php print $_GET['merk']; ?>";
                                    </script> 
                                </select></li> <br>
                            <li class="aanbod-dropdown-bouwjaar"> Bouwjaar:<Br>
                                <select name="bouwjaar" id="bouwjaar">
<?php
//dropdownlijstje bouwjaar. Vult het lijst je met data uit de kolom 'bouwjaar' in de database.
$stmt2 = $pdo->prepare("SELECT distinct bouwjaar FROM product");
$stmt2->execute();

print "<option>" . "-" . "</option>";
while ($row = $stmt2->fetch()) {
    $bouwjaar = $row["bouwjaar"];
    print "<option value= ' " . $row['bouwjaar'] . " '>" . $row['bouwjaar'] . "</option>";
}
?>
                                    <!-- Zorgt ervoor dat de ingevoerde waardes zichtbaar blijven nadat er op zoeken is gedrukt-->
                                    <script type="text/javascript">
                                        document.getElementById('bouwjaar').value = "<?php print $_GET['bouwjaar']; ?>";
                                    </script>
                                </select></li> <br>
                            <li class="aanbod-dropdown-onderdeel"> Type onderdeel:<Br>
                                <select name="onderdeel" id="onderdeel">
<?php
//dropdownlijstje type onderdeel. Vult het lijst je met data uit de kolom 'categorienaam' in de database.
$stmt3 = $pdo->prepare("SELECT distinct categorienaam FROM product");
$stmt3->execute();

print "<option>" . "-" . "</option>";
while ($row = $stmt3->fetch()) {
    $merk = $row["categorienaam"];
    print "<option value= ' " . $row['categorienaam'] . " '>" . $row['categorienaam'] . "</option>";
}
?>
                                    <!-- Zorgt ervoor dat de ingevoerde waardes zichtbaar blijven nadat er op zoeken is gedrukt-->
                                    <script type="text/javascript">
                                        document.getElementById('onderdeel').value = "<?php print $_GET['onderdeel']; ?>";
                                    </script>
                                </select></li> <br>
                            <li> 
                                <input class="aanbod-search-button" type="submit" name='submit' value="Zoeken">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- Tabel HTML -->
            <div class="container">
                <table class="col-md-9">
                    <tr>
                        <th class="col-md-2">Foto</th>
                        <th class="col-md-7">Productnaam</th>
                        <th class="col-md-2">Prijs</th>
                    </tr>
<?php
// Haalt productnummer, naam en prijs op uit de database
while ($row = $stmt->fetch()) {
    $productnummer = $row["productnummer"];
    $naam = $row["naam"];
    $prijs = $row["prijs"];

    // Plaats de opgehaalde data in een tabel
    echo "<tr class=\"aanbod-table-data\">";
    ?>
                        <div class="container">
                        <?php
                        echo "<td class='col-md-2 aanbod-image'><img src='images\img-" . $productnummer . ".jpg'></td>";
                        ?>
                        </div>
                            <?php
                            echo "<td class=\"col-md-7\"><a href=itempage.php?rowid=$productnummer>" . $naam . "</a></td>";
                            echo "<td class=\"aanbod-prijs\">" . $prijs . " EURO" . "</td>";
                            echo "</tr>";
                        }
                        ?>
                </table>
            </div>
        </div>

<?php
//footer
include("footer.php");
?>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="css/https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="css/js/bootstrap.min.js"></script>
    </body>
</html>