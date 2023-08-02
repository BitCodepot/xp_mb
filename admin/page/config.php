

<!-- 配置项列表 -->
<table class="layui-table">
    <colgroup>
        <col width="150">
        <col width="150">
        <col width="300">
        <!-- 更多列可在此添加 -->
    </colgroup>
    <thead>
    <tr>
        <th>ID</th>
        <th>参数名称</th>
        <th>参数键值</th>
        <!-- 更多表头可在此添加 -->
    </tr>
    </thead>
    <tbody>
    <!-- 使用PHP获取配置项数据并在此展示 -->
    <?php
    include 'app/config.php';
    $configs = getAllConfigs();
    foreach ($configs as $config) {
        echo "<tr>";
        echo "<td>" . $config['config_id'] . "</td>";
        echo "<td>" . $config['config_name'] . "</td>";
        echo "<td>" . $config['config_value'] . "</td>";
        // 更多单元格可在此添加
        echo "</tr>";
    }
    ?>
    </tbody>
</table>