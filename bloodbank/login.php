<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/fullcss.css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif|Lobster' rel='stylesheet' type='text/css'>
</head>
<body>
<?php
	include_once './config.php';
    session_start();
    if (isset($_REQUEST['username'])){
        
        $username = stripslashes($_REQUEST['username']); 
        $username = mysqli_real_escape_string($db,$username); 
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($db,$password);
        $query = "SELECT * FROM `bloodbanks` WHERE username='$username' and password='".md5($password)."'";
        $result = mysqli_query($db,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $_SESSION['username'] = $username;
            header("Location: timeline.php"); // Redirect user to timeline.php
            }else{
                echo "<br><br><br><br><br><div align=center><lablel>Username/password is incorrect.</lablel><br/>Click here to <a href='login.php'>Login</a></div>";
                }
    }else{
?>
       <form  method="post" id="block" class="my" action="">
          <h1>Login</h1>
          <fieldset>
	          <lablel for="username">Username:</lablel>
	          <input required type="text" id="username" name="username" placeholder="username">
	          <lablel for="surname">Password:</lablel>
	          <input required type="password" id="password" name="password" placeholder="password">
          </fieldset>
          <button type="submit">Login</button>
        </form>
        <?php } ?>
</body>
</html>