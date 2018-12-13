<?php
//Include database configuration file
include('Config.php'); 
if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all state data
    $query = $db->query('SELECT * FROM districts WHERE state = "'.$_POST['state_id'].'" ORDER BY district ASC');
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select district</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['district'].'">'.$row['district'].'</option>';
        }
    }else{
        echo '<option value="">district not available</option>';
    }
}

if(isset($_POST["dirstict_id"]) && !empty($_POST["dirstict_id"])){
    //Get all city data
    $query = $db->query('SELECT * FROM mandals WHERE district = "'.$_POST['dirstict_id'].'" ORDER BY mandal ASC');
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select mandal</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['mandal'].'">'.$row['mandal'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>