<?php
$totaldisk=sprintf("%0.1f",disk_total_space($_SERVER['DOCUMENT_ROOT'])/1048576/1024);
$freedisk=$totaldisk-sprintf("%0.1f",disk_free_space($_SERVER['DOCUMENT_ROOT'])/1048576/1024);
$websrv=$_SERVER['SERVER_SOFTWARE'];
?>