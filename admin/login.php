<?php
require_once 'config/database.php';
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 处理登录表单提交
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 进行用户凭据验证，此处省略数据库查询过程
    // 假设用户名为"admin"，密码为"password"
    $sql_username = getConfigValueByKey('admin_name');
    $sql_password = getConfigValueByKey('password');

    if ($username === $sql_username && $password === $sql_password) {
        // 登录成功，设置会话数据
        $_SESSION['username'] = $username; // 假设1为用户ID
        header("Location: index.php"); // 重定向到后台首页或其他受保护的页面
        exit;
    } else {
        // 登录失败，显示错误信息
        echo "<script>alert('用户名或密码错误！');history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/layui/2.5.7/css/layui.min.css">
    <script src="https://cdn.staticfile.org/layui/2.5.7/layui.min.js"></script>

    <style>
        .login-form-container {
            border: 1px solid #e6e6e6; /* 添加边框样式 */
            padding: 20px; /* 添加内边距 */
            margin: 200px auto;
            max-width: 400px; /* 设置最大宽度 */
        }
        .message {
            margin: 10px -40px;
            padding: 18px 10px 18px 90px;
            background: #189F92;
            position: relative;
            color: #fff;
            font-size: 16px;
            margin-bottom: 20px;
        }
        /* 添加版权信息的样式 */
        .copyright {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
        <div class="login-form-container">
            <div class="message">登录</div>
            <form class="layui-form" method="post"> <!-- 替换为实际的登录处理页面路径 -->
                <div class="layui-form-item">
                    <label class="layui-form-label">用户名</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" type="submit">登录</button>
                    </div>
                </div>

            </form>
            <!-- 版权信息 -->
            <div class="copyright">
                <a href="http://sen.ge/">&copy; Sen.ge</a>
            </div>

    </div>
</body>
</html>
