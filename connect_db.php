<?php
     $servername = "EREN\SQLEXPRESS";
     $dbUsername = "sa";
     $dbPassword = "1234";
     $dbName = "JobRecruitmentDB";

    
    $connectionInfo = array("UID" => $dbUsername, "PWD" => $dbPassword, "Database"=> $dbName, "CharacterSet"=>"UTF-8","ReturnDatesAsStrings" => true);
    $conn = sqlsrv_connect( $servername, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{

     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}



?>

