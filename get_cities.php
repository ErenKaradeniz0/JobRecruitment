<?php 
    require_once 'connect_db.php';
    $sql = "SELECT * FROM Cities"; 
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    ?>
    <option value="<?php echo $row["cityID"];?>" style="color:black;"><?php echo $row["city_name"];?></option>
    <?php 
    }
        sqlsrv_free_stmt($stmt);
    ?>
            
