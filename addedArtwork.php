<!DOCTYPE html>
<html lang="en">

<head>

  <?php
    include 'headerstuff.php';
  ?>

    <title>Artwork Added</title>

</head>

<body>

<div class="message">

  <?php

  include 'navigation.php';

  //include to connect to the database and echo that it was successful
  include 'dbConnection.php';

  //include 'redirect.php';




  //print_r($conn);
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["Image"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["Image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["Image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}




  $title = $_POST["Title"];
  $artistid = $_POST["ArtistID"];
  $year = $_POST["artyear"];
  $medium = $_POST["Medium"];
  $period = $_POST["Period"];
  $image = $_FILES["Image"]["name"];

  
  //Check if we got here from selecting update or from selecting add artwork
  if (isset($_POST['Artwork_ID']))
  {
    $artwork_id = $_POST['Artwork_ID'];
    $sql =  "UPDATE Artwork SET Title='$title', Artist_ID='$artistid', Year_Completed = '$year', Medium='$medium', Period = '$period', Image = '$image'
    WHERE id = $artwork_id";
  } else {
    $sql = "INSERT INTO Artwork (Title, Artist_ID, Year_Completed, Medium, Period, Image)
    VALUES('$title', '$artistid', '$year', '$medium', '$period', '$image')";
}
  if ($conn->query($sql) === TRUE){
    echo "New Artwork record created succesfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  ?>



</div>

</body>
</html>
