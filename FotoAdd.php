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

    <h4>Productfoto Toevoegen</h4> <br>
    
    <label style="color:red">LET OP! Voeg voordat u een foto upload eerst een product toe! Ga naar 'Producten' in de navigatiebalk om dat te doen! Upload daarna pas uw foto!</label> <br>
    
    <?php
    
   // Summary:
// Function to upload an image from the formfield ($img_ff) to a specified path ($dst_path), check the image and give it an
// other name ($dst_img).

//Script start here.

function uploadImage($img_ff, $dst_path, $dst_img){
$newfilename = "img-" . $_POST['productnummer'];
 $var1 = explode(".", $dst_img);
    $var2 = end($var1);
    $dst_ext = strtolower($var2);
    //Get variables for the function.
            //complete path of the destination image.
    $dst_cpl = $dst_path . $newfilename . "." . $dst_ext;
            //name without extension of the destination image.
    $dst_name = preg_replace('/\.[^.]*$/', '', $dst_img);
            //extension of the destination image without a "." (dot).
   
   



        //upload the file and move it to the specified folder.
    
    move_uploaded_file($_FILES[$img_ff]['tmp_name'], $dst_cpl);

        //get type of image.
    $dst_type = exif_imagetype($dst_cpl);

        //Checking extension and imagetype of the destination image and delete if it is wrong.
    if(( (($dst_ext =="jpg") && ($dst_type =="2")) || (($dst_ext =="jpeg") && ($dst_type =="2")) || (($dst_ext =="gif") && ($dst_type =="1")) || (($dst_ext =="png") && ($dst_type =="3") )) == false){
        unlink($dst_cpl);
        die('<p>The file "'. $dst_img . '" with the extension "' . $dst_ext . '" and the imagetype "' . $dst_type . '" is not a valid image. Please upload an image with the extension JPG, JPEG, PNG or GIF and has a valid image filetype.</p>');
    }
}
    //Script ends here.


// Needed for the function:

        // If the form is posted do this:
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Variables needed for the function.
        $img_ff = 'image'; // Form name of the image
        
        $dst_img = strtolower($_FILES[$img_ff]['name']); // This name will be given to the image. (in this case: lowercased original image name uploaded by user).
        $dst_path = 'images/'; // The path where the image will be moved to.

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


