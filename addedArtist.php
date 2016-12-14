<!DOCTYPE html>
<html lang="en">

<head>
  
  <?php
    include 'headerstuff.php';
  ?>

    <title>Artist Added</title>

</head>

<body>

<div class="message">

  <?include 'navigation.php'; ?>

  <?php

  //include to connect to the database and echo that it was successful
  include 'dbConnection.php';
  include 'navigation.php';

  //print_r($conn);

  $artist = $_POST["Artist_Name"];
  $birthday = $_POST["Date_Of_Birth"];
  $deathday = $_POST["Date_Of_Death"];
  $country = $_POST["Country"];

  $sql = "INSERT INTO Artists (Artist_Name, Date_Of_Birth, Date_Of_Death, Country)
  VALUES('$artist', '$birthday', '$deathday', '$country')";

  if ($conn->query($sql) === TRUE){
    echo "New Artist record created succesfully<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error . "</div>";
  }

  $conn->close();

  include 'redirect.php';

  ?>






</div>


</body>
<html>
