<?php
//error_reporting(0);
require_once '../header.php';
require_once '../include/config.php';
?>


<div class="layui-body">
    <!-- 内容主体区域 -->
    <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief" style="margin-top: 6px;">

        <div class="layui-tab-content" style="height: 100px;">
            <div class="layui-tab-item layui-show"><?php require_once 'cfg_main.php' ?></div>

        </div>
    </div>
    <!-- /内容主体区域 -->
</div>
<div class="layui-footer">
    <button class="layui-btn save-btn-base">保存设置</button><span class="layui-word-aux">所有设置均为英文半角</span>
    <span class="layui-layout-right layui-word-aux" style="margin-right: 10px;">&copy; Sen</span>
</div>
</div>


<script>
    $('.save-btn-base').on('click', function() {
        $.ajax({
            type: "post",
            url: "/<?=$admin_url?>/savecfgs.php",
            data: {
                "do": "base",
                "sitename": $("input[name='sitename']").val(),
                "info_1": $("textarea[name='info_1']").val(),
                "info_2": $("textarea[name='info_2']").val(),
                "info_3": $("textarea[name='info_3']").val(),
            },
            async: true,
            success: function(state) {
                layer.msg(state == 200 ? '保存成功' : '保存失败,请检查配置(base)');
            },

        })
    })

    layui.use(['element', 'form'], function() {
        let element = layui.element;
        let form = layui.form;
        form.render();
    })
</script>


</body>

</html>