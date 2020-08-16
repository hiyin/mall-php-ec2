<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\search\search_edit.html";i:1574300957;}*/ ?>
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
                <div class="layui-card-header">热门搜索</div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">关键字</label>
                    <div class="layui-input-block">
                      <input type="text" name="keyword" value="<?php echo $search['keyword']; ?>" placeholder="请输入关键字" autocomplete="off" class="layui-input">
                    </div>
                  </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示</label>
                    <div class="layui-input-block">
                        <input type="radio" name="display" value="1" title="显示" <?php if($search['display']==1): ?>checked<?php endif; ?>>
                        <input type="radio" name="display" value="0" title="隐藏" <?php if($search['display']==0): ?>checked<?php endif; ?>>
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
