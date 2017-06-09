<?php

//database connectie
include("database.php");

// Sessie time-out
if (!isset($_COOKIE['UID'])) {
    setcookie('UID', uniqid(), time() + (86400 * 30), '/'); // 86400 = 1 day
}

// Reset de timer
else {
    setcookie('UID', $_COOKIE['UID'], time() + (86400 * 30), '/'); // 86400 = 1 day
}

// Start sessie
session_start();

// Functie voor het weerhouden van ongeauthoriseerde gebruikers
function rechten() {
    if ($_SESSION['rechten'] < 2) {
        header("location:error404.php");
    }
}
?>
