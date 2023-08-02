<?php

require_once("../../config/database.php");
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
switch ($_REQUEST['do']) {
    case "showlist":
// 获取搜索条件、页码和每页记录数
        $search = isset($_REQUEST['searchkey']) ? $_REQUEST['searchkey'] : null;
        $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        $limit = isset($_REQUEST['limit']) ? intval($_REQUEST['limit']) : 10;

// 调用函数获取总记录数和分页数据
        $domainData = getAllDomains($search, $page, $limit);

// 获取总记录数和分页数据
        $totalRecords = $domainData['total'];
        $domain_list = $domainData['data'];

// 构造 JSON 响应数据
        $json = ["code" => 0, "count" => $totalRecords, "data" => $domain_list];

// 输出 JSON 响应
        echo json_encode($json);
        break;
    case "newdomain":
        $domain_name = $_REQUEST['domain_name'];
        $price = $_REQUEST['price'];
        $platform = $_REQUEST['platform'];
        $description = $_REQUEST['description'];
        $platform_url = $_REQUEST['platform_url'];
        $status = $_REQUEST['status'];
        $order_number = $_REQUEST['order_number'];
        $result = addDomain($domain_name, $price, $platform, $description, $platform_url, $status, $order_number);
        if ($result) {
            echo 200;
        } else {
            echo 500;
        }
        break;
    case "updatedomain":
        $domain_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $domain_name = $_REQUEST['domain_name'];
        $price = $_REQUEST['price'];
        $platform = $_REQUEST['platform'];
        $description = $_REQUEST['description'];
        $platform_url = $_REQUEST['platform_url'];
        $status = $_REQUEST['status'];
        $order_number = $_REQUEST['order_number'];
        $result = updateDomain($domain_id, $domain_name, $price, $platform, $description, $platform_url, $status, $order_number);
        if ($result) {
            echo 200;
        } else {
            echo 500;
        }
        break;
    case "deletedomain":
        $domain_id = $_REQUEST['domain_id'];
        $result = deleteDomain($domain_id);
        if ($result) {
            echo 200;
        } else {
            echo 500;
        }
        break;
    case "deletelist":
        $domain_ids = $_REQUEST['domain_ids'];
        $result = deleteMultipleDomains($domain_ids);
        if ($result) {
            echo 200;
        } else {
            echo 500;
        }
        break;

}

// 获取域名列表


/**
 * 获取域名列表
 * @param string|null $search 搜索条件（可选）
 * @param int $page 当前页数
 * @param int $limit 每页显示的记录数
 * @return array 返回域名列表数据的数组
 */
function getAllDomains($search = null, $page = 1, $limit = 10)
{
    global $conn;

    // 定义 SQL 查询语句的基本部分
    $sqlBase = "SELECT * FROM mb_domains";

    // 定义搜索条件的 SQL 部分
    $searchSQL = "";
    if ($search) {
        $search = $conn->real_escape_string($search); // 防止 SQL 注入
        $searchSQL = " WHERE domain_name LIKE '%$search%' OR platform LIKE '%$search%' OR description LIKE '%$search%' OR platform_url LIKE '%$search%'";
    }

    // 定义完整的 SQL 查询语句，用于统计满足条件的结果数量
    $countSQL = "SELECT COUNT(*) AS total FROM mb_domains" . $searchSQL;

    // 执行统计查询并获取总记录数
    $resultCount = $conn->query($countSQL);
    $row = $resultCount->fetch_assoc();
    $totalRecords = $row['total'];

    // 计算查询的起始位置
    $offset = ($page - 1) * $limit;

    // 定义完整的 SQL 查询语句，包含分页部分
    $sql = $sqlBase . $searchSQL . " ORDER BY order_number ASC LIMIT $offset, $limit";

    $result = $conn->query($sql);

    // 检查是否有错误
    if (!$result) {
        error_log("获取域名列表失败: " . $conn->error, 0);
        return []; // 返回空数组表示获取失败
    }

    return ['total' => $totalRecords, 'data' => $result->fetch_all(MYSQLI_ASSOC)];
}


// 添加域名
function addDomain($domain_name, $price, $platform, $description, $platform_url, $status, $order_number)
{
    global $conn;
    $sql = "INSERT INTO mb_domains (domain_name, price, platform, description, platform_url, status,order_number)
            VALUES ('$domain_name', $price, '$platform', '$description', '$platform_url', '$status', $order_number)";
    return $conn->query($sql);
}

// 更新域名
function updateDomain($domain_id, $domain_name, $price, $platform, $description, $platform_url, $status, $order_number)
{
    global $conn;

    // 使用预处理语句更新数据，避免 SQL 注入
    $stmt = $conn->prepare("UPDATE mb_domains SET domain_name=?, price=?, platform=?, description=?, platform_url=?, status=?, order_number=? WHERE id=?");
    $stmt->bind_param("sdssssii", $domain_name, $price, $platform, $description, $platform_url, $status, $order_number, $domain_id);

    // 执行预处理语句
    $result = $stmt->execute();

    // 检查是否有错误
    if (!$result) {
        error_log("更新数据失败: " . $stmt->error, 0);
        return false; // 返回 false 表示更新数据失败
    }

    $stmt->close();

    return true; // 返回 true 表示更新数据成功
}


// 删除域名
function deleteDomain($domain_id)
{
    global $conn;
    // 使用预处理语句
    $stmt = $conn->prepare("DELETE FROM mb_domains WHERE id = ?");
    $stmt->bind_param("i", $domain_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function deleteMultipleDomains($domain_ids) {
    global $conn;

    // 使用预处理语句
    $stmt = $conn->prepare("DELETE FROM mb_domains WHERE id IN (".implode(',', array_fill(0, count($domain_ids), '?')).")");

    // 绑定参数并执行删除操作
    $stmt->bind_param(str_repeat("i", count($domain_ids)), ...$domain_ids);
    $result = $stmt->execute();

    // 关闭预处理语句
    $stmt->close();

    return $result;
}


// 获取指定域名的信息
function getDomainById($domain_id)
{
    global $conn;
    // 使用预处理语句
    $stmt = $conn->prepare("SELECT * FROM mb_domains WHERE id = ?");
    $stmt->bind_param("i", $domain_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; // 返回 null 表示没有找到匹配的记录
    }
}
