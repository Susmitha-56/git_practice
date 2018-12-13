<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Entry</title>
    <link rel="stylesheet" href="css/fullcss.css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif|Lobster' rel='stylesheet' type='text/css'>
    
</head>
    <script src="./jquery/jquery.min.js"></script>
    <body>
<?php
include_once './config.php';
  if ($_POST) {
    $Title=stripslashes($_POST["Title"]);
    $Description=stripslashes($_POST["Description"]);
    $cast=stripslashes($_POST["cast"]);
    $ph=stripslashes($_POST["ph"]);
    $per=stripslashes($_POST["per"]);
    $prasent=stripslashes($_POST["prasent"]);
    $link=$_POST["link"];

    $Title=mysqli_real_escape_string($db,$Title);
    $Description=mysqli_real_escape_string($db,$Description);
    $cast=mysqli_real_escape_string($db,$cast);
    $prasent=mysqli_real_escape_string($db,$prasent);
    $ph=mysqli_real_escape_string($db,$ph);
    $link=mysqli_real_escape_string($db,$link);
    
    $query="INSERT INTO `scholor`(`Title`, `Description`, `cource`, `caste`, `percentage`, `moredetails`, `PH`) VALUES ('$Title','$Description','$prasent','$cast','$per','$link','$ph')";
    $result = mysqli_query($db,$query);
  }
?>

       <form  method="post" id="block" class="my" action="">
       <h1>Sign Up</h1>
            <fieldset>
          <lablel for="name">Title:</lablel>
          <input required type="text" id="name" name="Title" placeholder="Title">
          <lablel for="surname">Description:</lablel>
          <input required type="text" id="surname" name="Description" placeholder="Description">
          <label >Cast:</label>
          <select name="cast" id="cast">
            <option value="ALL">ALL</option>
            <option value="SC">SC</option>
            <option value="ST">ST</option>
            <option value="BC-A">BC-A</option>
            <option value="BC-B">BC-B</option>
            <option value="BC-C">BC-C</option>
            <option value="BC-D">BC-D</option>
            <option value="BC-E">BC-E</option>
            <option value="OC">OC</option>
            <option value="OC(DW)">OC(DW)</option>
            <option value="EBC(LISTED)">EBC(LISTED)</option>
            <option value="EBC(OTHERS)">EBC(OTHERS)</option>
          </select>
          <lablel>Physically Handicapped:</lablel><br> 
          <lablel for="">yes</lablel><input type="radio"  value="yes" name="ph">
          <lablel for="">No</lablel><input type="radio"  value="no" name="ph">
          <br><br>
          <label >course:</label>
          <select required name="prasent" id="prasent" >
                <option value="ALL">ALL</option>
          <?php 
           $query = $db->query("SELECT * FROM courses WHERE 1 ORDER BY course ASC");
           $rowCount = $query->num_rows;
           if($rowCount > 0){
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['course'].'">'.$row['course'].'</option>';
            }
        }
            ?>
        </select>
        <label >Percentage:</label>
        <input  type="text" id="per" name="per" placeholder="per">
        <label >link:</label>
        <input  type="text" id="per" name="link" placeholder="link">
        </fieldset>
         <button type="submit" id="btnSubmit" >Upload</button>
        </form>
</body>
</html>