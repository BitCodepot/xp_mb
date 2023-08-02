<?php
require_once("config/database.php");


function getDomainsByStatus($status) {
    global $conn;

    // 使用预处理语句查询数据，防止 SQL 注入
    $stmt = $conn->prepare("SELECT * FROM mb_domains WHERE status = ? ORDER BY order_number desc ");
    $stmt->bind_param("s", $status);

    // 执行查询
    $stmt->execute();

    // 获取查询结果
    $result = $stmt->get_result();

    // 将结果转换为关联数组
    $domains = $result->fetch_all(MYSQLI_ASSOC);

    // 关闭查询
    $stmt->close();

    return $domains;
}


function calculateTotalPrice($status) {
    global $conn;

    // 使用预处理语句查询数据，防止 SQL 注入
    $stmt = $conn->prepare("SELECT SUM(price) as total_price FROM mb_domains WHERE status = ?");
    $stmt->bind_param("s", $status);

    // 执行查询
    $stmt->execute();

    // 获取查询结果
    $result = $stmt->get_result();

    // 将结果转换为关联数组
    $totalPrice = $result->fetch_assoc()['total_price'];

    // 关闭查询
    $stmt->close();

    return $totalPrice;
}






// 查询状态为"available"的域名，并按order_number排序
$available_domains = getDomainsByStatus("available");
$available_domains_total_price = calculateTotalPrice("available");

// 查询状态为"sold"的域名，并按order_number排序
$sold_domains = getDomainsByStatus("sold");
$sold_domains_total_price = calculateTotalPrice("sold");

// 查询状态为"reserved"的域名，并按order_number排序

$reserved_domains = getDomainsByStatus("reserved");
$reserved_domains_total_price = calculateTotalPrice("reserved");



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
