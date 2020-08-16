<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\phpStudy\WWW\mall\public/../application/admin\view\cate\cate_content.html";i:1574156207;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/view.css"/>
    <title></title>
    <style>
        .layui-quote-nm{margin: 30px;}
        .addBtn{float:right;margin:0;}
        .layui-card{padding-bottom:20px;}
        .layui-content{padding-bottom:0;}
        .layui-card-header{
            display: flex;align-items: center}
        .layui-card-header .layui-btn-xs{margin-top:25px;margin-left:20px;}
    </style>
</head>
<body class="layui-view-body">
<form action="" method="post" class="layui-form" enctype="multipart/form-data">
    <div class="layui-content-list">
        <?php if(count($catecontent)==0): ?>
        <div class="layui-content">
            <div class="layui-row">
                <div class="layui-card">
                    <div class="layui-card-header">添加产品分类
                        <div class="layui-btn layui-btn-blue  layui-btn-xs" onclick="addContent()">添加内容</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">内容名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="title[]" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">内容图片</label>
                        <div class="layui-input-block" style="position: relative">
                            <input type='file' class='doc' onchange="imgChange(this,0)" name='image[]' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" class="localImag">
                                <tr>
                                    <td>
                                        <img  class="preview" alt="" src="/static/public/image/upload.png" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">url地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="url[]" placeholder="请输入url地址"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name[]" placeholder="请输入商品名称"

                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="summary[]" placeholder="请输入商品描述"

                                   autocomplete="off" class="layui-input">

                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">商品价格</label>
                        <div class="layui-input-block">
                            <input type="text" name="price[]" placeholder="请输入商品价格"

                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">背景颜色</label>
                        <div class="layui-input-block">
                            <input type="text" name="bg[]" placeholder="请填写背景颜色值"

                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: if(is_array($catecontent) || $catecontent instanceof \think\Collection || $catecontent instanceof \think\Paginator): $i = 0; $__LIST__ = $catecontent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="layui-content" >
                    <div class="layui-row">
                        <div class="layui-card">
                            <div class="layui-card-header">添加产品分类
                                <div class="layui-btn layui-btn-blue  layui-btn-xs" onclick="addContent()">添加内容</div>
                                <?php if($key!=0): ?>
                                <div class="layui-btn layui-btn-blue  layui-btn-xs" onclick="delContent(<?php echo $key; ?>)">删除内容</div>
                                <?php endif; ?>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">内容名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title[]" placeholder="请输入标题"
                                           value="<?php echo $vo['title']; ?>"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">内容图片</label>
                                <div class="layui-input-block" style="position: relative">
                                    <input type='file' class='doc' onchange="imgChange(this,0)" name='image[]' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                                    <table style="width:102px;height:102px;border:1px solid #e6e6e6" class="localImag">
                                        <tr>
                                            <td>
                                                <?php if($vo['img']): ?>
                                                <img  class="preview" alt="" src="/uploads/<?php echo $vo['img']; ?>"  style="width: 100%;">
                                                <input type="hidden" value="<?php echo $vo['img']; ?>" name="editImg[]">
                                                <?php else: ?>
                                                <img  class="preview" alt="" src="/static/public/image/upload.png" >
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">url地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="url[]" placeholder="请输入url地址"
                                           value="<?php echo $vo['url']; ?>"
                                           autocomplete="off" class="layui-input">

                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name[]" placeholder="请输入名称"
                                           value="<?php echo $vo['name']; ?>"
                                           autocomplete="off" class="layui-input">
                                 </div>
                             </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品描述</label>
                                <div class="layui-input-block">
                                    <input type="text" name="summary[]" placeholder="请输入商品描述"
                                           value="<?php echo $vo['summary']; ?>"
                                           autocomplete="off" class="layui-input">

                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品价格</label>
                                <div class="layui-input-block">
                                    <input type="text" name="price[]" placeholder="请输入商品价格"
                                           value="<?php echo $vo['price']; ?>"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">背景颜色</label>
                                <div class="layui-input-block">
                                    <input type="text" name="bg[]" placeholder="请填写背景颜色值"
                                           value="<?php echo $vo['bg']; ?>"
                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
             <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>




    <div class="layui-form-item" style="margin-top:30px;">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-blue" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
    <script src="/static/layui/layui.all.js"></script>
    <script src="/static/public/js/jquery.js"></script>
    <script src="/static/public/js/upload.js"></script>

    <script>


      layui.use('form', function(){
          var form = layui.form
             ,layer = layui.layer;



      });
        function  addContent() {
           var content="";
           var num=$(".layui-content").length;

            content =
                `
             <div class="layui-content">
            <div class="layui-row">
                <div class="layui-card">
                    <div class="layui-card-header">添加产品分类
                        <div class="layui-btn layui-btn-blue  layui-btn-xs" onclick="addContent()">添加内容</div>
                        <div class="layui-btn layui-btn-blue  layui-btn-xs" onclick="delContent(${num})">删除内容</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">内容名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="title[]" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">内容图片</label>
                        <div class="layui-input-block" style="position: relative">
                            <input type='file' class='doc' onchange="imgChange(this,${num})" name='image[]' style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" class="localImag">
                                <tr>
                                    <td>
                                        <img  class="preview" alt="" src="/static/public/image/upload.png" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">url地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="url[]" placeholder="请输入url地址"

                                           autocomplete="off" class="layui-input">

                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name[]" placeholder="请输入商品名称"

                                           autocomplete="off" class="layui-input">
                                 </div>
                             </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品描述</label>
                                <div class="layui-input-block">
                                    <input type="text" name="summary[]" placeholder="请输入商品描述"

                                           autocomplete="off" class="layui-input">

                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">商品价格</label>
                                <div class="layui-input-block">
                                    <input type="text" name="price[]" placeholder="请输入商品价格"

                                           autocomplete="off" class="layui-input">
                                </div>
                            </div>
                             <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">背景颜色</label>
                        <div class="layui-input-block">
                            <input type="text" name="bg[]" placeholder="请填写背景颜色值"

                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            `
            $(".layui-content-list").append(content);
        }
        function delContent(num) {

           $(".layui-content").eq(num).remove()
        }

    </script>
</body>
</html>
