<?php

//database connectie
include("database.php");


// Set cookie for cart.
if (!isset($_COOKIE['UID'])) {
    setcookie('UID', uniqid(), time() + (86400 * 30), '/'); // 86400 = 1 day
}

// Renew cookie.
else {
    setcookie('UID', $_COOKIE['UID'], time() + (86400 * 30), '/'); // 86400 = 1 day
}

// Start session
session_start();

//function getRole() { //zoekt rechten van gebruiker
    //global $pdo;
    //$rechten = 0; // Return 0 voor gast.
    //if (isset($_SESSION['emailadres'])) {
        //$query = $pdo->prepare("SELECT * FROM Account WHERE emailadres = :mail");
        //$query->execute(array(':mail' => $_SESSION['emailadres']));
        //$user = $query->fetch(PDO::FETCH_OBJ);

        //if ($user->rechten == 1) {
          //  $rechten = 1; //return 1 voor gebruiker.
        //} elseif ($user->rechten == 2) {
          //  $rechten = 2; //return 2 voor medewerker.
        //} elseif ($user->rechten == 3) {
          //  $rechten = 3; //return 3 voor beheerder.
       // }
   // }
    //return $rechten;
//}

//function gebruiker() { // Redirect gebruikers en gasten naar login scherm.
  //  if (getRole() >= 1) {
    //    header('Location: ');
      //  exit;
   // }
//}

//function gast() { // Redirect gasten naar login scherm.
  //  if (getRole() == 0) {
    //    header('Location: ');
      //  exit;
    //}
//}

//function medewerker($rechten) { // Redirect iedereen behalve medewerker en beheerder.
  //  if (getRole() < 2) {
    //    header('Location: ');
      //  exit;
//    }
//}

//function beheerder($rechten) { // Redirect iedereen behalve beheerder.
  //  if (getRole() < 3) {
    //    header('Location: ');
      //  exit;
   // }
//}

?>
