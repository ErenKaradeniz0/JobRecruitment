<?php 
    session_start();
    require_once 'connect_db.php'; 
    
    @$cityId=$_SESSION["cityID"];
    echo $cityId;
    
    $sql = "SELECT * FROM Cities"; 
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        
        if($row['cityID']==$cityId){
?>
             <option selected="selected" value="<?php echo $row['cityID']; ?>" style="color:black;"><?php echo $row['city_name']; ?></option>
<?php
        }
        else{
?>
            <option value="<?php echo $row['cityID'];?>" style="color:black;"><?php echo $row['city_name'];?></option>
<?php
        }
    }

?>     
