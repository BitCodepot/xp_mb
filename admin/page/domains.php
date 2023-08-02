<?php require_once 'header.php';
?>
<!-- 内容主体区域 -->
<div class="layui-body">
    <form class="layui-form layui-form-pane" method="POST" action="javascript:;">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>域名删除后不能找回，请<b style="color:#FF5722">慎重删除</b></legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">关键字</label>
            <div class="layui-input-inline">
                <input type="text" name="searchkey" placeholder="域名或简介" autocomplete="off" class="layui-input">
            </div>
            <a class="layui-btn search-btn" style="margin-right:50px;">搜索</a>

            <button class="layui-btn newdomain-btn">新增域名</button>
        </div>

        <!-- 表格 -->
        <table class="layui-hide" id="domainlist" lay-filter="domainlist"></table>
    </form>
</div>
<?php require_once 'footer.php'; ?>
</div> <!-- /header -->
<!-- 控制部分 -->
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script type="text/html" id="toolbarDemo">
    <!-- 表头模板 -->
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="delCheckData">删除选中</button>
    </div>
</script>


<script>
    layui.use('table', function() {
        let table = layui.table;


        //头工具栏事件
        table.on('toolbar(domainlist)', function(obj) {
            let checkStatus = table.checkStatus(obj.config.id);
            let data = checkStatus.data;

            switch (obj.event) {
                case 'delCheckData':
                    layer.confirm('确定要删除选中的域名吗？', function() {
                        let ids = [];
                        $.each(data, function(index, value) {

                            ids.push(value.id);
                        })
                        console.log(ids);

                        $.ajax({
                            type: "POST",
                            url: "include/domains.php?do=deletelist",
                            data: {
                                "domain_ids": ids
                            },
                            success: function(state) {
                                layer.msg(state == 200 ? '删除成功' : '删除过程中发现错误,请检查');
                            }
                        })
                        table.reload('domainlist');
                    })
                    break;
            }
        })

        //渲染表格数据
        table.render({
            elem: '#domainlist',
            toolbar: '#toolbarDemo',
            limit: 20,
            size: 'sm', // 设置表格尺寸为小尺寸，自动适应屏幕宽度
            defaultToolbar: ['filter', 'exports', 'print'],
            url: 'include/domains.php?do=showlist',
            cols: [
                [
                    { type: 'checkbox', fixed: 'left' },
                    { title: '操作', toolbar: '#barDemo', width: 115 },
                    { field: 'domain_name', title: '域名', sort: true, width: '8%' }, // 设置宽度占比为 15%
                    { field: 'price', title: '价格', sort: true, width: '8%' }, // 设置宽度占比为 15%
                    { field: 'platform', title: '所属平台', sort: true, width: '10%' }, // 设置宽度占比为 15%
                    { field: 'description', title: '简介', sort: true, width: '30%' }, // 设置宽度占比为 30%
                    { field: 'platform_url', title: '出售地址', sort: true, width: '10%' }, // 设置宽度占比为 15%
                    { field: 'status', title: '状态', sort: true, width: '8%' }, // 设置宽度占比为 10%
                    { field: 'order_number', title: '排序', sort: true, width: '5%' }, // 设置宽度占比为 10%
                    { field: 'created_at', title: '创建时间', sort: true, width: '20%' } // 设置宽度占比为 20%
                ]
            ],
            page: true
        });

        //监听行内按钮事件
        table.on('tool(domainlist)', function(obj) {
            let data = obj.data;
            switch (obj.event) {
                case 'edit': //编辑按钮
                    layer.open({
                        type: 2,
                        title: data.id,
                        area: ['50%', '60%'],
                        content: 'include/domainedit.php?do=edit&domain_id=' + data.id
                    })
                    break;


                case 'del': //删除按钮
                    layer.confirm('删除《' + data.domain_name + '》', function(index) {
                        $.ajax({
                            type: "POST",
                            url: "include/domains.php?do=deletedomain",
                            data: {
                                "domain_id": data.id
                            },
                            success: function(state) {
                                layer.msg(state == 200 ? '删除完成' : '删除失败,请检查配置');
                                obj.del();

                            }
                        })
                        layer.close(index);
                    });
                    break;
            }
        });
    });

    $('.search-btn').on('click', function() {
        searchkey = $("input[name='searchkey']").val();
        searchkey = encodeURIComponent(searchkey);
        layui.use('table', function() {
            let table = layui.table;
            table.render({
                elem: '#domainlist',
                limit: 20,
                limit: 20,
                url: 'include/domains.php?do=showlist&searchkey=' + searchkey,
                cols: [
                    [
                        { type: 'checkbox', fixed: 'left' },
                        { title: '操作', toolbar: '#barDemo', width: 115 },
                        { field: 'domain_name', title: '域名', sort: true, width: '8%' }, // 设置宽度占比为 15%
                        { field: 'price', title: '价格', sort: true, width: '8%' }, // 设置宽度占比为 15%
                        { field: 'platform', title: '所属平台', sort: true, width: '10%' }, // 设置宽度占比为 15%
                        { field: 'description', title: '简介', sort: true, width: '30%' }, // 设置宽度占比为 30%
                        { field: 'platform_url', title: '出售地址', sort: true, width: '10%' }, // 设置宽度占比为 15%
                        { field: 'status', title: '状态', sort: true, width: '8%' }, // 设置宽度占比为 10%
                        { field: 'order_number', title: '排序', sort: true, width: '5%' }, // 设置宽度占比为 10%
                        { field: 'created_at', title: '创建时间', sort: true, width: '20%' } // 设置宽度占比为 20%
                    ]
                ],
                page: true
            });
        })
    })



    $('.newdomain-btn').on('click', function() {
        layer.open({
            type: 2,
            title: '新增小说',
            area: ['50%', '60%'],
            content: 'include/domainedit.php?do=newdomain'
        })
    })




    layui.use(['element', 'form'], function() {
        let element = layui.element;
        let form = layui.form;
        form.render();
    })
</script>

