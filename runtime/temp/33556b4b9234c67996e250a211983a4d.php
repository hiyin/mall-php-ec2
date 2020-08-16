<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\mall\public/../application/admin\view\product\select_shop.html";i:1585913125;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="icon" href="/favicon.ico">
    <title>管理后台</title>
</head>
<body class="layui-view-body">
<form class="layui-form" action="" method="post" enctype="multipart/form-data">
    <div class="layui-content"  style="padding:0">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <div class="layui-form layui-form-item">
                            <div class="layui-inline">
                                <div class="layui-form-mid">用户名:</div>
                                <div class="layui-input-inline" style="width: 200px;">
                                  <input type="text" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid">分类:</div>
                                <div class="layui-input-inline" style="width: 150px;">
                                    <select name="sex">
                                        <option value="0">请选择分类</option>
                                    </select>
                                </div>
                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>

                        <table class="layui-table">
                            <colgroup>
                                <col width="50">
                                <col width="50">
                                <col width="100">
                                <col>

                                <col width="100">
                                <col width="100">

                            </colgroup>
                            <thead>
                                <tr>
                                    <th>操作</th>
                                    <th>id</th>
                                    <th>商品图片</th>
                                    <th>商品标题</th>
                                    <th>商品价格</th>
                                    <th>销量</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($proudct) || $proudct instanceof \think\Collection || $proudct instanceof \think\Paginator): $i = 0; $__LIST__ = $proudct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td>
                                        <input type="radio" name="display" lay-filter="filterId" value="<?php echo $vo['id']; ?>" logtitle="<?php echo $vo['title']; ?>" price="<?php echo $vo['price']; ?>" smalltitle="<?php echo $vo['smalltitle']; ?>"/>
                                    </td>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td>
                                        <?php if($vo['mainimage']): ?>
                                        <img src="/uploads/<?php echo $vo['mainimage']; ?>" alt="" style="display: block;margin:0 auto;height: 50px;">
                                        <?php else: ?>
                                        <p class="center"> 暂无图片</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $vo['title']; ?></td>

                                    <th><?php echo $vo['price']; ?></th>
                                    <td><?php echo $vo['sale']; ?></td>

                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php echo $proudct->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="selectId" value=""/>
        <input type="hidden" id="selectPrice" value=""/>
        <input type="hidden" id="selectTitle" value=""/>
        <input type="hidden" id="selectSmall" value=""/>
    </div>
</form>
    <script src="/static/layui/layui.all.js"></script>
    <script>
  var element = layui.element;
  var table = layui.table;
  var form = layui.form;
  layui.use('form', function(){
      var form = layui.form;
      var $=layui.jquery

      //监听提交
      form.on('radio(filterId)', function(data){
          $('#selectId').val(data.value)
          $('#selectPrice').val($(data.elem).attr('price'))
          $("#selectTitle").val($(data.elem).attr('logtitle'))
          $("#selectSmall").val($(data.elem).attr('smalltitle'))
      });
  });

    </script>
</body>
</html>
