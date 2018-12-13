<?php 
include('Config.php');
$query="SELECT * FROM `bloodbanks` WHERE ";
// AND `dirstict`='' AND `mandal`=''"
if (!empty($_POST["state"])) {
        $query=$query.'`state`="'.$_POST["state"].'"';
        if(!empty($_POST["Dirstict"])){
            $query=$query.' AND `dirstict`="'.$_POST["Dirstict"].'"';
        }  
        if(!empty($_POST["mandal"])){
            $query=$query.' AND `mandal`="'.$_POST["mandal"].'"';
        }
        
}else{
        $query=$query.'1';
}
$flag=0;
if (!empty($_POST["bloodg"])) {
            $q="SELECT * FROM `blood` WHERE `".$_POST["bloodg"]."` != 0"; 
            $flag=1; 
    }
    else{
        $q="SELECT * FROM `blood` WHERE ";
    }
$result = mysqli_query($db,$query);
while ($row=$result->fetch_assoc() ) {
    $q = ($flag==1) ? $q.' AND `username`="'.$row["username"].'"': $q.' `username`="'.$row["username"].'"';
    $r = mysqli_query($db,$q) or die(mysql_error());
    $rw=$r->fetch_assoc();
    $ad="SELECT * FROM `bloodbanks` WHERE `username`=\"".$row["username"]."\"";
    $adr=mysqli_query($db,$ad) or die(mysql_error());$add=$adr->fetch_assoc();
    if ($rw) {
    echo "<tr><td>".$rw["bbname"]."</td><td>".$rw["A"]." ml</td><td>".$rw["A+"]." ml</td><td>".$rw["B"]." ml</td><td>".$rw["B+"]." ml</td><td>".$rw["AB"]." ml</td><td>".$rw["AB+"]." ml</td><td>".$rw["O"]." ml</td><td>".$rw["O+"]." ml</td><td>".$add["PNumber"]."</td><td>".$add["Street"].",<br>".$add["mandal"].",<br>".$add["dirstict"].",<br>".$add["state"].".</td></tr>";
    }

}

?>