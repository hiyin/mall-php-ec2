<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/order/deliver.html";i:1585210892;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/view.css"/>
    <title></title>
</head>
<body class="layui-view-body">
    <form class="layui-form" action="" method="post" enctype="multipart/form-data">
        <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">添加物流</div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">物流名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="name"  value="<?php echo $logisitcs['logistics']; ?>" autocomplete="off" class="layui-input" disabled>
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">物流单号</label>
                    <div class="layui-input-inline">
                      <input type="type" name="logisitcs"  placeholder="请输入物流单号" autocomplete="off" class="layui-input">
                    </div>

                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" lay-submit lay-filter="formDemo">立即提交</button>
                      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    </form>
    <script src="/static/layui/layui.all.js"></script>
    <script src="/static/public/js/jquery.js"></script>
    <script src="/static/public/js/upload.js"></script>
    <script>
      var form = layui.form
        ,layer = layui.layer;
    </script>
</body>
</html>
