<!DOCTYPE html>
<html lang="en">

<head>

  <?php
    include 'headerstuff.php';
  ?>

    <title>Artist Form</title>

</head>
<body>


  <?php include 'navigation.php'; ?>




<div id="formwrapper">
  <div id="tabletitle">
    <h2> Add an Artist </h2>
  </div>
</div>


  <form class="addForms" action="addedArtist.php" method="post">
      <div>
          <label>Artist: </label>
          <input type="text" required id="name" name="Artist_Name" placeholder="First and Last Name" />
        </div>
        <div>
          <label>Date of Birth: </label>
          <input type="number" required pattern="[0-9]{4}" maxlength=”4”  id="dob" name="Date_Of_Birth" placeholder="yyyy"/>
      </div>
      <div class="flex">
          <label>Date of Death: </label>
          <input type="number" required minlength="4" maxlength=”4”  id="dod" name="Date_Of_Death" placeholder="yyyy"/>
      </div>
      <div>
        <label>Country: </label>
          <input type="text" required id="country" name="Country" placeholder="ex: France"></input>
      </div>

      <div class="button">
          <button type="submit">Add!</button>
      </div>
  </form>
</body>

</html>
