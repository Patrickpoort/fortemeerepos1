<?php
// Set cookie for cart.
if(!isset($_COOKIE['UID'])) {
    setcookie('UID', uniqid(), time() + (86400 * 30), '/'); // 86400 = 1 day
}

// Renew cookie.
else {
    setcookie('UID', $_COOKIE['UID'], time() + (86400 * 30), '/'); // 86400 = 1 day
}


// Start session
session_start();

