<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\mall\public/../application/admin\view\link\link_add.html";i:1585811482;}*/ ?>
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
                <div class="layui-card-header">配置路由信息</div>
                <div class="layui-form-item">
                    <label class="layui-form-label">路由名称</label>
                    <div class="layui-input-inline">
                        <input type="type" name="title"  placeholder="请输入路由名称" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">路由名称会在选择路由中体现</div>
                </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">路由地址</label>
                    <div class="layui-input-inline">
                      <input type="type" name="router"  placeholder="请输入路由地址" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">路由地址路径需要和前端相同</div>
                  </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">是否显示</label>
                        <div class="layui-input-block">
                            <input type="radio" name="type" value="1" title="弹窗" checked>
                            <input type="radio" name="type" value="2" title="表单">
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
