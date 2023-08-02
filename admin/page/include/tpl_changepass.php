<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdn.staticfile.org/layui/2.5.7/css/layui.min.css">
    <script src="https://cdn.staticfile.org/layui/2.5.7/layui.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
<form id="changePasswordForm" class="layui-form" >
    <div class="layui-form-item">
        <label class="layui-form-label">旧密码</label>
        <div class="layui-input-block">
            <input type="password" name="oldpassword" lay-verify="required" placeholder="请输入旧密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
            <input type="password" name="password" lay-verify="required" placeholder="请输入新密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">重复密码</label>
        <div class="layui-input-block">
            <input type="password" name="repassword" lay-verify="required" placeholder="请再次输入新密码" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id="btn-submit" class="layui-btn" type="button">修改密码</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#btn-submit').on('click', function(){
            let password = $('input[name="password"]').val();
            let repassword = $('input[name="repassword"]').val();

            // 密码复杂度验证
            let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert('密码必须包含字母和数字，且长度至少为8位');
                return false;
            }

            if (password !== repassword) {
                alert('两次输入的密码不一致');
                return false;
            }

            // 使用 JavaScript 发送异步请求，提交表单数据
            $.ajax({
                type: 'POST',
                url: "changepass.php",
                data: $("#changePasswordForm").serialize(),
                success: function(state) {
                    if(state == 200){
                        alert('修改完成')
                        //关闭当前frame
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    }else if(state == 501) {
                        alert('旧密码错误')
                    }else{
                        alert('修改失败')
                    }

                }
            });
        });

        layui.use(['element','form'], function(){
            let element = layui.element;
            let form = layui.form;
            form.render();
        });
    });
</script>

</body>
</html>
