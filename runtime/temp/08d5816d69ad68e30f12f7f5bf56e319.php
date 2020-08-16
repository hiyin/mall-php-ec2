<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW\mall\public/../application/admin\view\cate\cate_list.html";i:1574132567;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="icon" href="/favicon.ico">
    <title>管理后台</title>
    <style>
        .sortInpug{
            border:1px solid #e5e5e5;line-height:30px;padding-left:0;width: 50px;text-align: center
        }
        .layui-table img{
            width:100px;}
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
                                <div class="layui-form-mid">用户名:</div>
                                <div class="layui-input-inline" style="width: 200px;">
                                  <input type="text" autocomplete="off" class="layui-input">
                                </div>

                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                        <a href="<?php echo url('cate/add'); ?>" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="200">
                                <col width="200">
                                <col>
                                <col width="150">
                                <col width="150">
                                <col width="200">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>分类名称</th>
                                    <th>分类图片</th>
                                    <th>分类描述</th>
                                    <th>是否推荐</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($catetree) || $catetree instanceof \think\Collection || $catetree instanceof \think\Paginator): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $vo['catename']; ?></td>
                                    <td>
                                        <?php if($vo['image']): ?>
                                        <img src="/uploads/<?php echo $vo['image']; ?>" alt="" style="display: block;margin:0 auto;">
                                        <?php else: ?>
                                        <p class="center"> 暂无图片</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $vo['description']; ?></td>

                                    <td>
                                        <input type="checkbox" lay-filter="recommend" name="close" lay-skin="switch"
                                               id="<?php echo $vo['id']; ?>"
                                               lay-text="是|否" <?php if($vo['recommend']==1): ?>checked=""<?php endif; ?>>
                                    </td>
                                    <td><input type="text" class="sortInpug" value="<?php echo $vo['sort']; ?>"></td>
                                    <td>
                                         <a href="<?php echo url('cate/cateContent',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">内容</a>
                                            <a href="<?php echo url('cate/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                            <a href="<?php echo url('cate/del',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
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
                url: '<?php echo url("cate/recommend"); ?>',
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
