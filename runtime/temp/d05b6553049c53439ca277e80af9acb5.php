<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\floor\floor_content.html";i:1554188265;}*/ ?>
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
        .content{
            width: 96%;
            height: auto;margin:30px auto 0;
            min-height: 800px;
            overflow: hidden;}

       .layui-left{
           width: 280px;float:left;border-right:1px solid #f1f1f1;
           min-height: 600px;}
        .layui-left li{
            width: 250px;
            height: 40px;text-indent: 10px;
            line-height: 40px;}
        .layui-left li i{
            font-size: 10px;padding-right:5px;}
        .layui-left li.active{

            background-color: #177ce3;
            background-repeat: repeat-y;
            background-image: -moz-linear-gradient(left,#29adeb,#177ce3);
            background-image: -webkit-linear-gradient(left,#29adeb,#177ce3);
            background-image: -o-linear-gradient(left,#29adeb,#177ce3);
            background-image: linear-gradient(left,#29adeb,#177ce3);
        }
        .layui-left li.active a{color:#fff;}
        .layui-right{
            width: 60%;float:left;}
        .layui-right input{
            height: 36px;
            border: 1px solid #e6e6e6;
            width: 100%;
            text-indent: 10px;
            border-radius: 2px;
        }
        #preview,#preview1{
            width: 100px;
            height: 100px;}
        .floorTitle{
            color: #177ce3;padding:0 3px;}
    </style>
</head>
<body class="layui-view-body">
    <form class="layui-form"  action="<?php echo url('Floor/contentadd'); ?>" method="post" enctype="multipart/form-data">
        <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">添加<span class="floorTitle"><?php echo $floor['title']; ?></span>信息</div>
                <div class="content">

                <div class="layui-left">

                            <!-- 左侧子菜单 -->
                            <ul class="">
                                <li class="active">
                                    <a href="javascript:;"><i class="layui-icon">&#xe602;</i>添加数据</a>
                                </li>
                                <?php if(is_array($content) || $content instanceof \think\Collection || $content instanceof \think\Paginator): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li data-id="<?php echo $vo['id']; ?>">
                                    <a href="javascript:;"><i class="layui-icon">&#xe602;</i><?php echo $vo['title']; ?></a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>

                </div>
                <div class="layui-right">
                    <input type="hidden" name="floor_id" value="<?php echo $floor['id']; ?>"/>
                    <input type="hidden" name="id" class="contentid" value=""/>
                    <div class="layui-form-item">
                        <label class="layui-form-label">标题信息</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" class="title" placeholder="请输入标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">标题描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="summary" class="summary"  placeholder="请输入标题描述" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">链接地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="url" class="url"  placeholder="请输入链接地址" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">轮播图片</label>
                        <div class="layui-input-block" style="position: relative;float:left;margin-left:0;">
                            <input type='file' id='doc' name='image' class="image" style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag">
                                <tr>
                                    <td>
                                        <img  id="preview" alt="" src="/static/public/image/upload.png" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="layui-input-block" style="position: relative;float:left;margin-left:10px;">
                            <input type='file' id='doc1' name='image1' class="image1" style='opacity:0;width:100px;height: 100px;position: absolute;'>
                            <table style="width:102px;height:102px;border:1px solid #e6e6e6" id="localImag1">
                                <tr>
                                    <td>
                                        <img  id="preview1" alt="" src="/static/public/image/upload.png" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-blue" lay-submit id="submitAdd"  >立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
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
        var path='./uploads/';
      var form = layui.form
        ,layer = layui.layer;
      $(function () {
        $(".layui-left li").click(function () {
            var _index=$(this).index();
            $(".layui-left li").removeClass('active');
            $(this).addClass('active');
            var id=$(this).attr('data-id');
            if(_index==0){
                $(".contentid").val('');
                $('.title').val('');
                $('.summary').val('');
                $('.url').val('');
                $("#preview").attr('src',"/static/public/image/upload.png")
                $("#preview1").attr('src',"/static/public/image/upload.png")
            }
            else{
                $.ajax({
                    async: true, //请求是否异步，默认为异步(true)重要参数[重要]
                    url: '<?php echo url("Floor/contentedit"); ?>', //请求的url地址[重要]
                    data: {id:id},//发送请求数据
                    type: "POST",
                    dataType: "json",
                    success: function (result) {

                        $(".contentid").val(result.id);
                        $('.title').val(result.title);
                        $('.summary').val(result.summary);
                        $('.url').val(result.url);

                        var image=result.image.split(',');

                        $("#preview").attr('src',"/static/public/image/upload.png");
                        $("#preview1").attr('src',"/static/public/image/upload.png");

                        if(image[0]){
                            $("#preview").attr('src',path+image[0])
                        }
                        if(image[1]){
                            $("#preview1").attr('src',path+image[1])
                        }

                    }
                })
            }
        })
      })
    </script>
</body>
</html>