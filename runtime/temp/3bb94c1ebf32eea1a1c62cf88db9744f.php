<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/member/member_list.html";i:1581824398;}*/ ?>
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
                                <div class="layui-form-mid">分类:</div>
                                <div class="layui-input-inline" style="width: 150px;">
                                    <select name="sex">
                                        <option value="0">请选择分类</option>

                                    </select>
                                </div>
                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                        <a href="<?php echo url('admin/add'); ?>" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table class="layui-table">
                            <colgroup>
                                <col width="150">
                                <col width="200">
                                <col width="200">

                                <col>
                                <col width="200">

                            </colgroup>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>用户名</th>
                                    <th>用户图片</th>
                                    <th>所属分类</th>
                                    <th>注册时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($admin) || $admin instanceof \think\Collection || $admin instanceof \think\Paginator): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['telphone']; ?></td>
                                    <td>
                                        <?php if($vo['image']): ?>
                                        <img src="/uploads/<?php echo $vo['image']; ?>" alt="" style="display: block;margin:0 auto;height: 30px;">
                                        <?php else: ?>
                                        <p class="center"> 暂无图片</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>普通会员</td>
                                    <td><?php echo date('Y-m-d h:i:s',$vo['time']); ?></td>
                                    <td>
                                            <a href="#" class="layui-btn layui-btn-xs layui-btn-blue">编辑</a>
                                            <a href="#" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>
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