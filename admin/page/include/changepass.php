<?php
require_once '../../config/database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin123') {
    header("Location: ../../login.php");
    exit;
}

function changePassword($newPassword)
{
    global $conn;
    // 使用预处理语句更新密码
    $stmt = $conn->prepare("UPDATE mb_config SET config_value = ? WHERE config_key = 'password'");
    $stmt->bind_param("s", $newPassword);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_REQUEST['oldpassword'];
    $newPassword = $_REQUEST['password'];
    $rePassword = $_REQUEST['repassword'];

    if ($newPassword !== $rePassword) {
        echo '500'; // 密码不一致
        exit;
    }

    // 这里可以添加更多密码复杂性校验，比如长度等

    // 判断旧密码是否正确
    $sql_password = getConfigValueByKey('password');
    if ($sql_password === $oldPassword) {
        // 旧密码正确，修改密码
        if (changePassword($newPassword)) {
            echo '200'; // 密码修改成功
            session_destroy();
            exit;
        } else {
            echo '500'; // 密码修改失败
            exit;
        }
    } else {
        echo '501'; // 旧密码错误
        exit;
    }
}

function getConfigValueByKey($key)
{
    global $conn;
    $sql = "SELECT * FROM mb_config WHERE config_key = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['config_value'];
    } else {
        return null; // 返回 null 表示没有找到匹配的记录
    }
}
?>
