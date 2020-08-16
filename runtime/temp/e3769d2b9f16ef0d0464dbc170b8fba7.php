<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\attr\attr_list.html";i:1554258964;}*/ ?>
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
    </style>
</head>
<body class="layui-view-body">
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

                                <!--<div class="layui-form-mid">性别:</div>-->
                                <!--<div class="layui-input-inline" style="width: 100px;">-->
                                    <!--<select name="sex">-->
                                        <!--<option value="1">男</option>-->
                                        <!--<option value="2">女</option>-->
                                    <!--</select>     -->
                                <!--</div>-->
                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                        <a class="layui-btn layui-btn-blue" href="<?php echo url('Attr/add'); ?>"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="100">
                                <col width="200">
                                <col>
                                <col width="200">
                                <col width="200">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><p class="center">id</p></th>
                                    <th>属性名称</th>
                                    <th>属性值</th>
                                    <th>所属分类</th>


                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($attr) || $attr instanceof \think\Collection || $attr instanceof \think\Paginator): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><p class="center"><?php echo $vo['id']; ?></p></td>
                                    <td><?php echo $vo['attrname']; ?></td>

                                    <td><?php echo $vo['attrvalue']; ?></td>
                                    <td><?php echo $vo['catename']; ?></td>

                                    <td>
                                            <a href="<?php echo url('attr/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                            <a href="<?php echo url('attr/del',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>

                        </table>
                        <?php echo $attr->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/layui/layui.all.js"></script>
    <script>
  var element = layui.element;
  var table = layui.table;
  var form = layui.form;
  

    </script>
</body>
</html>