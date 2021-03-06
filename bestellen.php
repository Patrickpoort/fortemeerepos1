<!--
    MIT License

    Copyright (c) 2016 Edwin van Dasselaar

    see LICENSE file for more information
-->
<?php
/**
 * Created by PhpStorm.
 * User: Niels Helmantel
 * Date: 6-1-2017
 * Time: 00:17
 */
session_start();

include("HTML HEAD.php");
include "database.php";
?>
<div class="container">
    <h1>Bestelling afronden.</h1>
    <p>
        Geachte klant, om een bestelling af te ronden klikt u op de knop "bestelling definitief afronden".
        <br>
        Vervolgens kunt u een afspraak maken om de onderdelen op te komen halen bij Autoquest.
        <br>

    <p>

</div>

<!-- aanmaken table header besteloverzicht-->
<div class="container">
    <table class="col-md-6 producten table">
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Aantal</th>
        </tr>
<?php
// Producten ophalen uit session en weergeven in table data
$subtotaal = 0;
$totaal = 0;
if (isset($_SESSION['winkelwagen'])) {
    foreach ($_SESSION['winkelwagen'] as $item) {
        $subtotaal = $item['prijs'] * $item['aantal'];
        $totaal += $subtotaal;
        echo "<tr>";
        echo "<td>" . $item['productnummer'] . "</td>";
        echo "<td>" . "€" . $item['prijs'] . "</td>";
        echo "<td>" . $item['aantal'] . "</td>";
        echo "</tr>";
    }
}

?>
        </tr>
        <tr>
<!--            totaal = aantal * prijs-->
            <td>Totaal</td>
        <?php
// Totaalbedrag van de bestelling
        echo "<td>" . $totaal . " Euro" . "</td>";
        ?>
        </tr>
    </table>
</div>
<!--terug naar winkelwagen knop-->
<div class="container">
    <form action="winkelwagen.php">
        <input name="winkelwagenknop" value="Terug naar winkelwagen" type="submit">
    </form>


    <br>
<!--invoeren bestelling knop-->
    <form method="POST">
        <input type="submit" name="afrondknop" value="bestelling definitief afronden"></input>
    </form>
</div>


<?php

$emailadres = $_SESSION['emailadres'];
$datum = date("Y-m-d H:i:s");
// laatste bestelnummer uit de database halen (voor toevoegen bestelregel aan database)
$query4 = "SELECT MAX(bestelnummer) AS maxbestel FROM bestelregel";
$stmt = $pdo->prepare($query4);
$stmt->execute();

while ($row = $stmt->fetch()) {
    $bestelnummer = $row['maxbestel'];
}


$bestel_array = [];

// laatste bestelnummer ophogen met +1
$bestelnummer+=1;


if (isset($_POST['afrondknop'])) {
    // doorlopen van alle producten in winkelwagen om toe te voegen aan de database
    foreach ($_SESSION['winkelwagen'] as $bestelling) {
    // bestelregel invoeren in database   
    $query3 = "INSERT INTO bestelregel (bestelnummer, emailadres, productnummer, aantal, datum) VALUES (?, ?, ?, ?, ?)";  
    
    $bestel_array[0] = $bestelnummer;
    $bestel_array[1] = $emailadres;
    $bestel_array[2] = $bestelling['productnummer'];
    $bestel_array[3] = $bestelling['aantal'];
    $bestel_array[4] = $datum;
    
    // per bestelling het bestelnummer ophogen met 1
    $bestelnummer++;
    
    $stmt = $pdo->prepare($query3);
    $stmt->execute($bestel_array);
    
    // voorraad aanpassen na plaatsen bestelling
    $query5 = "SELECT voorraad FROM product WHERE productnummer = ?";
    $stmt = $pdo->prepare($query5);
    $stmt->execute(array($bestelling['productnummer']));
    while ($row = $stmt->fetch()) {
        $huidigeVoorraad = $row['voorraad'];
    }
    $nieuweVoorraad = $huidigeVoorraad - $bestelling['aantal'];
    
    $query6 = "UPDATE product SET voorraad = ? WHERE productnummer = ?";
    $stmt = $pdo->prepare($query6);
    $stmt->execute([$nieuweVoorraad, $bestelling['productnummer']]);
    
    // winkelwagen leegmaken na plaatsen bestelling
    unset($_SESSION['winkelwagen']);
    
    }
    print "Bedankt voor uw bestelling";
    ?>
    <script type="text/javascript">location.href = 'bestelt.php'; </script>
    <?php
}


?>

<?php include "footer.php"; ?>





