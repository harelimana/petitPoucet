<?php
function convert2DB($string){
    global $mysqli;
    
    return $mysqli->real_escape_string(trim($string));
}

function convertFromDB($txt){
    return stripslashes($txt);
}


function convertDate2US($date){
    $a = explode("/", $date);
    return $a[2]."-".$a[1]."-".$a[0];
}

function convertDate2FR($date){
    $a = explode("-", $date);
    return $a[2]."/".$a[1]."/".$a[0];
}

function is_email($s){
    return filter_var($s, FILTER_VALIDATE_EMAIL);
}
?>