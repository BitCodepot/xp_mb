<?php
require_once("../../config/database.php");

// 获取所有配置项
function getAllConfigs() {
    global $conn;
    $sql = "SELECT * FROM mb_config";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}



// 获取指定配置项的值
function getConfigValueByKey($key) {
    global $conn;
    $sql = "SELECT * FROM mb_config WHERE config_key='$key'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['config_value'];
    } else {
        return null; // 返回 null 表示没有找到匹配的记录
    }
}

$webname = getConfigValueByKey('webname');
$info_1 = getConfigValueByKey('info_1');
$info_2 = getConfigValueByKey('info_2');
$info_3 = getConfigValueByKey('info_3');

?>
