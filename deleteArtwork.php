
<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php
    include 'headerstuff.php';
  ?>

    <title>Artwork Deleted</title>

</head>

  <body>

    <div class="message">


        <?php
        include 'dbConnection.php';

        include 'navigation.php';

        include 'redirect.php';

        $Artwork_id = $_GET['Artwork_id'];
        $sql = "DELETE FROM Artwork WHERE id=$Artwork_id";
        $result = $conn->query($sql);
        ?>



        <?php
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
        ?>

    </div>
  </body>
</html>
