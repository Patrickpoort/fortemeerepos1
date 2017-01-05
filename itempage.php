<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>cpanel - klanten</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Custom styles for this template -->
    <!--    <link href="css/main.css" rel="stylesheet">-->
</head>
<body>
<?php
session_start();

// navbar include
include("include/navigation.php");

// database include
include 'include/database.php';

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
            while ($row = $stmt->fetch()) {
                $naam = $row["naam"];
                $omschrijving = $row["omschrijving"];

                echo "<tr><td>productnummer:</td><td>" . $productnummer . "</td></tr>";
                $bouwjaar = $row["bouwjaar"];
                echo "<tr><td>bouwjaar:</td><td>" . $bouwjaar . "</td></tr>";
                $merk = $row["merk"];
                echo "<tr><td>merk:</td><td>" . $merk . "</td></tr>";
                $gewicht = $row["gewicht"];
                echo "<tr><td>gewicht:</td><td>" . $gewicht . "</td></tr>";
                $type = $row["type"];
                echo "<tr><td>type:</td><td>" . $type . "</td></tr>";
                $prijs = $row["prijs"];

            }

            ?>
        </table>

        <div class="col-md-5 boxmidden">
            <div class="item-image">
                <?php
                echo "<img src=\"img-" . $productnummer . ".png\">"
                ?>
            </div>

        </div>
        <div class="col-md-4 boxrechts">
            <?php
            echo "<h1>" . $naam . "</h1>";
            echo "<p>omschrijving: " . $omschrijving . "</p>";
            echo "<h3>" . $prijs . " euro</h3>";
            ?>
            <form method="GET" action="winkelwagen.php">
                <input type="hidden" name="productnummer" value="<?php print $productnummer ?>">
                <input type="text" name="aantal" value="aantal"><br>
                <input type="submit" value="Toevoegen aan winkelwagen">
                <?php  ?>
            </form>
        </div>
    </div>
</div>

</body>
</html>