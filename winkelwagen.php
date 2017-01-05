<?php
session_start();

include("HTML HEAD.php");
include "database.php";
$pdo = connecttodb();

?>

<!DOCTYPE html>
<body>

<?php

$subtotaal = 0;
$totaal = 0;

if (isset($_GET["leeg"])) {
    session_destroy();
}

if (isset($_GET['productnummer'])) {
    $productnummer = $_GET['productnummer'];
}

if (isset($_GET['aantal'])) {
    $aantal = $_GET['aantal'];
}

if (isset($productnummer)) {
    $stmt = $pdo->prepare("SELECT prijs FROM product WHERE productnummer = ?");
    $stmt->execute(array($productnummer));
    while ($row = $stmt->fetch()) {
        $prijs = $row['prijs'];
    }
    $winkelwagen = array(
        'productnummer' => $productnummer,
        'prijs' => $prijs,
        'aantal' => $aantal
    );
    $_SESSION['winkelwagen'][] = $winkelwagen;
}

//$bestelnummer =+ 1;
//$emailadres = "testklant@gmail.com";
//$productnummer = $_GET['productnummer'];
//$aantal = $_GET['aantal'];
//$datum = date("Y-m-d H:i:s");
//$betaald = 0;
//

//$stmt = $pdo->prepare("INSERT INTO bestelregel (bestelnummer, emailadres, productnummer,
//aantal, datum, betaald) VALUES (:bestelnummer, :email, :pnummer, :aantal, :datum, :betaald)");
//
//$stmt->execute(array(
//    "bestelnummer" => $bestelnummer,
//    "email" => $emailadres,
//    "pnummer" => $productnummer,
//    "aantal" => $aantal,
//    "datum" => $datum,
//    "betaald" => $betaald,
//));

?>

<div class="container">
    <div class="row">
        <a href="winkelwagen.php?leeg=true">Leeg winkelwagen</a>
        <table class="col-md-6 producten table">
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Aantal</th>
            </tr>
            <?php
            if (isset($_SESSION['winkelwagen'])) {
                foreach ($_SESSION['winkelwagen'] as $item) {
                    $subtotaal = $item['prijs'] * $item['aantal'];
                    $totaal += $subtotaal;
                    echo "<tr>";
                    echo "<td>" . $item['productnummer'] . "</td>";
                    echo "<td>" . $item['prijs'] . "</td>";
                    echo "<td>" . $item['aantal'] . "</td>";
                    echo "</tr>";
                }
            }

            ?>


        </table>
        <div class="col-md-4 overzichtdiv">
            <table class="overzicht table">
                <tr>
                    <th>Betaal Overzicht</th>
                </tr>
                <tr>
                    <td>Totaal</td>
                    <?php
                    echo "<td>" . $totaal . " euro" ."</td>";
                    ?>
                </tr>
            </table>
            <form class="bestelknop">
                <button>Bestellen</button>
            </form>
        </div>


    </div>
</div>
</body>
</html>