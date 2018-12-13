<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' type='text/css' href='./css/home.css' />
</head>
  <?php 
  include_once './config.php'; ?>
  <script src="./jquery/jquery.min.js"></script>

<script type="text/javascript">
function display() {
    var S = document.forms["myForm"]["state"].value;
    var d = document.forms["myForm"]["Dirstict"].value;
    var m = document.forms["myForm"]["mandal"].value;
    var b = document.forms["myForm"]["bloodg"].value;
    $.ajax({
                type:'POST',
                url:'ajaxResults.php',
                data:{state : S,Dirstict : d, mandal : m, bloodg :b },
                success:function(html){
                    $('#result').html("<tr><th>Blood Bank Name</th><th>A-</th><th>A+</th><th>B-</th><th>B+</th><th>AB-</th><th>AB+</th><th>O-</th><th>O+</th><th>Phone Number</th><th>Address</th></tr>"+html);
                }
            }); 
    //alert(S+" n"+d+m+b);


}
  $(document).ready(function(){
    $('#state').on('change',function(){
      display();
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
      display();
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
    $('#mandal').on('change',function(){
      display();
    });
    $('#bloodg').on('change',function(){
      display();
    });
  });
</script>
  <body>
    <header>
      <a href="#" class="logo">
        <em>Blood Bank</em>
      </a>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
       
        
        </ul>      
      </nav>
    </header>
    <style type="text/css">
      select {
background-repeat:no-repeat;
background-position:300px;
width:300px;
padding:12px;
margin-top:8px;
font-family:'Lobster', cursive;
line-height:1;
border-radius:5px;
background-color:#b1042a;
color:#fff;
font-size:20px;
-webkit-appearance:none;
/*box-shadow:inset 0 0 10px 0 rgba(0,0,0,0.6);*/
outline:none;
}
select:hover {
color:#000000;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
    color: #000000;
}

tr:nth-child(even){background-color: #f2f2f2}
    </style>
	  <form name="myForm" action="./search.php">
     <!-- <label for="state">State:</label> -->
        <select required name="state" id="state" >
                <option value="">Select state</option>
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
                <!-- <label for="Dirstict">Dirstict:</label> -->
        <select required name="Dirstict" id="dirstict">
                <option value="">Select state first
                </option>
        </select>
        <!-- <label for="mandal">Mandal:</label> -->
        <select required name="mandal" id="mandal">
                <option value="">Select district first</option>
        </select>
        <!-- <label >Blood Group</label> -->
          <select required name="bloodg" id="bloodg">
            <option value="">Select blood group</option>
            <option value="A">A-</option>
            <option value="A+">A+</option>
            <option value="B">B-</option>
            <option value="B+">B+</option>
            <option value="AB">AB-</option>
            <option value="AB+">AB+</option>
            <option value="O">O-</option>
            <option value="O+">O+</option>
          </select>
          </form>
          <div style="overflow-x:auto;" >
            <table id="result">
              
            </table>
          </div>
  </body>
</html>
