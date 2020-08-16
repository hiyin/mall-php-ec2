<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\sys\sys_list.html";i:1548943462;}*/ ?>
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
    </style>
</head>
<body class="layui-view-body">
    <div class="layui-content">
        <form action="" method="post">
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
                        <a href="<?php echo url('sys/add'); ?>" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="200">
                                <col width="200">
                                <col width="200">
                                <col>
                                <col width="85">
                                <col width="120">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>英文名称</th>
                                    <th>中文名称</th>
                                    <th>系统类型</th>
                                    <th>系统值</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($sys) || $sys instanceof \think\Collection || $sys instanceof \think\Paginator): $i = 0; $__LIST__ = $sys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['enname']; ?></td>
                                    <td>
                                        <?php echo $vo['cnname']; ?>
                                    </td>
                                    <td>
                                        <?php if($vo['type']==1): ?>
                                            单行文本
                                        <?php elseif($vo['type']==2): ?>
                                            单选类型
                                        <?php elseif($vo['type']==3): ?>
                                            多选类型
                                        <?php elseif($vo['type']==4): ?>
                                            下拉类型
                                        <?php else: ?>
                                            多行文本
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $vo['value']; ?>
                                    </td>
                                    <th>
                                        <input type="text" class="sortInpug" name="sort[<?php echo $vo['id']; ?>]" value="<?php echo $vo['sort']; ?>"/> </th>
                                    <td>
                                            <a href="<?php echo url('cate/edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                            <a href="#" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><button href="" class="layui-btn layui-btn-xs layui-btn-blue"  lay-submit style="width: 52px;">排序</></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="/static/layui/layui.all.js"></script>
    <script>
  var element = layui.element;
  var table = layui.table;
  var form = layui.form;

    </script>
</body>
</html>