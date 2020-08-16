<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\sys\sys.html";i:1548940153;}*/ ?>
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
                <div class="layui-card-header">配置信息修改</div>
                <form class="layui-form layui-card-body" action="">
                    <?php if(is_array($sys) || $sys instanceof \think\Collection || $sys instanceof \think\Paginator): $i = 0; $__LIST__ = $sys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type']==1): ?>
                          <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo $vo['cnname']; ?></label>
                            <div class="layui-input-block">
                              <input type="text" value="<?php echo $vo['result']; ?>" name="<?php echo $vo['enname']; ?>" placeholder="请输入标题" autocomplete="off" class="layui-input">
                            </div>
                          </div>
                        <?php elseif($vo['type']==2): ?>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><?php echo $vo['cnname']; ?></label>
                            <div class="layui-input-block">
                                <input type="radio" name="<?php echo $vo['enname']; ?>" value="1" title="显示" <?php if($vo['result']==1): ?>checked<?php endif; ?>>
                                <input type="radio" name="<?php echo $vo['enname']; ?>" value="0" title="隐藏" <?php if($vo['result']==0): ?>checked<?php endif; ?>>
                            </div>
                        </div>
                        <?php elseif($vo['type']==5): ?>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label"><?php echo $vo['cnname']; ?></label>
                            <div class="layui-input-block">
                                <textarea name="<?php echo $vo['enname']; ?>"  placeholder="请输入内容" class="layui-textarea"><?php echo $vo['result']; ?></textarea>
                            </div>
                        </div>
                        <?php elseif($vo['type']==6): ?>
                        <div class="layui-form-item">
                        <label class="layui-form-label"><?php echo $vo['cnname']; ?></label>
                        <div class="layui-input-block" style="position: relative">
                            <input type='file' id='doc' name='<?php echo $vo['enname']; ?>' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <input type="hidden" name="image[]" value="<?php echo $vo['enname']; ?>"/>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag">
                                <tr>
                                    <td>
                                        <img  id="preview" alt="" src="/static/public/image/upload.png" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>
                         <?php endif; endforeach; endif; else: echo "" ;endif; ?>

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
    <script>
      var form = layui.form
        ,layer = layui.layer;
    </script>
</body>
</html>