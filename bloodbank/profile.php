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
   <h1><?php include("auth.php");  echo $_SESSION['username']; ?></h1>
</header>
  
<nav>
  <ul>
    <li><a href="timeline.php">Home</a></li>
    <li><a href="Profile.php">Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>
<?php 
$dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'bloodbank';
        $username= $_SESSION['username'];
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        $query = "SELECT * FROM `bloodbanks` WHERE username='$username'";
        $result = mysqli_query($db,$query) or die(mysql_error());
        $std =$result->fetch_assoc();
 ?>
<article>
<table id="customers">
  <tr>
    <td id="b">Bload Bank Name</td>
    <td><?php echo $std["bbname"]; ?></td>
  </tr>
  <tr>
    <td id="b">Type</td>
    <td><?php echo $std["type"]; ?></td>
  </tr>
  <tr>
    <td id="b">User Name</td>
    <td><?php echo $std["username"]; ?></td>
  </tr>
  <tr>
    <td id="b">Address</td>
    <td><?php echo $std["Street"].",<br>".$std["mandal"].",<br>".$std["dirstict"].",<br>".$std["state"].".<br>Phone Num:-".$std["PNumber"]; ?></td>
  </tr>
</table>
</article>
<footer></footer>

</div>


</body>
</html>