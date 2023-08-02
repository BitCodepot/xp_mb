<?php
require_once 'header.php';
include_once('include/sysinfo.php');
?>
<style>
    .ss-card {
        height: 100px;
        text-align: center;
    }

    .ss-card p {
        color: #009688;
        line-height: 30px;
    }
</style>

<div class="layui-body">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>服务器概述</legend>
    </fieldset>

    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">操作系统</div>
                    <div class="layui-card-body">
                        <p><?=PHP_OS?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">

                    <div class="layui-card-header">PHP版本</div>
                    <div class="layui-card-body">
                        <p><?=PHP_VERSION?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">当前硬盘</div>
                    <div class="layui-card-body">
                        <p><?=$freedisk?>G / <?=$totaldisk?>G</p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">服务器时间</div>
                    <div class="layui-card-body">
                        <p><?=date('Y-m-d H:i:s')?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">脚本内存限制</div>
                    <div class="layui-card-body">
                        <p><?=get_cfg_var("memory_limit")?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">脚本运行超时</div>
                    <div class="layui-card-body">
                        <p><?=get_cfg_var("max_execution_time")?>秒</p>
                    </div>
                </div>
            </div>


            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">编码转换</div>
                    <div class="layui-card-body">
                        <p><?=function_exists("mb_convert_encoding")?"支持":"不支持"?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md3">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">Session 支持</div>
                    <div class="layui-card-body">
                        <p><?=function_exists("session_start")?"支持":"不支持"?></p>
                    </div>
                </div>
            </div>

            <div class="layui-col-md12">
                <div class="layui-card ss-card">
                    <div class="layui-card-header">WEB服务器信息</div>
                    <div class="layui-card-body">
                        <p><?=$websrv?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>
</div> <!-- /header -->

</body>

</html>