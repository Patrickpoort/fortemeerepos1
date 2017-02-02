<!--
    MIT License

    Copyright (c) 2016 Edwin van Dasselaar

    see LICENSE file for more information
-->
<?php
/*** Created by PhpStorm.*/

session_start();

include("HTML HEAD.php");
include "database.php";


?>

<!DOCTYPE Html>
	<body>
	<h1>Uw bestelling is afgerond. Hartelijk bedankt voor het plaatsen van uw bestelling.</h1>
	<br>
	<div class="container">
	<div class="row">
		Alle onderdelen worden klaar gezet door de medewerkers van Autoquest en kunnen vervolgens op afspraak worden ophaalt of opgestuurd.
	</div>
		<div class="row">
			De medewerker zal contact met u opnemen om een afspraak te maken rondom de bestelling.
			Zorg ervoor dat uw contact gegevens kloppen zoals hier onder aangegeven.
		</div>
		<div>
			<?php



			?>
		</div>
		<br>
		</br>
	<div class="row">
		<b>Gegevens Autoquest:</b>
		<br>
		</br>
		<ul>
			Adres: Het Rister 8B
		</ul>
		<ul>
			Postcode: 8314 RD, Bant
		</ul>
		<ul>
			Telefoonnummer: 0527 261 178
		</ul>
		<ul>
			Emailadres: autoquestbant@gmail.com
		</ul>
		<form class="afrondknop" action="index.php">
			<button>Terug naar Home</button>
			<br>
		</form>
		<form class="afrondknop" action="aanbodpagina.php">
			<button>Meer producten bekijken.</button>
			<br>
		</form>
	</div>
</div>











	</body>

</html>

<?php include "footer.php"; ?>





