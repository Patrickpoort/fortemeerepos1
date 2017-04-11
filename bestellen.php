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

<div class="container">
    <table class="col-md-6 producten table">
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Aantal</th>
        </tr>
        <?php
// Items uit de winkelwagen weergeven aan de klant
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
            <td>Totaal</td>
            <?php
// Totaalbedrag van de bestelling
            echo "<td>" . $totaal . " Euro" . "</td>";
            ?>
        </tr>
    </table>
</div>

<div class="container">
    <form action="winkelwagen.php">
        <input name="winkelwagenknop" value="Terug naar winkelwagen" type="submit">
    </form>
    
    <br>

    <form method="POST" action="bestelt.php">
        <input type="submit" name="afrondknop" value="bestelling definitief afronden"></input>
    </form>
</div>

<?php include "footer.php"; ?>
<?php
// functie voor het toevoegen van een bestelregel aan de database


    ?>

    
}


