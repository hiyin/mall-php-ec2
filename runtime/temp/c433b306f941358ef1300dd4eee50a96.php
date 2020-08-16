<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\attr\attr_add.html";i:1554280576;}*/ ?>
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
                <div class="layui-card-header">添加属性</div>
                  <div class="layui-form-item" >
                    <label class="layui-form-label">属性名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="attrname"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                <div class="layui-form-item" >
                    <label class="layui-form-label">英文名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="attr_en_name"  placeholder="请输入英文名称" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">必填,用于商品属性区分</div>
                </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">属性值</label>
                      <div class="layui-input-block">
                          <textarea name="attrvalue" placeholder="多个参数用|分隔" class="layui-textarea"></textarea>
                      </div>
                  </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">属性分类</label>
                    <div class="layui-input-inline" >
                        <select lay-filter="first" name="cateid">
                            <option value="0"></option>
                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['catename']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
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