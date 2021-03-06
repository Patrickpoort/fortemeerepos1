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
session_start();

// navbar include
include "Navbar.php";

// database include

include 'database.php';


if (!isset($_GET['rowid'])) {
    echo "<h1>Geen item geselecteerd!</h1>";
}
$productnummer = $_GET["rowid"];
$stmt = $pdo->prepare("SELECT * FROM product WHERE productnummer = ?");
$stmt ->execute(array($productnummer));

// het productnummer wordt hier opgeslagen als referentie in winkelwagen
$_SESSION['productnummer'] = $productnummer;
?>

<div class="container">
    <div class="row">
        <table class="col-md-3 boxlinks">

            <tr><td><h3>Kenmerken</h3></td></tr>
            <?php
            //Zelfgemaakte functie om data uit bepaalde rows van de database in een table te stoppen.
            function addtoTable($value) {
                
                global $row;
                echo "<tr><td>". $value . ":</td><td>" . $row[$value] . "</td></tr>";
               
            }
            
            while ($row = $stmt->fetch()) {
                if (isset($row['naam'])) {
                    $naam = $row["naam"];
                }

                if (isset($row['omschrijving'])) {
                    $omschrijving = $row["omschrijving"];
                }

                if (isset($productnummer)) {
                    echo "<tr><td>productnummer:</td><td>" . $productnummer . "</td></tr>";
                }

                if (isset($row['bouwjaar'])) {
                    addtoTable("bouwjaar");
                }

                if (isset($row['merk'])) {
                    addtoTable("merk");
                }

                if (isset($row['gewicht'])) {
                    addtoTable("gewicht");
                }

                if (isset($row['type'])) {
                    addtoTable("type");
                }
                
                if (isset($row['voorraad'])) {
                    $voorraad = $row["voorraad"];
                    echo "<tr><td>Aantal producten beschikbaar: </td><td>" . $voorraad . "</td></tr>";
                }
                $prijs = $row["prijs"];
            }

            ?>
        </table>

        <div class="col-md-5 boxmidden">
            <div class="item-image">
                <?php
                echo "<img src='images/img-" . $productnummer . ".jpg'>"
                ?>
            </div>

        </div>
        <div class="col-md-4 boxrechts">
            <?php
            $int = 4;
            echo "<h1>" . $naam . "</h1>";
            echo "<p>omschrijving: " . $omschrijving . "</p>";
            echo "<h3>" . $prijs . " euro</h3>";
            ?>
            <form method="POST" action="winkelwagen.php">
                <input type="hidden" name="productnummer" value="<?php print $productnummer ?>">
                <input type="number" name="aantal" min="1" max="<?php print $voorraad ?>" value="1"><br>
                <input type="submit" value="Toevoegen aan winkelwagen">
               
            </form>
        </div>
    </div>
</div>

</body>
</html>