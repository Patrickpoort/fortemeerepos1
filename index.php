<?php
//cookies.
include("cookies.php");

require ("include/database.php");
//navigation bar.
include("Navbar.php");
?>

<html>
<title>AutoQuest</title>
<!-- Bootstrap core CSS -->
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="bootstrap-3.3.7-dist/css/main.css" rel="stylesheet">

<body>
<header>
    <section class="slider">
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example" data-slide-to="1"></li>
                <li data-target="#carousel-example" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <a href="#"><img src="../fortemeerepos1/images/components.jpg" /></a>

                </div>
                <div class="item">
                    <a href="#" class="picture"><img src="../fortemeerepos1/images/engine.jpg"/></a>

                </div>
                <div class="item">
                    <a href="#"><img src="../fortemeerepos1/images/autos.jpg" /></a>

                </div>
            </div>

            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

    </section>
</header>
<br>

<div class="container" id="hometekst">

    <div class="col-md-4">
        <h2>Waarom AutoQuest</h2>
        <p>Autoquest zorgt voor een groot aanbod aan verschillende onderdelen voor uw auto. Op deze website vindt u alle informatie over de te bestellen producten en onderdelen. </p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
    </div>
    <div class="col-md-4">
        <h2>Auto-onderdelen</h2>
        <p>Op de pagina auto onderdelen vindt u al onze beschikbare producten en kunt u zoeken naar uw gewenste product. Van Audi tot BMW, alle merken zijn aanwezig met informatie zoals bouwjaar, status en prijzen.</p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
    </div>
    <div class="col-md-4">
        <h2>Werkwijze</h2>
        <p>Wij van Autoquest willen u de beste service bieden op het gebiedt van reparatie en het aanleveren van gewenste onderdelen. Neem gerust contact met ons op via de contact pagina voor eventuele vragen en onduidelijkheden.</p>
        <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
    </div>

</div>





</html>
<?php include "footer.php"; ?>


