
<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Categorie toevoegen</title>

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

    <h4>Categorie Toevoegen</h4>
    <form method="POST">
        <tr>
            <td><input type='text' name='categorie' value=''></input></td>;
            <td><input type='submit' class='btn btn-success' value='Toevoegen' name='toevoegen'></input></td>;

    </form>
    
    <div class="klanten-container">
            <table class="table table-striped">
                <tr>
                    <th>Huidige Categoriën</th>                    
                </tr>
    
    <?php
    
    $query = "select * from categorie order by naam asc";
                
                $stmt = $pdo->prepare($query);
                $stmt->execute();
    
    
    
    if (isset($_POST['toevoegen'])) {
      
        $stmt = $pdo->prepare("INSERT INTO categorie (naam) VALUES (?)");
        $stmt->execute([$_POST['categorie']]);
        print "Categorie Toegevoegd! Klik opnieuw op Foto/Categorie toevoegen om je resultaten te zien!";
    }
       
  
    while ($row = $stmt->fetch()) {
        
        $categorienaam = $row["naam"];
         print "<form method='POST'>";
         print "<tr>";
         print "<td>" . "<input type='text' name='categorienaam' value='$categorienaam'</input>" . "</td>";        
         print "<td>" . "<input type='submit' class='btn btn-danger' value='delete' name='delete'></input>" . "</td>";
         print "</tr>";
         print "</form>";
    }
        
                if (isset($_POST['delete'])) {
                    $stmt = $pdo->prepare("DELETE FROM categorie WHERE naam = ?");
                    $stmt->execute([$_POST['categorienaam']]);
                    print "Categorie verwijderd! Klik opnieuw op Foto/Categorie toevoegen om je resultaten te zien!";
                }
        ?>