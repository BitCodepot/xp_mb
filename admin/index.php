<?php
if(session_status()!==PHP_SESSION_ACTIVE)
{
    session_start();
}
$_SESSION['SSSID']=md5(base64_encode('ShipSayCMS'.time()));
header('location: page/main.php');
?>