<?php
//navigatiebar
include 'HTML HEAD.php';

//Database.
include 'database.php';




$regist_array   = [];
$regist_array2   = [];
$errors         = [];
$error_count    = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = ($_POST['emailadres']);
    $first_name = ($_POST['voornaam']);
    $last_name = ($_POST['achternaam']);
    $passw = ($_POST['wachtwoord']);
    $pass_rep = ($_POST['wachtwoord2']);
    $rechten = 1;
    $woonplaats = ($_POST['woonplaats']);
    $straatnaam = ($_POST['straatnaam']);
    $huisnummer = ($_POST['huisnummer']);
    $postcode = ($_POST['postcode']);
    $telnummer = ($_POST['telefoonnummer']);
    $bedrijfsnaam = ($_POST['bedrijfsnaam']);
    $bedrijfsplaats = ($_POST['bedrijfsplaats']);
    $bedrijfsstraat = ($_POST['bedrijfsstraat']);
    $bedrijfshuisnummer = ($_POST['bedrijfshuisnummer']);
    $bedrijfshpostcode = ($_POST['bedrijfspostcode']);
   
    

    $query = $pdo->prepare("SELECT emailadres FROM account WHERE emailadres = :emailadres");
    $query->execute(array(':emailadres' => $email));
    $result = $query->fetchAll(PDO::FETCH_OBJ);

    if (count($result)) { // Controleer het email adres
        $errors[] = 'Dit e-mailadres is al in gebruik.';
        $error_count = 1;
    }
    elseif (empty($first_name)) {
        $errors[] = 'Vul a.u.b. uw voornaam in.';
        $error_count = 1;
    }
    elseif (empty($last_name)) {
        $errors[] = 'Vul a.u.b. uw achternaam in.';
        $error_count = 1;
    }
    elseif (empty($email)) {
        $errors[] = 'Vul a.u.b. uw e-mailadres in.';
        $error_count = 1;
    }
    elseif (empty($passw)) {
        $errors[] = 'Vul a.u.b. een wachtwoord in.';
        $error_count = 1;
    }
    elseif (empty($pass_rep)) {
        $errors[] = 'Herhaal a.u.b. uw wachtwoord.';
        $error_count = 1;
    }

    elseif (!ctype_alpha(str_replace(array(' ', "'", '-'), '', $first_name)) && !empty($first_name)) { // voornaam validator.
        $errors[] = 'Uw voornaam is niet geldig.';
        $error_count = 1;
        $first_name = '';
    }
    elseif (!ctype_alpha(str_replace(array(' ', "'", '-'), '', $last_name)) && !empty($first_name)) { // achternaam validator.
        $errors[] = 'Uw achternaam is niet geldig.';
        $error_count = 1;
        $last_name = '';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Email validator.
        $errors[] = 'Uw e-mailadres is niet geldig.';
        $error_count = 1;
        $email = '';
    }
    elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/', $passw) && !empty($passw) && !empty($pass_rep)) { // Pass validator.
        $errors[] = 'Uw wachtwoord moet minimaal 1 teken en 1 nummer bevatten, tussen de 8 en 20 tekens lang zijn en mag alleen deze !@#$% speciale tekens bevatten.';
        $error_count = 1;
    }
    elseif ($passw != $pass_rep) { // vergelijk passwords.
        $errors[] = 'De wachtwoorden komen niet overeen.';
        $error_count = 1;
    }
    elseif (empty($woonplaats)) { 
        $errors[] = 'Vul a.u.b. uw woonplaats in';
        $error_count = 1;
    }
    elseif (empty($straatnaam)) {
        $errors[] = 'Vul a.u.b. een straatnaam in.';
        $error_count = 1;
    }
    elseif (empty($huisnummer)) {
        $errors[] = 'Vul a.u.b. uw huisnummer in.';
        $error_count = 1;
    }
    elseif (empty($postcode)) {
        $errors[] = 'Vul a.u.b. uw postcode in.';
        $error_count = 1;
    }
    elseif (empty($telnummer)) {
        $errors[] = 'Vul a.u.b. uw telefoonnummer in.';
        $error_count = 1;
    }

    else{
        
        $regist_array[0] = $_POST['voornaam'];
        $regist_array[1] = $_POST['achternaam'];
        $regist_array[2] = $_POST['emailadres'];
        $regist_array[3] = $_POST['wachtwoord'];
        $regist_array[4] = 1;
     

        $query = "INSERT INTO account (voornaam, achternaam, emailadres, wachtwoord, rechten) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute($regist_array);
        
        $regist_array2[0] = $_POST['emailadres'];
        $regist_array2[1] = $_POST['woonplaats'];
        $regist_array2[2] = $_POST['straatnaam'];
        $regist_array2[3] = $_POST['huisnummer'];
        $regist_array2[4] = $_POST['postcode'];
        $regist_array2[5] = $_POST['telefoonnummer'];
        $regist_array2[6] = $_POST['bedrijfsnaam'];
        $regist_array2[7] = $_POST['bedrijfsplaats'];
        $regist_array2[8] = $_POST['bedrijfsstraat'];
        $regist_array2[9] = $_POST['bedrijfshuisnummer'];
        $regist_array2[10] = $_POST['bedrijfspostcode'];
        
        $query2 = "INSERT INTO klant (emailadres, f_woonplaats, f_straatnaam, f_huisnummer, f_postcode, telefoonnummer, bedrijfsnaam, b_woonplaats, b_straatnaam, b_huisnummer, b_postcode ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute($regist_array2);
        print "U bent geregistreerd! Klik op 'Inloggen' in de navigatiebalk om in te loggen!";
        
    }
}

?>




    <div class="container">
        <?php
        if($error_count > 0) {
            echo '<div class="alert alert-error"><span>ERROR</span><ul class="no-padding">';
            foreach ($errors as $error) {
                echo '<li>'.$error.'</li>';
            }
            echo '</ul></div>';
        }
        ?>
   
        <form class="" method="post" action="Registreren.php">
            <h2 class="form-signin-heading">Registreren</h2>
            <p>Velden met een sterretje (*) zijn verplicht!</p>
            <div class="col-md-4">
            <!-- Voorletters -->
            <label for="Emailadres" class="sr-only">Emailadres</label>
            <input name="emailadres" type="email" id="emailadres" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Emailadres*" required><br>
            <!-- Voornaam -->
            <label for="Voornaam" class="sr-only">Voornaam</label>
            <input name="voornaam" type="text" id="voornaam" class="form-control" placeholder="Voornaam*" required><br>
            <!-- Achternaam -->
            <label for="Achternaam" class="sr-only">Achternaam</label>
            <input name="achternaam" type="text" id="achternaam" class="form-control" placeholder="Achternaam*" required autofocus><br>
            <!-- Wachtwoord -->
            <label for="Wachtwoord" class="sr-only">Wachtwoord</label>
            <input name="wachtwoord" type="password" id="wachtwoord" class="form-control" placeholder="Wachtwoord*" required autofocus><br>
            <!-- Wachtwoord -->
            <label for="Wachtwoord2" class="sr-only">Verifieer Wachtwoord</label>
            <input name="wachtwoord2" type="password" id="wachtwoord2" class="form-control" placeholder="Verifieer wachtwoord*" required autofocus><br>
            <!-- Button Registreren -->
            
            </div>
            
           <div class="col-md-4"> 
            <!-- Woonplaats -->
            <label for="woonplaats" class="sr-only">Woonplaats</label>
            <input name="woonplaats" type="text" id="woonplaats" class="form-control" placeholder="Woonplaats*" required><br>
            <!-- Straatnaam -->
            <label for="straatnaam" class="sr-only">Straatnaam</label>
            <input name="straatnaam" type="text" id="straatnaam" class="form-control" placeholder="Straatnaam*" required autofocus><br>
            <!-- Huisnummer -->
            <label for="huisnummer" class="sr-only">Huisnummer</label>
            <input name="huisnummer" type="huisnummer" id="huisnummer" class="form-control" placeholder="Huisnummer*" required autofocus><br>
            <!-- Postcode -->
            <label for="postcode" class="sr-only">Postcode</label>
            <input name="postcode" type="text" id="postcode" class="form-control" placeholder="Postcode*" required autofocus><br>
            <!-- Telefoonnummer -->
            <label for="telefoonnummer" class="sr-only">Telefoonnummer</label>
            <input name="telefoonnummer" type="text" id="telefoonnummer" class="form-control" placeholder="Telefoonnummer*" required autofocus><br>
           </div>
        
           <div class="col-md-4">
            <!-- Bedrijfskunde -->
            <label for="bedrijfsnaam" class="sr-only">Bedrijfsnaam</label>
            <input name="bedrijfsnaam" type="text" id="bedrijfsnaam" class="form-control" placeholder="Bedrijfsnaam"><br>
            <!-- Vestiging Bedrijf -->
            <label for="bedrijfsplaats" class="sr-only">Vestigingsplaats bedrijf</label>
            <input name="bedrijfsplaats" type="text" id="bedrijfsplaats" class="form-control" placeholder="Vestigingsplaats bedrijf"autofocus><br>
            <!-- Straatnaam bedrijf -->
            <label for="bedrijfsstraat" class="sr-only">Straatnaam bedrijf</label>
            <input name="bedrijfsstraat" type="text" id="bedrijfsstraat" class="form-control" placeholder="Straatnaam bedrijf" autofocus><br>
            <!-- Huisnummer Bedrijf -->
            <label for="bedrijfshuisnummer" class="sr-only">Huisnummer bedrijf</label>
            <input name="bedrijfshuisnummer" type="text" id="bedrijfshuisnummer" class="form-control" placeholder="Huisnummer bedrijf" autofocus><br>
            <!-- Postcode Bedrijf -->
            <label for="bedrijfspostcode" class="sr-only">Postcode bedrijf</label>
            <input name="bedrijfspostcode" type="text" id="bedrijfspostcode" class="form-control" placeholder="Postcode bedrijf" autofocus><br>
            <button id="RegisButton" class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Registreren</button>
           </div>
           
        </form>
    
    </div>


<?php include("footer.php"); ?>