<?php

$servername = "127.0.0.1";
$username = "mibiao";
$password = "123456";
$dbname = "mibiao";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

