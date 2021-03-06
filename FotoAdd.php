<html lang="en">    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Productfoto toevoegen</title>

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

    <h4>Productfoto Toevoegen</h4>
    
    <label style="color:red">LET OP! Voeg voordat u een foto upload eerst een product toe! Ga naar 'Producten' in de navigatiebalk om dat te doen! Upload daarna pas uw foto! Uitsluitend .JPG bestanden!</label> <br>
    
    <?php
   
// creërt een bestandsnaam
function uploadImage($img_ff, $dst_path, $dst_img){
$newfilename = "img-" . $_POST['productnummer'];
 $var1 = explode(".", $dst_img);
    $var2 = end($var1);
    $dst_ext = strtolower($var2);
    //bestandsnaam zonder extentie
    $dst_cpl = $dst_path . $newfilename . "." . $dst_ext;
            
    $dst_name = preg_replace('/\.[^.]*$/', '', $dst_img);
          
   
   



        //Bestand uploaden
    
    move_uploaded_file($_FILES[$img_ff]['tmp_name'], $dst_cpl);

        //get type of image.
    $dst_type = exif_imagetype($dst_cpl);

       //controleerd de exentie van het bestand en verwijdert het wanneer het niet voldoet.
    if(( (($dst_ext =="jpg") && ($dst_type =="2")) || (($dst_ext =="jpeg") && ($dst_type =="2")) || (($dst_ext =="gif") && ($dst_type =="1")) || (($dst_ext =="png") && ($dst_type =="3") )) == false){
        unlink($dst_cpl);
        die('<p>The file "'. $dst_img . '" with the extension "' . $dst_ext . '" and the imagetype "' . $dst_type . '" is not a valid image. Please upload an image with the extension JPG, JPEG, PNG or GIF and has a valid image filetype.</p>');
    }
}
    //Script ends here.


// Needed for the function:

        // If the form is posted do this:
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Variable voor de functie
        $img_ff = 'image'; // Form naam van de afbeelding
        
        $dst_img = strtolower($_FILES[$img_ff]['name']); // Dit creërt de uiteindelijke naam van het bestand.
        $dst_path = 'images/'; // Map waar de afbeelding terecht komt.

        uploadImage($img_ff, $dst_path, $dst_img);
        print "Gelukt! Uw foto is toegevoegd!";
    }



 //HTML Starts Here.
?>
<!-- // Form needed to upload the image.
     // You can change the name of the form, dont forget to change that in the variable $img_ff.
     // You can change the action file. (In this case i use the same name as this file.)-->
<form enctype="multipart/form-data" name="image" method="post" action="FotoAdd.php" class="FotoAdd_form">
    <label for="image">Productnummer:</label> 
    <input type="text" id="productnummer" name='productnummer'> <br>
    <label for="image">Uw foto:</label>   
    <input type="file" id="image" name="image">
    <br />
    <input type="submit" value="Upload" />&nbsp;<input type="reset" value="Reset" />
</form>


