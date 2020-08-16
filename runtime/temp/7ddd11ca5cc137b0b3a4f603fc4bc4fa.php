<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\phpStudy\WWW\mall\public/../application/admin\view\banner\banner_add.html";i:1585903011;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">

    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <title></title>
</head>
<body class="layui-view-body">
    <form class="layui-form" action="" method="post" enctype="multipart/form-data">
        <div class="layui-content" >

            <div class="layui-card">
                <div class="layui-card-header">添加轮播</div>
                <div class="”layui-form-ul" style="padding:20px 0;width: 800px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">轮播名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">轮播图片</label>
                      <div class="layui-input-block" style="position: relative">
                          <input type='file' class='doc' name='image' onchange="imgChange(this,0)" style='opacity:0;width:100px;height: 100px;position: absolute;'>
                          <table style="width:102px;height:102px;border:1px solid #e6e6e6" class="localImag">
                              <tr>
                                  <td>
                                      <img  class="preview" alt="" src="/static/public/image/upload.png" >
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">链接类型</label>
                    <div class="layui-input-inline">
                        <select name="link_type" lay-filter="sfilter">
                            <option value="0"></option>
                            <?php if(is_array($link) || $link instanceof \think\Collection || $link instanceof \think\Paginator): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" url="<?php echo $vo['router']; ?>" type="<?php echo $vo['type']; ?>"><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>

                    </div>
                    <div class="layui-input-inline selectShop" style="display: none;">
                        <button data-method="setTop" class="layui-btn layui-btn-blue " type="button" style="margin-bottom:0;">选择商品</button>
                    </div>

                </div>
                <div class="layui-form-item urlAddress" style="display: none;">
                    <label class="layui-form-label">链接地址</label>
                    <div class="layui-input-block">
                        <input type="type" name="link2"  placeholder="请输入链接地址" autocomplete="off" class="layui-input inputUrl">
                    </div>
                    <div style="margin-left:110px;" class="layui-form-mid layui-word-aux">地址手动拼接，如需传递其他参数在后面拼接如:/pages/webview/webview?url=http://www.intewl.com</div>
                </div>
                <div class="layui-form-item type1Address" style="display: none;">
                    <label class="layui-form-label">链接地址</label>
                    <div class="layui-input-block">
                        <input type="type" name="link1"  placeholder="请输入链接地址" autocomplete="off" class="layui-input selectShopUrl">
                    </div>
                    <div style="margin-left:110px;" class="layui-form-mid layui-word-aux">地址自动拼接,如需传递其他参数在后面拼接如:/pages/detail/detail?id=38&title=1</div>
                </div>
                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">轮播描述</label>
                    <div class="layui-input-block">
                      <textarea name="description" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                  </div>

                  <div class="layui-form-item"  >
                    <div class="layui-input-block" >
                      <button class="layui-btn layui-btn-blue" lay-submit lay-filter="formDemo">立即提交</button>
                      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
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
    </script>
    <script src="/static/public/js/selectShop.js"></script>
</body>
</html>
