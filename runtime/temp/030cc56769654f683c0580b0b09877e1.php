<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpStudy\WWW\mall\public/../application/admin\view\authrule\auth_rule_list.html";i:1554195173;}*/ ?>
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
</head>
<body class="layui-view-body">
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
                        <a href="<?php echo url('authrule/add'); ?>" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="300">


                                <col>
                                <col width="115">

                            </colgroup>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>规则名称</th>
                                    <th>控制器名称</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($catetree) || $catetree instanceof \think\Collection || $catetree instanceof \think\Paginator): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php if($vo['level']!=0): ?>|<?php endif; ?><?php echo str_repeat('--',$vo['level'])?><?php echo $vo['title']; ?></td>
                                    <td>
                                        <?php echo $vo['name']; ?>
                                    </td>

                                    <td>

                                        <a href="<?php echo url('Authrule/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                        <?php if($vo['level']!=0): ?>
                                        <a href="<?php echo url('Authrule/del',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
                                        <?php endif; ?>
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
    <script src="/static/layui/layui.all.js"></script>
    <script>
  var element = layui.element;
  var table = layui.table;
  var form = layui.form;

    </script>
</body>
</html>