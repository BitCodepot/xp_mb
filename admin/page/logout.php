// logout.php - 注销功能

<?php
session_start();
session_destroy(); // 销毁会话数据
header("Location: ../login.php"); // 重定向到登录页面
exit;
?>
