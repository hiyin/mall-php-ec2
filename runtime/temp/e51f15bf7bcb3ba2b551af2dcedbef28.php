<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/search/search_list.html";i:1574305580;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>

    <title>管理后台</title>
    <style>
        .pagination{padding:10px 0 20px;}
        .pagination li{float:left;padding: 0 12px;}
        .pagination li.active{background-color:#177ce3;border-radius: 2px;}
        .pagination li a,.pagination li span{font-size:14px;color:#333;}
        .pagination li.active span{ color:#fff;}
        .pagination li a:hover{color:#177ce3;}
        .pagination li.disabled span{color:#999;}
        p.center{text-align: center}
        .layui-table img{
            max-width:none;}
    </style>
</head>
<body class="layui-view-body">
<form action="" class="layui-form">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <div class="layui-form layui-form-item">
                            <div class="layui-inline">
                                <div class="layui-form-mid">轮播名称:</div>
                                <div class="layui-input-inline" style="width: 200px;">
                                  <input type="text" autocomplete="off" class="layui-input">
                                </div>

                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                        <a class="layui-btn layui-btn-blue" href="<?php echo url('Search/add'); ?>"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="100">


                                <col>
                                <col width="200">
                                <col width="200">
                                <col width="200">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><p class="center">id</p></th>
                                    <th>关键字</th>
                                    <th>排序</th>
                                    <th>显示状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($search) || $search instanceof \think\Collection || $search instanceof \think\Paginator): $i = 0; $__LIST__ = $search;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><p class="center"><?php echo $vo['id']; ?></p></td>
                                    <td><?php echo $vo['keyword']; ?></td>

                                    <td><?php echo $vo['sort']; ?></td>
                                    <td>
                                        <input type="checkbox" id="<?php echo $vo['id']; ?>" name="close" lay-skin="switch" lay-text="显示|隐藏" <?php if($vo['display']==1): ?>checked=""<?php endif; ?>>
                                    </td>
                                    <td>
                                        <a href="<?php echo url('Search/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                        <a href="<?php echo url('Search/del',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script src="/static/layui/layui.all.js"></script>
<script src="/static/public/js/jquery.js"></script>
<script>
    var element = layui.element;
    var table = layui.table;
    var form = layui.form;
    form.on('switch()', function(data){
        var id=data.elem.id;
        var recommend;
        if(data.elem.checked){
            recommend=1;
        }else{
            recommend=0;
        }
        $.ajax({
            url: '<?php echo url("floor/recommend"); ?>',
            data:{
                recommend:recommend,
                id:id
            },//发送请求数据
            type: "POST",
            dataType: "json",//[重要]数据类型,一般为json格式,有些时候可以为html/text
            success: function(result){
                //成功处理函数,result为返回结果[重要]
                console.log(result)
            },

        });

    });

</script>
</body>
</html>
