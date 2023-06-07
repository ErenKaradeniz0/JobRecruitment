<?php 

//include "security.php";

function password_chain($password){
    $min_asci_val=32;
    $max_asci_val=126;
    $key=13;
    $mirror_key=-17;

    $cripto="";
    $cripto_mirror="";

    $mirror=(strrev($password));
    
    for ($i = 0; $i < strlen($password); $i++) {
        $char_password=ord($password[$i])+$key;
        $char_mirror=ord($mirror[$i])+$mirror_key;
        if($char_password>$max_asci_val)
            $char_password=$char_password-$max_asci_val+$min_asci_val-1;
        if($char_mirror<$min_asci_val)
            $char_mirror=$char_mirror+$max_asci_val-$min_asci_val+1;
        $cripto=$cripto.chr($char_password);
        $cripto_mirror=$cripto_mirror.chr($char_mirror);
    }

    $new_password = $cripto.''.$cripto_mirror;

    return $new_password;

}

password_chain("5738912");

function login_guard($login){
    if(!($login)){
        header("Location: index.php");
    }   
}


?>