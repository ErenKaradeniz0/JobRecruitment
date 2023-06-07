<?php
    session_start();
    require_once 'connect_db.php'; 
    
    $cityId=$_SESSION["cityID"];
    $districtId=$_SESSION["districtID"];

    $sql = "SELECT * FROM Districts WHERE cityID = cityId";
    
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
   
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        
        if($row['districtID']==$districtId){
            
             <option selected="selected" value="<?php echo $row['districtID']; ?>" style="color:black;"><?php echo $row['district_name'];; ?></option>

        }
        else{

            <option value="<?php echo $row['districtID'];?>" style="color:black;"><?php echo $row['district_name'];?></option>

        }
    }

?>

