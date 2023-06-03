<?php 
    require_once 'connect_db.php';

    $sql = "SELECT * FROM cities";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<select id='cities'>";
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $row['city_id'] . "'>" . $row['city_name'] . "</option>";
    }
    echo "</select>";

    sqlsrv_free_stmt($stmt);
    

    

    $cityId = $_GET['city_id'];

    @$sql = "SELECT * FROM districts WHERE city_id = ?";
    $params = array($cityId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<select id='districts'>";
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $row['district_id'] . "'>" . $row['district_name'] . "</option>";
    }
    echo "</select>";

    sqlsrv_free_stmt($stmt);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

function getDistricts() {
    var cityId = document.getElementById("cities").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_districts.php?city_id=" + cityId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("districts").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

</script>

