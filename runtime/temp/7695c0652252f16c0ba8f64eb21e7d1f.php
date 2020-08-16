<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\banner\banner_add.html";i:1547037358;}*/ ?>
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
                <div class="layui-card-header">添加轮播</div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">轮播名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">轮播地址</label>
                    <div class="layui-input-inline">
                      <input type="type" name="link"  placeholder="请输入链接地址" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">支持外链,外链需要加http://或者https://</div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">轮播图片</label>
                    <div class="layui-input-block" style="position: relative">
                        <input type='file' id='doc' name='image' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                        <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag">
                            <tr>
                                <td>
                                    <img  id="preview" alt="" src="/static/public/image/upload.png" >
                                </td>
                            </tr>
                        </table>
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">是否显示</label>
                    <div class="layui-input-block">
                      <input type="radio" name="display" value="1" title="显示" checked>
                      <input type="radio" name="display" value="0" title="隐藏">
                    </div>
                  </div>
                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">轮播描述</label>
                    <div class="layui-input-block">
                      <textarea name="description" placeholder="请输入内容" class="layui-textarea"></textarea>
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