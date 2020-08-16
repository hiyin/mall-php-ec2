<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\cate\cate_edit.html";i:1574132148;}*/ ?>
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
<form action="" method="post" class="layui-form" enctype="multipart/form-data">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">添加产品分类</div>
                <form class="layui-form layui-card-body" action="">
                  <div class="layui-form-item">
                    <label class="layui-form-label">分类名称</label>
                    <div class="layui-input-block">
                      <input type="text" value="<?php echo $currentCate['catename']; ?>" name="catename" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">分类图片</label>
                        <div class="layui-input-block" style="position: relative">
                            <input type='file' id='doc' name='image' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag">
                                <tr>
                                    <td>
                                        <?php if($currentCate['image']): ?>
                                        <img  id="preview" style="width: 100px;" alt="" src="/uploads/<?php echo $currentCate['image']; ?>" >
                                        <?php else: ?>
                                        <img  id="preview" alt="" src="/static/public/image/upload.png" >
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">首页推荐</label>
                        <div class="layui-input-block">
                            <input type="radio" name="recommend" <?php if($currentCate['recommend']==1): ?>checked<?php endif; ?>
                                   value="1" title="推荐"  lay-filter="cateType">
                            <input type="radio" name="recommend" <?php if($currentCate['recommend']==0): ?>checked<?php endif; ?>
                                   value="0" title="不推荐" lay-filter="cateType">
                        </div>
                    </div>
                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">分类描述</label>
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
                </form>
            </div>
        </div>
    </div>
</form>
    <script src="/static/layui/layui.all.js"></script>
    <script src="/static/public/js/jquery.js"></script>
    <script src="/static/public/js/upload.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script>
        layui.use('form', function(){
            var form = layui.form
            form.on('radio(cateType)', function(data){
                if(data.value==3)
                {
                    $("#Page").show();
                } else
                {
                    $("#Page").hide();
                }
                if(data.value==4){
                    $("#cateUrl").show()
                }else{
                    $("#cateUrl").hide()
                }
            });
        });
        var ue = UE.getEditor('editor');
        ue.ready(function() {
            ue.setHeight(550);
        });
    </script>
</body>
</html>
