<!--
    MIT License

    Copyright (c) 2016 Niels Helmantel

    see LICENSE file for more information
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Bootstrap core CSS -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap-3.3.7-dist/css/main.css" rel="stylesheet">

    </head>
    <body>

        <?php
        //database include
        include 'database.php';

        //cookies.
        include("include/cookies.php");

        //navigation bar.
        include("Navbar.php");
        // Aangemaakte array's
        $temp_array = [];
        $temp_value = [];
        
        //Zelfgemaakte functie. Stop geslecteerde data en database row in een array.
        function pushData($value, $value2) {
            global $temp_array;
            global $temp_value;
            array_push($temp_value, trim($_GET[$value]));
            array_push($temp_array, $value2 . " = ?");
        }
        
        //Zelfgemaakte functie. Haalt de data van bepaalde rows uit de database en stopt deze in de option values van de dropdownlijstjes.
        function getSelect($value) {
            global $pdo;
            
            $stmt1 = $pdo->prepare("SELECT distinct " . trim($value) .  " FROM product");
            $stmt1->execute();

            print "<option selected value='-'>" . "-" . "</option>";
            while ($row = $stmt1->fetch()) {               
                print "<option value= ' " . $row[$value] . " '>" . $row[$value] . "</option>";
            } 
        }

        //Resultaten weergeven
        $query = "SELECT * FROM product";


        if (isset($_GET['submit'])) {
            //zoekbalk
            if ($_GET['zoek'] != '') {
                // Vergelijkt ingevulde data met data uit de database. Zowel in de naam als in de omschrijving.
                $query = "SELECT * FROM product WHERE naam LIKE ? OR omschrijving LIKE ?";
                $temp_array[0] = "%" . $_GET['zoek'] . "%";
                $temp_array[1] = "%" . $_GET['zoek'] . "%";
            } else {
                $query = "SELECT * FROM product WHERE ";

                if ($_GET['merk'] != '-') {
                    pushData('merk', 'merk');
                }
                if ($_GET['bouwjaar'] != '-') {
                    pushData('bouwjaar', 'bouwjaar');
                }
                if ($_GET['onderdeel'] != '-') {
                    pushData('onderdeel', 'categorienaam');
                }

                // Voegt pas een AND toe and de query wanneer er al data in de temp_array staat.
                $eerste = true;
                $crit = "";

                while (count($temp_array) != 0) {
                    if ($eerste) {
                        $eerste = false;
                        $crit = array_pop($temp_array);
                    } else {
                        $crit = array_pop($temp_array) . " AND " . $crit;
                    }
                }
                $query = $query . $crit;
            }
        }


        // query wordt hier uitgevoerd
        $stmt = $pdo->prepare($query);
        $stmt->execute($temp_value);

        ?>

        <div class="aanbod-wrapper" class="cod-md-3">
            <div class="aanbod-sidebar-wrapper">
                <ul class="aanbod-sidebar-nav">
                    <li class="aanbod-filter-title"><h4>Filter uw resultaten</h4></li>
                    <li>
                        <form method="get" action="aanbodpagina.php" class="aanbod-form-search"> Zoek:<br>
                            <input type="text" class="form-control" name="zoek" value="<?php
                            if (isset($_GET['zoek'])) {
                                print htmlentities($_GET['zoek']); // <= zorgt ervoor dat de zoekbalk alleen tekst leest. Er kan bijv. geen extra from aangemaakt worden.
                            }
                            ?>">

                            <Br>
                            </li>
                            <li class="aanbod-dropdown-merk"> Automerk:<Br>

                                <select name="merk" id="merk" >
                                    <?php
                                    // Zorgt ervoor dat de data van de row 'merk' uit de database wordt opgehaald.
                                    getSelect("merk");
                                    ?>                                
                                </select>    
                            <li class="aanbod-dropdown-bouwjaar"> Bouwjaar:<Br>
                                <select name="bouwjaar" id="bouwjaar">
                                    <?php
                                    // Zorgt ervoor dat de data van de row 'bouwjaar' uit de database wordt opgehaald.
                                    getSelect('bouwjaar');
                                    ?>

                                </select></li> <br>
                            <li class="aanbod-dropdown-onderdeel"> Type onderdeel:<Br>
                                <select name="onderdeel" id="onderdeel">
                                    <?php
                                    // Zorgt ervoor dat de data van de row 'categorienaam' uit de database wordt opgehaald.
                                    getSelect('categorienaam');
                                    ?>                                    
                                </select></li> <br>
                            <li> 
                                <input class="aanbod-search-button" type="submit" name='submit' value="Zoeken">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- Tabel HTML -->
            <div class="container">
                <table class="col-md-9">
                    <tr>
                        <th class="col-md-2">Foto</th>
                        <th class="col-md-7">Productnaam</th>
                        <th class="col-md-2">Prijs</th>
                    </tr>
                    <?php
// Haalt productnummer, naam en prijs op uit de database
                    while ($row = $stmt->fetch()) {
                        $productnummer = $row["productnummer"];
                        $naam = $row["naam"];
                        $prijs = $row["prijs"];

                        // Plaats de opgehaalde data in een tabel
                        echo "<tr class=\"aanbod-table-data\">";
                        ?>
                        <div class="container">
                            <?php
                            echo "<td class='col-md-2 aanbod-image'><img src='images\img-" . $productnummer . ".jpg'></td>";
                            ?>
                        </div>
                        <?php
                        echo "<td class=\"col-md-7\"><a href=itempage.php?rowid=$productnummer>" . $naam . "</a></td>";
                        echo "<td class=\"aanbod-prijs\">" . $prijs . " EURO" . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php
//footer
        include("footer.php");
        ?>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="css/https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="css/js/bootstrap.min.js"></script>
    </body>
</html>
