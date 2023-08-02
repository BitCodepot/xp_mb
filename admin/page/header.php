<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
if(session_status()!==PHP_SESSION_ACTIVE)session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}else{
    if($_SESSION['username']!='admin123') {
        header("Location: ../login.php");
        exit;
    }
}
$admin_url=explode('/',$_SERVER['REQUEST_URI'])[1].'/page';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <!-- 引入layui样式文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/layui/2.5.7/css/layui.min.css">
    <script src="https://cdn.staticfile.org/layui/2.5.7/layui.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

    <div class="layui-header">
        <div class="layui-logo">
            咪表后台 <span class="layui-badge">1.0</span>
        </div>
        <ul class="layui-nav layui-layout-left">
<!--            <li class="layui-nav-item"><a target="_blank" href="--><?php //=$ShipSayVersion['Site']?><!--"><i class="layui-icon layui-icon-home"></i> --><?php //=$ShipSayVersion['Site']?><!--</a></li>-->
<!--            <li class="layui-nav-item"><a target="_blank" href="--><?php //=$ShipSayVersion['QQ']['url']?><!--">QQ群: --><?php //=$ShipSayVersion['QQ']['group']?><!--</a></li>-->
            <li class="layui-nav-item"><a href="http://sen.ge/">反馈博客:<b class="layui-bg-red" style="padding:0 5px;margin-right:5px;">Sen.ge</b></a></li>
        </ul>

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><?=$_SESSION['username']?></li>
     <li class="layui-nav-item"><a href="javascript:changepass();">改密</a></li>
     <li class="layui-nav-item"><a href="/<?=$admin_url?>/logout.php">退出</a></li>
            <li class="layui-nav-item"><a href="/" target="_blank">网站首页</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item"><a href="/<?=$admin_url?>/main.php"><i class="layui-icon layui-icon-home"></i> 概述</a></li>
                <li class="layui-nav-item"><a href="/<?=$admin_url?>/base/"><i class="layui-icon layui-icon-set"></i> 参数设置</a></li>
                <li class="layui-nav-item"><a href="/<?=$admin_url?>/domains.php"><i class="layui-icon layui-icon-read"></i> 域名管理</a></li>
            </ul>
        </div>
    </div>

    <script>
        // 正确示例：changepass 函数定义在全局范围内，可以在页面其他部分访问
        function changepass(){
            layui.use(['layer'], function() {
                layer.open({
                    type: 2,
                    title: '修改 <?=$_SESSION['username']?> 密码',
                    area: ['50%', ],
                    content: '/<?=$admin_url?>/include/tpl_changepass.php',
                    success: function(layero, index) {
                        //找到当前弹出层的iframe元素
                        var iframe = layui.$(layero).find('iframe');
                        //设定iframe的高度为当前iframe内body的高度
                        iframe.css('height', iframe[0].contentDocument.body.offsetHeight);
                        //重新调整弹出层的位置，保证弹出层在当前屏幕的中间位置
                        $(layero).css('top', (window.innerHeight - iframe[0].offsetHeight) / 2);
                    }
                });
            });
        }
    </script>