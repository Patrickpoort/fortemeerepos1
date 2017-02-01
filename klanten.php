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
    include("cookies.php");

    if ($_SESSION['rechten'] < 2) {
        header("location:error404.php");
    } else {
        //adminpanel navbar
        include("apanelnav.php");
        ?>
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
                        <th>Opslaan</th>
                        <th>Delete</th>
                    </tr>
                <?php
                $query = "select * from klant order by emailadres asc";

                $stmt = $pdo->prepare($query);
                $stmt->execute();

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

                    print "<form method='POST'>";
                    print "<tr>";
                    print "<td>" . "<input type='text' name='emailadres' value='$emailadres'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='bedrijfsnaam' value='$bedrijfsnaam'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='f_woonplaats' value='$fwoonplaats'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='f_straatnaam' value='$fstraatnaam'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='f_huisnummer' value='$fhuisnummer'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='f_postcode' value='$fpostcode'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='b_woonplaats' value='$bwoonplaats'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='b_straatnaam' value='$bstraatnaam'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='b_huisnummer' value='$bhuisnummer'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='b_postcode' value='$bpostcode'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='telefoonnummer' value='$telefoonnummer'" . "</td>";
                    print "<td>" . "<input type='submit' class='btn btn-success' value='opslaan' name='opslaan'></input>" . "</td>";
                    print "<td>" . "<input type='submit' class='btn btn-danger' value='delete' name='delete'></input>" . "</td>";
                    print "</tr>";
                    print "</table";
                    print "</form>";
                }

                if (isset($_POST['opslaan'])) {
                    // update emailadres, bedrijfsnaam, woonplaats, straatnaam, huisnummer, postcode, bwoonplaats, bstraatnaam, bhuisnummer, bpostcode, telefoonnummer.
                    $stmt = $pdo->prepare("UPDATE klant set  emailadres = ?, bedrijfsnaam = ?, f_woonplaats = ?, f_straatnaam = ?, f_huisnummer = ?, f_postcode = ?, b_woonplaats = ?, b_straatnaam = ?, b_huisnummer = ?, b_postcode = ?, telefoonnummer = ? WHERE emailadres = ?");
                    // vraag alle klanten waar de searchstring in voorkomt
                    $stmt->execute([$_POST['emailadres'], $_POST['bedrijfsnaam'], $_POST['f_woonplaats'], $_POST['f_straatnaam'], $_POST['f_huisnummer'], $_POST['f_postcode'], $_POST['b_woonplaats'], $_POST['b_straatnaam'], $_POST['b_huisnummer'], $_POST['b_postcode'], $_POST['telefoonnummer'], $_POST['emailadres']]);
                }
                if (isset($_POST['delete'])) {
                    // delete emailadres, bedrijfsnaam, woonplaats, straatnaam, huisnummer, postcode, bwoonplaats, bstraatnaam, bhuisnummer, bpostcode, telefoonnummer.
                    $stmt = $pdo->prepare("DELETE FROM klant WHERE emailadres = ?");
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

    <?php
}
?>
