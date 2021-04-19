<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $uploadDir = 'public/upload/';
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg', 'png', 'webp'];
    $maxFileSize = 1048576;

    if( (!in_array($extension, $extensions_ok ))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou Webp !';
    }

    $fileTmpName = $_FILES['avatar']['tmp_name'];
    if( file_exists($fileTmpName) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}
?>



<form method="post" enctype="multipart/form-data">
    <div>
    <label for="lastname">Last name :</label>
    <input type="text" id="lastname" name="lastname">
    </div>
    <div>
    <label for="firstname">First name:</label>
    <input type="text" id="firstname" name="firstname">
    </div>
    <label for="age">Age :</label>
    <input type="number" id="age" name="age">
    <div>
    <label for="imageUpload">Upload a profile image</label>    
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
    </div>

</form>


<?php
if(array_key_exists("lastname", $_POST)) {
    ?>
Last name: <?php echo $_POST["lastname"];?></br>
First name: <?php echo $_POST["firstname"];?></br>
Age: <?php echo $_POST["age"];?> </br>
Image: </br> <img src="<?= $uploadFile ?>" />
<?php } ?>