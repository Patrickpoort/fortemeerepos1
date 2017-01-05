<!DOCTYPE html>
<html>

    
<body>
<?php
session_start();

// navbar include
include("HTML HEAD.php");

// database include
include 'database.php';
$pdo = connecttodb();

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
                echo "<img src='images/img-" . $productnummer . ".jpg'>"
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