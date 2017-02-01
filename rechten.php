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
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Rechten</th>
                        <th>Opslaan</th>
                    </tr>
                    <?php
                    $query = "select * from Account order by emailadres asc";

                    $stmt = $pdo->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch()) {
                        $emailadres = $row["emailadres"];
                        $voornaam = $row["voornaam"];
                        $achternaam = $row["achternaam"];
                        $rechten = $row["rechten"];

                        print "<form method='POST'>";
                        print "<tr>";
                        print "<td>" . "<input type='text' name='emailadres' value='$emailadres' readonly= 'readonly'</input>" . "</td>";
                        print "<td>" . "<input type='text' name='voornaam' value='$voornaam' readonly= 'readonly'</input>" . "</td>";
                        print "<td>" . "<input type='text' name='achternaam' value='$achternaam' readonly= 'readonly'</input>" . "</td>";
                        print "<td><select class='custom-select mb-2 mr-sm-2 mb-sm-0' id='inlineFormCustomSelect' name = 'rechten'>";
                        print "<option value = '$rechten'></option>";
                        print "<option value = '1'>Klant</option>";
                        print "<option value = '2'>Medewerker</option>";
                        print "<option value = '3'>Beheerder</option>";
                        print "</select ></td>";
                        print "<td><input type='submit' class='btn btn-success' value='opslaan' name='opslaan'></input>" . "</td>";
                        print "</tr>";
                        print "</form>";
                    }

                    if (isset($_POST['opslaan'])) {
                        $stmt = $pdo->prepare("UPDATE Account set  emailadres = ?, voornaam = ?, achternaam = ?, rechten = ? WHERE emailadres = ?");
                        $stmt->execute([$_POST['emailadres'], $_POST['voornaam'], $_POST['achternaam'], $_POST['rechten'], $_POST['emailadres']]);
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
