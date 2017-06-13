<!-- 
    MIT License

    Copyright (c) 2016 Cor van Dokkum

    see LICENSE file for more information
-->
<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Panel</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap-3.3.7-dist/css/main.css" rel="stylesheet">

    </head>
    <?php
    //database connectie
    include("database.php");

    //cookies
    include("include/cookies.php");

    //rechten check
    rechten();

    //adminpanel navbar
    include("apanelnav.php");

    // printen klantendata in tabel
    function printKlantenData($value) {
        print "<td>" . "<input type='text' name='emailadres' value='$value'</input>" . "</td>";
    }
    
    ?>
    <!--    aanmaken overzicht van de klanten table-->
    <body>
        <div class="klanten-container">
            <table class="table table-striped">
                <tr>
                    <th>Emailadres</th>
                    <th>bedrijfsnaam</th>
                    <th>Woonplaats</th>
                    <th>Straatnaam</th>
                    <th>Huisnummer</th>
                    <th>Postcode</th>
                    <th>Bedrijf woonplaats</th>
                    <th>Bedrijf straatnaam</th>
                    <th>Bedrijf huisnummer</th>
                    <th>Bedrijf postcode</th>
                    <th>Telefoonnummer</th>
                    <th>Actief</th>
                    <th>Opslaan</th>
                    <th>Delete</th>
                </tr>
<?php
$query = "select * from klant order by emailadres asc";

$stmt = $pdo->prepare($query);
$stmt->execute();
// ophalen klantgegevens uit database
while ($row = $stmt->fetch()) {
    $emailadres = $row["emailadres"];
    $bedrijfsnaam = $row["bedrijfsnaam"];
    $fwoonplaats = $row["f_woonplaats"];
    $fstraatnaam = $row["f_straatnaam"];
    $fhuisnummer = $row["f_huisnummer"];
    $fpostcode = $row["f_postcode"];
    $bwoonplaats = $row["b_woonplaats"];
    $bstraatnaam = $row["b_straatnaam"];
    $bhuisnummer = $row["b_huisnummer"];
    $bpostcode = $row["b_postcode"];
    $telefoonnummer = $row["telefoonnummer"];
    $actief = $row['actief'];

    // array aangemaakt om waarde te printen in de klanten tabel
    $dataArray = [$emailadres, $bedrijfsnaam, $fwoonplaats, $fstraatnaam, $fhuisnummer,$fpostcode,
        $bwoonplaats, $bstraatnaam, $bhuisnummer, $bpostcode, $telefoonnummer];

// klantgegevens in tabel laden
    print "<form method='POST'>";
    print "<tr>";
    
    // de array doorlopen en vanuit de functie printKlantenData wordt de print aangemaakt
    foreach ($dataArray as $value) {
        printKlantenData($value);
    }

    // klant is niet actief? rode box
    if ($actief == 0) {
        print "<td>" . "<input type='number' name='actief' value='$actief' max='1' min='0' STYLE='background-color: red'" . "</td>";
    }
    if ($actief == 1) {
        print "<td>" . "<input type='number' name='actief' value='$actief' max='1' min='0' STYLE='background-color: green'" . "</td>";
    }

    print "<td>" . "<input type='submit' class='btn btn-success' value='opslaan' name='opslaan'></input>" . "</td>";
    print "<td>" . "<input type='submit' class='btn btn-danger' value='delete' name='delete'></input>" . "</td>";
    print "</tr>";
    print "</table";
    print "</form>";
}

if (isset($_POST['opslaan'])) {
    // update emailadres, bedrijfsnaam, woonplaats, straatnaam, huisnummer, postcode, bwoonplaats, bstraatnaam, bhuisnummer, bpostcode, telefoonnummer.
    $stmt = $pdo->prepare("UPDATE klant set  emailadres = ?, bedrijfsnaam = ?, f_woonplaats = ?, f_straatnaam = ?, f_huisnummer = ?, f_postcode = ?, b_woonplaats = ?, b_straatnaam = ?, b_huisnummer = ?, b_postcode = ?, telefoonnummer = ?, actief = ? WHERE emailadres = ?");
    // vraag alle klanten waar de searchstring in voorkomt
    $stmt->execute([$_POST['emailadres'], $_POST['bedrijfsnaam'], $_POST['f_woonplaats'], $_POST['f_straatnaam'], $_POST['f_huisnummer'], $_POST['f_postcode'], $_POST['b_woonplaats'], $_POST['b_straatnaam'], $_POST['b_huisnummer'], $_POST['b_postcode'], $_POST['telefoonnummer'], $_POST['actief'], $_POST['emailadres']]);
}
// soft delete (klant wordt inactief wanneer op delete is gedrukt)
if (isset($_POST['delete'])) {
    // delete emailadres, bedrijfsnaam, woonplaats, straatnaam, huisnummer, postcode, bwoonplaats, bstraatnaam, bhuisnummer, bpostcode, telefoonnummer.
    $stmt = $pdo->prepare("UPDATE klant SET actief = 0 WHERE emailadres = ?");

    // vraag alle klanten waar de searchstring in voorkomt
    $stmt->execute([$_POST['emailadres']]);
}
//footer
include("footer.php");
?>
            </table>
        </div>
    </body>
</html>