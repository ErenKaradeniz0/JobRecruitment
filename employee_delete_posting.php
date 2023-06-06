<?php
if (isset($_GET['id'])) {
    $jobID = $_GET['id'];

    require_once 'connect_db.php';

    // İş ilanını silme (foreign key bağımlılıklarını yöneterek)
    $sql = " -- İş ilanına ait başvuruları silme
            DELETE FROM Applications WHERE jobID = ?
            -- İş ilanını silme
            DELETE FROM Jobs WHERE jobID = ? ";
    $params = array($jobID, $jobID);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        // Hata durumunda geri al
        sqlsrv_query($conn, "ROLLBACK TRANSACTION;");
        die(print_r(sqlsrv_errors(), true));
    }

     echo "<script type='text/javascript'>
                    alert('The job posting and associated records have been deleted.');
                    window.location = 'employer_manage.php';
                    </script>"; 
    sqlsrv_close($conn);
} else {
    echo "Invalid job posting ID.";
}
?>