<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW\mall\public/../application/admin\view\iconlist\icon_edit.html";i:1585905522;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <style>
        .layui-form-item{
            width: 95%;margin:15px auto 0px;}
        .layui-btn{margin-bottom:25px;}
    </style>
    <title></title>
</head>
<body class="layui-view-body">
    <form class="layui-form" action="" method="post" enctype="multipart/form-data">
        <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">添加图标</div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">图标名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="title" value="<?php echo $iconEdit['title']; ?>" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">图标类型</label>
                    <div class="layui-input-block" style="position: relative">
                        <input type='file' id='doc' name='image' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                        <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag">
                            <tr>
                                <td>
                                    <?php if($iconEdit['image']): ?>
                                    <img  id="preview" alt="" src="/uploads/<?php echo $iconEdit['image']; ?>" style="width: 100px;">
                                    <?php else: ?>
                                    <img  id="preview" alt="" src="/static/public/image/upload.png" >
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                  </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接类型</label>
                    <div class="layui-input-inline">
                        <select name="link_type" lay-filter="sfilter">
                            <option value=""></option>
                            <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option <?php if($vo['id']==$iconEdit['link_type']): ?>selected<?php endif; ?> value="<?php echo $vo['id']; ?>" url="<?php echo $vo['router']; ?>" type="<?php echo $vo['type']; ?>"><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>

                    </div>
                    <div class="layui-input-inline selectShop" <?php if($iconEdit['type']==1): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                    <button data-method="setTop" class="layui-btn layui-btn-blue " type="button" style="margin-bottom:0;">选择商品</button>
                     </div>

                </div>
            <div class="layui-form-item urlAddress" <?php if($iconEdit['type']==2): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
            <label class="layui-form-label">链接地址</label>
            <div class="layui-input-block">
                <input type="type" name="link2" value="<?php echo $iconEdit['link']; ?>"  placeholder="请输入链接地址" autocomplete="off" class="layui-input inputUrl">
            </div>
            <div style="margin-left:110px;" class="layui-form-mid layui-word-aux">地址手动拼接，如需传递其他参数在后面拼接如:/pages/webview/webview?url=http://www.intewl.com</div>
        </div>
            <div class="layui-form-item type1Address" <?php if($iconEdit['type']==1): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
            <label class="layui-form-label">链接地址</label>
            <div class="layui-input-block">
                <input type="type" value="<?php echo $iconEdit['link']; ?>" name="link1"  placeholder="请输入链接地址" autocomplete="off" class="layui-input selectShopUrl">
            </div>
            <div style="margin-left:110px;" class="layui-form-mid layui-word-aux">地址自动拼接,如需传递其他参数在后面拼接如:/pages/detail/detail?id=38&title=1</div>
        </div>
                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">图标描述</label>
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
        var shopurl="<?php echo url('Product/selectShop'); ?>";
        var router="<?php echo $iconEdit['router']; ?>"
    </script>
    <script src="/static/public/js/selectShop.js"></script>
</body>
</html>
