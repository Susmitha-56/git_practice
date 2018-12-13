<?php

include("auth.php"); 
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'bloodbank';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
  
$bbname=$_SESSION['username'];
$query="SELECT `bbname` FROM `bloodbanks` WHERE username = '$bbname'";
$result = mysqli_query($db,$query) or die(mysql_error());
            while( $row = $result->fetch_assoc() ) {
                $bbname=$row['bbname'];
           }
if ($_POST) {
  $vol=$_POST['number'];
  $name=$_SESSION['username'];
  $bloodgroup=$_POST['bloodgroup'];
  $query="SELECT `bbname` FROM `blood` WHERE username = '$name'";
  $result = mysqli_query($db,$query);
  $rows = mysqli_num_rows($result);
  if($rows==0){
    $query="INSERT INTO `blood`(`bbname`, `username`) VALUES ('$bbname','$name')";
    mysqli_query($db,$query);
   
    $query="UPDATE `blood` SET `{$bloodgroup}`='$vol' WHERE username = '$name'";
    $ex=mysqli_query($db,$query);
  }if($rows==1){
     $query="SELECT `{$bloodgroup}` FROM `blood` WHERE username = '$name'";
    $ex=mysqli_query($db,$query);
    $ro = mysqli_fetch_array($ex,MYSQLI_NUM);
    $prev=intval($ro[0]);
    $vol=$prev+$vol;
    $query="UPDATE `blood` SET `{$bloodgroup}`='$vol' WHERE username = '$name'";
    mysqli_query($db,$query);
  }
}
?>
<!DOCTYPE html>
<html>
<head>

<style>
  div.container {
      width: 100%;
      border: 1px solid gray;
  }

  header, footer {
      padding: 1em;
      color: white;
      background-color: #ed5e1f;
      clear: left;
      text-align: center;
  }

  nav {
      float: left;
      max-width: 160px;
      margin: 0;
      padding: 1em;
  }

  nav ul {
      list-style-type: none;
      padding: 0;
  }
        
  nav ul a {
      text-decoration: none;
  }

  article {
      margin-left: 170px;
      border-left: 1px solid gray;
      padding: 1em;
      overflow: hidden;
  }
  #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
  }

  #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #f6b599;
      color: white;
  }
  #b {
    font-style: bold;
  }
</style>
</head>
<body>

<div class="container">

<header>
   <h1><?php echo ucwords($bbname); ?></h1>
</header>
  
<nav>
  <ul>
    <li><a href="timeline.php">Home</a></li>
    <li><a href="Profile.php">Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>
<article>
<h1>ADD BLOOD</h1>
  <form method="post" action="">
    <select  required name="bloodgroup" id="select">
            <option value="">Select a blood group</option>
            <option value="A">A-</option>
            <option value="A+">A+</option>
            <option value="B">B-</option>
            <option value="B+">B+</option>
            <option value="AB">AB-</option>
            <option value="AB+">AB+</option>
            <option value="O">O-</option>
            <option value="O+">O+</option>
          </select>
      <label>Volume</label><input type="number" name="number"><label> ml</label><br>
      <button type="submit">Add</button><br>
      
      <?php 
      $name=$_SESSION['username'];
      $query="SELECT * FROM `blood` WHERE `username` = '$name'";
      $result=mysqli_query($db,$query);
      $std =$result->fetch_assoc();
       ?>
       <h1>Stored Blood</h1>
       <table id="customers">
       <tr>
         <th>Type</th>
         <th>Quantity in ml </th>
       </tr>
  <tr>
    <td id="b">A-</td>
    <td><?php echo $std["A"]; ?></td>
  </tr>
  <tr>
    <td id="b">A+</td>
    <td><?php echo $std["A+"]; ?></td>
  </tr>
  <tr>
    <td id="b">B-</td>
    <td><?php echo $std["B"]; ?></td>
  </tr>
  <tr>
    <td id="b">B+</td>
    <td><?php echo $std["B+"]; ?></td>
  </tr>
  <tr>
    <td id="b">AB-</td>
    <td><?php echo intval($std['AB']); ?></td>
  </tr>
  <tr>
    <td id="b">AB+</td>
    <td><?php echo $std["AB+"]; ?></td>
  </tr>
  <tr>
    <td id="b">O-</td>
    <td><?php echo $std["O"]; ?></td>
  </tr>
  <tr>
    <td id="b">O+</td>
    <td><?php echo $std["O+"]; ?></td>
  </tr>
</table>
  </form>
  </article>
<footer></footer>

</div>

</body>
</html>