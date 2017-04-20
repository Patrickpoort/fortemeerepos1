<!--
    MIT License

    Copyright (c) 2016 Niels Helmantel

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
    ?>
    
    <?php
    
    $query = "SELECT * FROM bestelregel order by datum asc";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    ?>
    
    <div class="container">
        <div class="row">
            <table class="col-md-12 table">
                <tr>
                    <th>Bestelnummer</th>
                    <th>Emailadres</th>
                    <th>Productnummer</th>
                    <th>Aantal</th>
                    <th>Datum</th>
                </tr>
                <?php 
                    while ($row = $stmt->fetch()) {
                        echo '<tr>';
                        echo '<td>' . $row['bestelnummer'] . '</td>';
                        echo '<td>' . $row['emailadres'] . '</td>';
                        echo '<td>' . $row['productnummer'] . '</td>';
                        echo '<td>' . $row['aantal'] . '</td>';
                        echo '<td>' . $row['datum'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            
            
            </table>
        </div>
        
    </div>





    </body>
</html>

