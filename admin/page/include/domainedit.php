<?php
require_once("../../config/database.php");

// 如果没有匹配的记录，可以执行一些错误处理逻辑
// 例如，可以将域名ID设置为默认值，显示错误提示等

$domain_id = 0;
$domain_name = "";
$price = 0.00;
$platform = "";
$description = "";
$platform_url = "";
$status = "";
$order_number = 0;


if (isset($_REQUEST['domain_id'])) {
    $domain_id = $_REQUEST['domain_id'];

    // 使用预处理语句查询数据，防止 SQL 注入
    $stmt = $conn->prepare("SELECT * FROM mb_domains WHERE id = ?");
    $stmt->bind_param("i", $domain_id);
    $stmt->execute();

    $result = $stmt->get_result();


    // 检查是否有匹配的记录
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $domain_name = $row['domain_name'];
        $price = $row['price'];
        $platform = $row['platform'];
        $description = $row['description'];
        $platform_url = $row['platform_url'];
        $status = $row['status'];
        $order_number = $row['order_number'];
    }

    $stmt->close();
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>新增域名</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <style>
        .readonly {
            color: gray;
            font-style: italic;
        }
    </style>
</head>

<body>

<form class="layui-form layui-form-pane" action="javascript:;" style="margin-top: 20px;">
    <div class="layui-form-item" style="margin-right:15px;">
        <label class="layui-form-label">域名</label>
        <div class="layui-input-block">
            <input type="text" name="domain_name" value="<?= $domain_name ?>" lay-verify="required" autocomplete="off"
                   class="layui-input">
        </div>
    </div>

    <div class="layui-form-item" style="margin-right:15px;">
        <label class="layui-form-label">价格</label>
        <div class="layui-input-block">
            <input type="number" name="price" value="<?= $price ?>" class="layui-input" lay-verify="required">
        </div>
    </div>
    <div class="layui-form-item" style="margin-right:15px;">
        <label class="layui-form-label">所属平台</label>
        <div class="layui-input-block">
            <input type="text" name="platform" value="<?= $platform ?>" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item" style="margin-right:15px">
        <label class="layui-form-label">出售地址</label>
        <div class="layui-input-block">
            <input type="text" name="platform_url" value="<?= $platform_url ?>" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item" style="margin-right:15px">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="number" name="order_number" value="<?= $order_number ?>" autocomplete="off"
                   class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">越大越靠前</div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">选择框</label>
        <div class="layui-input-block">
            <select name="status" lay-verify="required">
                <option value="available" <?php if ($status == 'available') echo ' selected'; ?>>可用</option>
                <option value="sold" <?php if ($status == 'sold') echo ' selected'; ?>>已售</option>
                <option value="reserved" <?php if ($status == 'reserved') echo ' selected'; ?>>保留</option>
            </select>
        </div>
    </div>


    <div class="layui-form-item layui-form-text" style="margin-right:15px;">
        <label class="layui-form-label">内容简介</label>
        <div class="layui-input-block">
            <textarea class="layui-textarea" name="description" style="height: 150px;"><?= $description ?></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <button class="layui-btn" id="<?= $_REQUEST['do'] ?>">保 存</button>
    </div>
</form>

<link rel="stylesheet" href="//unpkg.com/layui@2.6.8/dist/css/layui.css"/>
<script src="//unpkg.com/layui@2.6.8/dist/layui.js"></script>
<script src="//cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
<script>



    //新增
    $('#newdomain').on('click', function () {
        if(validateForm()){
            $.ajax({
                type: "POST",
                url: "domains.php?do=newdomain",
                data: {
                    "domain_name": $('input[name="domain_name"]').val() || '',
                    "price": $('input[name="price"]').val() || '',
                    "platform": $('input[name="platform"]').val() || '',
                    "platform_url": $('input[name="platform_url"]').val() || '',
                    "order_number": $('input[name="order_number"]').val() || '',
                    "status": $('select[name="status"]').val() || '',
                    "description": $('textarea[name="description"]').val() || ''
                },
                async: true,
                success: function (state) {
                    layer.msg(state == 200 ? "保存完成" : "新增失败,请检查配置", function () {
                        let index=parent.layer.getFrameIndex(window.name); //关闭当前窗口
                        parent.layer.close(index);
                    });
                }
            })
        }
    })

    //编辑
    $('#edit').on('click', function () {
        if(validateForm()){
            $.ajax({
                type: "POST",
                url: "domains.php?do=updatedomain",
                data: {
                    "id": <?= $domain_id?>,
                    "domain_name": $('input[name="domain_name"]').val() || '',
                    "price": $('input[name="price"]').val() || '',
                    "platform": $('input[name="platform"]').val() || '',
                    "platform_url": $('input[name="platform_url"]').val() || '',
                    "order_number": $('input[name="order_number"]').val() || '',
                    "status": $('select[name="status"]').val() || '',
                    "description": $('textarea[name="description"]').val() || ''
                },
                async: true,
                success: function (state) {
                    layer.msg(state == 200 ? "保存完成" : "新增失败,请检查配置", function () {
                        let index=parent.layer.getFrameIndex(window.name); //关闭当前窗口
                        parent.layer.close(index);
                    });
                }
            })
        }
    })

    // 表单验证
    function validateForm() {
        var domainName = $('input[name="domain_name"]').val().trim();
        var price = $('input[name="price"]').val().trim();

        if (domainName === '') {
            layer.msg("域名不能为空");
            return false;
        }

        if (price === '') {
            layer.msg("价格不能为空");
            return false;
        }

        return true;
    }


    layui.use(['element', 'form'], function() {
        let element = layui.element;
        let form = layui.form;
        form.render();
    })
    </script>