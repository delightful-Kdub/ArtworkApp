<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  include 'headerstuff.php';

  ?>

    <title>Art Record</title>

</head>


 <?php
//include to connect to the database and echo that it was successful
include 'dbConnection.php';
include 'navigation.php';
?>


<body>

<!--FILTER STUFF-->
<div id="filterBar">

<div id="filtertitle"><h3>Filter</h3></div>

<div id="filterForm">
  <p>Choose One:</p>
  <form action="index.php" method="GET">
      <label>Period:</label>
      <select name="Period">
        <option class="Period" value="null"> </option>
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
      <input type="submit" value="Filter">
  </form>

<form action="index.php" method="GET">
      <label>Medium:</label>
      <select name="Medium">
        <option class="Medium" value="null"> </option>
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
      </select><br/>
    <input type="submit" value="Filter">
</form>

    <script>
      jQuery(function() {
        $('input:radio').change(function(){
            var val = $('input:radio:checked').val();
            $('#Select').val(0)
            $('option[class]').hide();
            $('option[class*="' + val + '"]').show();
        });
      })
    </script>
  </div>

  <form id="tableReset" action="index.php" method="POST">
    <input type="submit" value="Reset Table">
  </form>


</div>

<!--END filter stuff -->




<?php

include 'navigation.php';

//show joined table
//---vv Sorting
$orderBy = array('ArtistID', 'Artist_Name','Date_Of_Birth','Date_Of_Death','Country','Title', 'Year_Completed', 'Medium', 'Period');

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];



if (strpos($url,'&A') == true) {
  if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
      $order = $_GET['orderBy'];
      $sql = "SELECT
        Artwork.ID as Artwork_id, Title, Artist_ID, Year_Completed, Medium, Period, Image,
        Artists.ID as ArtistID, Artist_Name, Date_Of_Birth, Date_Of_Death, Country
        FROM Artists JOIN Artwork ON Artwork.Artist_ID = Artists.ID ORDER BY " .$order ." ASC";
    }
}else if (strpos($url,'&D') == true) {
  if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
        $order = $_GET['orderBy'];
        $sql = "SELECT
          Artwork.ID as Artwork_id, Title, Artist_ID, Year_Completed, Medium, Period, Image,
          Artists.ID as ArtistID, Artist_Name, Date_Of_Birth, Date_Of_Death, Country
          FROM Artists JOIN Artwork ON Artwork.Artist_ID = Artists.ID ORDER BY " .$order ." DESC";
      }
}

//---^^ END Sorting

//----filtering vv
else if (strpos($url,'Period') == true) {
      $periodFilter = $_GET['Period'];
      $sql = "SELECT
        Artwork.ID as Artwork_id, Title, Artist_ID, Year_Completed, Medium, Period, Image,
        Artists.ID as ArtistID, Artist_Name, Date_Of_Birth, Date_Of_Death, Country
        FROM Artists JOIN Artwork ON Artwork.Artist_ID = Artists.ID WHERE Period='" .$periodFilter . "'";

    }else if (strpos($url,'Medium') == true) {
          $mediumFilter = $_GET['Medium'];
          $sql = "SELECT
            Artwork.ID as Artwork_id, Title, Artist_ID, Year_Completed, Medium, Period, Image,
            Artists.ID as ArtistID, Artist_Name, Date_Of_Birth, Date_Of_Death, Country
            FROM Artists JOIN Artwork ON Artwork.Artist_ID = Artists.ID WHERE Medium='" .$mediumFilter . "'";
        }else{
                $sql = "SELECT
                  Artwork.ID as Artwork_id, Title, Artist_ID, Year_Completed, Medium, Period, Image,
                  Artists.ID as ArtistID, Artist_Name, Date_Of_Birth, Date_Of_Death, Country
                FROM Artists JOIN Artwork ON Artwork.Artist_ID = Artists.ID";

              }

//-----^^ END Filtering




$result = $conn->query($sql);

  echo '<div id="tablewrapper"><div id="tabletitle"><h2> Art and Artist Record </h2></div>';


  if($result->num_rows > 0) {
      echo '<table>
      <tr>

        <th>Artist Name <br/><a href="?orderBy=Artist_Name&A">v</a> <a href="?orderBy=Artist_Name&D">^</a></th>
        <th class="desktop">Year of Birth <br/><a href="?orderBy=Date_Of_Birth&A">v</a> <a href="?orderBy=Date_Of_Birth&D">^</a></th>
        <th class="desktop">Year of Death <br/><a href="?orderBy=Date_Of_Death&A">v</a> <a href="?orderBy=Date_Of_Death&D">^</a></th>
        <th class="desktop">Country <br/><a href="?orderBy=Country&A">v</a> <a href="?orderBy=Country&D">^</a></th>
        <th>Title <br/><a href="?orderBy=Title&A">v</a> <a href="?orderBy=Title&D">^</a></th>
        <th class="desktop">Year <br/><a href="?orderBy=Year_Completed&A">v</a> <a href="?orderBy=Year_Completed&D">^</a></th>
        <th>Medium <br/><a href="?orderBy=Medium&A">v</a> <a href="?orderBy=Medium&D">^</a></th>
        <th class="desktop">Period <br/><a href="?orderBy=Period&A">v</a> <a href="?orderBy=Period&D">^</a></th>
        <th>Image</th>
      </tr>';
  while($row = $result->fetch_assoc()) {
      echo '<tr>' .

        '<td>' . $row['Artist_Name']. '</td>' .
        '<td class="desktop">' . $row['Date_Of_Birth'] . '</td>' .
        '<td class="desktop">' . $row['Date_Of_Death'] . '</td>' .
        '<td class="desktop">' . $row['Country'] . '</td>' .
        '<td>' . $row['Title']. '</td>' .
        '<td class="desktop">' . $row['Year_Completed']. '</td>' .
        '<td>' . $row['Medium']. '</td>' .
        '<td class="desktop">' . $row['Period']. '</td>' .
        '<td>' . '<a href="uploads/'.$row['Image']. '" target="_blank">'.'<img src="uploads/' . $row['Image'] . ' "class="thumbnail" width="40px" height="auto"/>' . '</a>' . '</td>' .
        '<td>' . '<a href=deleteArtwork.php?Artwork_id=' . $row['Artwork_id']  .'> delete</a>' . '</td>' .
        '<td>' . '<a href=ArtworkForm.php?Artwork_id=' . $row['Artwork_id']  .'> update</a>' . '</td>' .
      '</tr>';
}
echo '</table></div>';
}



$conn->close();

?>


</body>

</html>
