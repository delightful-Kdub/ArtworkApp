 <!DOCTYPE html>
 <html lang="en">

 <head>

   <?php
     include 'headerstuff.php';
   ?>

  <title>Artwork Form</title>

 </head>

<body>



  <?php

  include 'navigation.php';

//include to connect to the database and echo that it was successful
include 'dbConnection.php';

$sql = "SELECT id, Artist_Name FROM Artists";
$artists = $conn->query($sql);

//Check if a artwork was supplied in the URL Query Parameter
if (isset($_GET['Artwork_id'])) {
  $Artwork_id = $_GET['Artwork_id'];
  //Query DB for details on that artwork piece
  $ArtworkSQL = "SELECT * FROM Artwork where id = $Artwork_id";
  $Artwork =  $conn->query($ArtworkSQL)->fetch_assoc();
}

 ?>

 <div id="formwrapper">
   <div id="tabletitle">
     <h2> Add or Update a Work of Art </h2>
   </div>
 </div>


  <form class="addForms" action="addedArtwork.php" method="post" enctype="multipart/form-data">
    <?php if(isset($Artwork_id)) echo "<input type='hidden' name='Artwork_ID' value=" . $Artwork_id ." >"; ?>
      <div>
        <label for:"ArtistID">Artist: </label>
        <select name="ArtistID">

        <?php

          if ($artists->num_rows > 0){
            //output data for each row
           while($row = $artists->fetch_assoc()){
             echo "<option value='" . $row["id"]. "'";
             if (isset($Artwork) and  $Artwork_id == $row["id"]) echo "selected";
             echo ">" . $row["Artist_Name"] . "</option>";



            }
          }
          ?>
        </select>
      </div>

      <div>
          <label for="name">Artwork: </label>
          <input type="text" required name="Title" <?php if (isset($Artwork['Title'])) echo "value='" . $Artwork['Title'] . "'"; ?> placeholder="Title"/>
      </div>
      <div>
          <label>Year Completed: </label>
          <input type="number" required pattern="[0-9]{4}"  name="artyear" <?php if (isset($Artwork['Year_Completed'])) echo "value='" . $Artwork['Year_Completed'] . "'"; ?> placeholder="yyyy"/>
      </div>
      <div>
          <label>Medium: </label>
          <select required  name="Medium">
            <option class="Medium" value="Architecture">Architecture</option>
            <option class="Medium" value="Ceramic">Ceramic</option>
            <option class="Medium" value="Digital">Digital</option>
            <option class="Medium" value="Drawing">Drawing</option>
            <option class="Medium" value="Environmental">Environmental</option>
            <option class="Medium" value="Mosaic">Mosaic</option>
            <option class="Medium" value="Painting">Painting</option>
            <option class="Medium" value="Print">Print</option>
            <option class="Medium" value="Sculpture">Sculpture</option>
            <option class="Medium" value="Textile">Textile</option>
            <option class="Medium" value="Woodcut">Woodcut</option>
          </select>
      </div>
      <div>
          <label>Period: </label>
          <select required name="Period">
            <option class="Period" value="Renaissance">Renaissance</option>
            <option class="Period" value="Baroque">Baroque</option>
            <option class="Period" value="Rococo">Rococo</option>
            <option class="Period" value="Neoclassical">Neoclassical</option>
            <option class="Period" value="Romanticism">Romanicism</option>
            <option class="Period" value="Realsism">Realism</option>
            <option class="Period" value="Impressionism">Impressionism</option>
            <option class="Period" value="PostImpressionism">Post-Impressionism</option>
            <option class="Period" value="Fauvism">Fauvism</option>
            <option class="Period" value="Expressionism">Expressionism</option>
            <option class="Period" value="Cubism">Cubism</option>
            <option class="Period" value="Futurism">Futurism</option>
            <option class="Period" value="Modernism">Modernism</option>
            <option class="Period" value="Precisionism">Precisionism</option>
            <option class="Period" value="Surrealism">Surrealism</option>
          </select>
      </div>
      <div>
          <label>Image: </label>
          <input type="file"  name="Image" id="fileToUpload"/>
      </div>

      <div class="button">
          <button type="submit" value="Upload Image" name="submit">Add!</button>
      </div>
  </form>


</body>

</html>
