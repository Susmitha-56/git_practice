<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/fullcss.css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif|Lobster' rel='stylesheet' type='text/css'>
    
</head>
    <script src="./jquery/jquery.min.js"></script>
    <script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
    $(document).ready(function(){
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#dirstict').html(html);
                   $('#mandal').html('<option value="">Select dirstict first</option>'); 
                }
            }); 
        }else{
            $('#dirstict').html('<option value="">Select state first</option>');
            $('#mandal').html('<option value="">Select dirstict first</option>'); 
        }
    });
    $('#dirstict').on('change',function(){
        var dirstictID = $(this).val();
        if(dirstictID){
          
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'dirstict_id='+dirstictID,
                success:function(html){
                    $('#mandal').html(html);
                }
            }); 
        }else{
            $('#mandal').html('<option value="">Select dirstict first</option>'); 
        }
    });
  });
    </script>
<body>
<?php
include_once './config.php';
  if ($_POST) {
    $bbname=stripslashes($_POST["bbname"]);
    $type=stripslashes($_POST["type"]);
    $PNumber=stripslashes($_POST["PNumber"]);

    $state=stripslashes($_POST["state"]);
    $dirstict=stripslashes($_POST["Dirstict"]);
    $mandal=stripslashes($_POST["mandal"]);
    $streat=stripslashes($_POST["streat"]);

    $username=stripslashes($_POST["username"]);
    $password=stripslashes($_POST["password"]);

    $bbname=mysqli_real_escape_string($db,$bbname);
    $Type=mysqli_real_escape_string($db,$type);
    $state=mysqli_real_escape_string($db,$state);
    $dirstict=mysqli_real_escape_string($db,$dirstict);
    $mandal=mysqli_real_escape_string($db,$mandal);
    $streat=mysqli_real_escape_string($db,$streat);
    $username=mysqli_real_escape_string($db,$username);
    $password=mysqli_real_escape_string($db,$password);
    
    $query="INSERT INTO `bloodbanks`(`bbname`, `type`, `PNumber`, `password`, `username`, `state`, `dirstict`, `mandal`, `Street`) VALUES ('$bbname','$type','$PNumber','".md5($password)."','$username','$state','$dirstict','$mandal','$streat')";
    $result = mysqli_query($db,$query);
    if ($result) {
      echo "<br><br><br><br><br><div align=center ><label>You are registered successfully.</label><br/>Click here to <a href='./login.php'>Login</a></div>";
    }
  }
  else{
?>

       <form  method="post" id="block" class="my" action="">
            <h1>Sign Up</h1>
            <fieldset>
          <label >Blood Bank Name</label>
          <lablel for="name">Name:</lablel>
          <input required type="text" id="name" name="bbname" placeholder="Bank Name">
          <lablel>Type:</lablel><br>
                
          <lablel >Governament</lablel><input type="radio" value="govt" name="type">
          <lablel >Privarte</lablel><input type="radio" value="pvt" name="type"><br><br>
        <label>Address:</label>
        <label for="state">State:</label>
        <select required name="state" id="state" >
                <option value=" ">Select start</option>
                <?php 
           $query = $db->query("SELECT * FROM states WHERE 1 ORDER BY name ASC");
           $rowCount = $query->num_rows;
           if($rowCount > 0){
            while($row = $query->fetch_assoc()){ 
                echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }
        }else{
            echo '<option value="">State not available</option>';
        }
            ?>
        </select>
                <label for="Dirstict">Dirstict:</label>
        <select required name="Dirstict" id="dirstict">
                <option value="">Select state first
                </option>
        </select>
        <label for="mandal">Mandal:</label>
        <select required name="mandal" id="mandal">
                <option value="">Select dirstict first</option>
        </select>
        <label >Street</label>
          <input required type="text" id="Village" name="streat" placeholder="Street,Land Mark">
          <label >Phone Number</label>
          <input required type="text" id="phone" name="PNumber" placeholder="Phone Number">
          <label>User Name:</label>
          <input required type="text" id="username" name="username" placeholder="User Name" onBlur="checkAvailability()">
          <label >Password:</label>
          <input required type="password" name="password" id="txtPassword" placeholder="Password" />
          <input required type="password" id="txtConfirmPassword" placeholder="Re-Password"/>
        </fieldset>
         <button type="submit" id="btnSubmit" >Sign Up</button>
        </form>
        <?php } ?>
</body>
</html>