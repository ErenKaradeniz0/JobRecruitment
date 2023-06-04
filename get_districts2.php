<?php
    session_start()
    require_once 'connect_db.php'; // Assuming you have a file to establish the database connection    if (isset($_GET['cityId']))
    $_SESSION["cityID"]
    //$cityId = $_GET['cityId'];
    $cityId=$_SESSION["cityID"];
    echo $cityId;

    //$districts = array();

    $sql = "SELECT * FROM Districts WHERE cityID = cityId";
    
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
   
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        /*$districts[] = array(
            'districtID' => $row['districtID'],
            'district_name' => $row['district_name']
        ); */
?>
    <option value="<?php echo $row['districtID'];?>"><?php echo $row['district_name'];?></option>

<?php
    }
    //echo json_encode($districts);

?>

