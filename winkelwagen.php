<?php
session_start();
include("HTML HEAD.php");
//Database.
require_once ("database.php");
?>

<!DOCTYPE html>
<body>

<?php
$subtotaal = 0;
$totaal = 0;
if (isset($_POST["leeg"])) {
    unset($_SESSION["winkelwagen"]);
}
if (isset($_POST['productnummer'])) {
    $productnummer = $_POST['productnummer'];
}
if (isset($_POST['aantal'])) {
    $aantal = $_POST['aantal'];
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

<!--            if logged in-->
            <?php>
            $login = $_SESSION['emailadres'];
            if ($login) {
                <form class="bestelknop" action="bestellen.php">
                    <button>Bestellen</button>
                </form>
            } else {
                echo 'Login of maak een account aan voordat u kunt bestellen';
            }
            
        </div>
    </div>
</div>
</body>
</html>