<?php
/**
 * Created by PhpStorm.
 * User: Niels Helmantel
 * Date: 6-1-2017
 * Time: 00:17
 */

session_start();

include("HTML HEAD.php");
include "database.php";
$pdo = connecttodb();

?>

<h1>Bedankt voor het plaatsen van uw bestelling!</h1>

//$bestelnummer =+ 1;
//$emailadres = "testklant@gmail.com";
//$productnummer = $_GET['productnummer'];
//$aantal = $_GET['aantal'];
//$datum = date("Y-m-d H:i:s");
//$betaald = 0;
//

//$stmt = $pdo->prepare("INSERT INTO bestelregel (bestelnummer, emailadres, productnummer,
//aantal, datum, betaald) VALUES (:bestelnummer, :email, :pnummer, :aantal, :datum, :betaald)");
//
//$stmt->execute(array(
//    "bestelnummer" => $bestelnummer,
//    "email" => $emailadres,
//    "pnummer" => $productnummer,
//    "aantal" => $aantal,
//    "datum" => $datum,
//    "betaald" => $betaald,
//));