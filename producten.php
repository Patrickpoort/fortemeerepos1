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
    
    // lijst aangemaakt voor dubbele code zodat er een foreach loop aangemaakt kan worden
    $dataArray = ['productnummer', 'naam', 'categorienaam', 'omschrijving', 'merk', 'type', 'bouwjaar', 'voorraad', 'gewicht', 'prijs'];

    //adminpanel navbar
    include("apanelnav.php");
    ?>
    <body>
        <div class="klanten-container">
            <!-- Tabel voor de gegevens-->
            <label style="color:red">LET OP! Als de categorie die u wilt gebruiken bij het toevoegen of wijzigen van een product nog niet bestaat, voeg deze dan eerst toe bij 'Categorie toevoegen' in de navigatiebalk!<br></label>
            <table class="table table-striped">
                <tr>
                    <?php
                        foreach ($dataArray as $value) {
                            print "<th>$value</th>";
                        }
                    
                    ?>
                    
                </tr>
                <?php
                // Geeft bestaande producten weer in de tabel.
                $query = "select * from Product order by productnummer asc";

                $stmt = $pdo->prepare($query);
                $stmt->execute();

                // haalt productinformatie op uit de database
                while ($row = $stmt->fetch()) {
                    $productnummer = $row["productnummer"];
                    $naam = $row["naam"];
                    $categorienaam = $row["categorienaam"];
                    $omschrijving = $row["omschrijving"];
                    $merk = $row["merk"];
                    $type = $row["type"];
                    $bouwjaar = $row["bouwjaar"];
                    $voorraad = $row["voorraad"];
                    $gewicht = $row["gewicht"];
                    $prijs = $row["prijs"];
                    print "<form method='POST'>";
                    print "<tr>";
                    print "<td>" . "<input type='text' name='productnummer' value='$productnummer'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='naam' value='$naam'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='categorienaam' value='$categorienaam'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='omschrijving' value='$omschrijving'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='merk' value='$merk'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='type' value='$type'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='bouwjaar' value='$bouwjaar'</input>" . "</td>";
                    print "<td>" . "<input type='number' name='voorraad' value='$voorraad'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='gewicht' value='$gewicht'</input>" . "</td>";
                    print "<td>" . "<input type='text' name='prijs' value='$prijs'</input>" . "</td>";
                    print "<td>" . "<input type='submit' class='btn btn-success' value='opslaan' name='opslaan'></input>" . "</td>";
                    print "<td>" . "<input type='submit' class='btn btn-danger' value='delete' name='delete'></input>" . "</td>";
                    print "</tr>";
                    print "</form>";
                }
                // Maakt een nieuwe lege laag voor het nieuwe product
                print "<form method='POST'>";
                print "<tr>";
                
                // loopt door array (bovenaan file) maakt tabel aan met waarde
                foreach ($dataArray as $value) {
                    print "<td>" . "<input type='text' name=$value value=''</input>" . "</td>";
                }
                
                print "<td>" . "<input type='submit' class='btn btn-success' value='toevoegen' name='toevoegen'></input>" . "</td>";
                print "</tr>";
                print "</form>";

                 // Haalt alle categorienamen op uit de database en zet ze in een array.   
                $results = array();
                $query = "SELECT naam FROM categorie";

                $stmt = $pdo->prepare($query);               
                $stmt->execute();
                
                while ($row = $stmt->fetch()) {
                    $results[] = $row['naam'];
                }
                
                // Voegt het nieuwe product toe
                if (isset($_POST['toevoegen'])) {
                    // Controleert of categorie wel bestaat d.m.v. die array.
                  if (in_array(($_POST['categorienaam']), $results)) { 
                    
                    $stmt = $pdo->prepare("INSERT INTO Product (productnummer, naam, categorienaam, omschrijving, merk, type, bouwjaar, voorraad, gewicht, prijs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$_POST['productnummer'], $_POST['naam'], $_POST['categorienaam'], $_POST['omschrijving'], $_POST['merk'], $_POST['type'], $_POST['bouwjaar'], $_POST['voorraad'], $_POST['gewicht'], $_POST['prijs']]);
                    print "Gelukt! Druk nogmaals op 'Producten' in de navigatiebalk om uw resultaat te zien!";
                } else {
                    print "FOUT! Categorienaam niet gevonden! Controleer uw spelling en of u de categorie heeft toegevoegd!";
                }
                
                }
                // Gewijzigde gegevens opslaan
                if (isset($_POST['opslaan'])) {
                    // Controleert of categorie wel bestaat d.m.v. die array.
                     if (in_array(($_POST['categorienaam']), $results)) {                        
                     
                    $stmt = $pdo->prepare("UPDATE Product set productnummer = ?, naam = ?, categorienaam = ?, omschrijving = ?, merk = ?, type = ?, bouwjaar = ?, voorraad = ?, gewicht = ?, prijs = ? WHERE productnummer = ?");
                    $stmt->execute([$_POST['productnummer'], $_POST['naam'], $_POST['categorienaam'], $_POST['omschrijving'], $_POST['merk'], $_POST['type'], $_POST['bouwjaar'], $_POST['voorraad'], $_POST['gewicht'], $_POST['prijs'], $_POST['productnummer']]);
                    } else {
                     print "FOUT! Categorienaam niet gevonden! Controleer uw spelling en of u de categorie heeft toegevoegd!";   
                    }
                     }
                // Gegevens verwijderen
                if (isset($_POST['delete'])) {
                    $stmt = $pdo->prepare("DELETE FROM Product WHERE productnummer = ?");
                    $stmt->execute([$_POST['productnummer']]);
                }
                //footer
                include("footer.php");
                ?>
            </table>
        </div>
    </body>
</html>


