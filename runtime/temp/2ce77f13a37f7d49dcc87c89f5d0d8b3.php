<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/order/order_list.html";i:1597476029;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>

    <title>管理后台</title>
    <style>

        p.center{text-align: center}
        .shopInfo li{
            width: 100%;
            height: 74px;
            display: flex;
            border-top: 1px solid #e6e6e6;}
        .shopInfo li:nth-of-type(1){border-top:none}
        .shopInfo li p{
          padding:0 15px;
            height: 70px;
            display: flex;align-items: center;
          border-left:1px solid #e6e6e6;}
        .shopInfo li p:nth-of-type(1){
            border-left: none;}
        .mainimage{
            width: 60px;
            height:60px;}
    </style>
</head>
<body class="layui-view-body">
<form action="" class="layui-form">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <div class="layui-form layui-form-item">
                            <div class="layui-inline">
                                <div class="layui-form-mid">订单列表:</div>
                                <div class="layui-input-inline" style="width: 200px;">
                                  <input type="text" autocomplete="off" class="layui-input">
                                </div>

                                <!--<div class="layui-form-mid">性别:</div>-->
                                <!--<div class="layui-input-inline" style="width: 100px;">-->
                                    <!--<select name="sex">-->
                                        <!--<option value="1">男</option>-->
                                        <!--<option value="2">女</option>-->
                                    <!--</select>     -->
                                <!--</div>-->
                                <button class="layui-btn layui-btn-blue">查询</button>
                                <button class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>

                        <table class="layui-table">
                            <colgroup>
<!--                                <col width="100">-->
<!--                                <col width="100">-->
<!--                                <col width="300">-->
<!--                                <col width="200">-->
<!--                                <col width="200">-->
<!--                                <col width="200">-->
<!--                                <col width="200">-->
<!--                                <col width="200">-->
<!--                                <col width="200">-->
                            </colgroup>
                            <thead>
                                <tr>
                                    <th><p class="center">订单编号</p></th>
                                    <th>商品</th>


                                    <th><p class="center">支付方式</p></th>
                                    <th><p class="center">订单状态</p></th>

                                    <th><p class="center">物流方式</p></th>
                                    <th><p class="center">商品总价</p></th>
                                    <th><p class="center">联系方式</p></th>

                                    <th><p class="center">收货地址</p></th>
                                    <th><p class="center">操作</p></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $vo['ordernum']; ?></td>
                                    <td style="padding: 0;">
                                        <ul class="shopInfo">
                                            <?php if(is_array($vo['shop']) || $vo['shop'] instanceof \think\Collection || $vo['shop'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
                                           <li>
                                                <p><img src="/uploads/<?php echo $child['mainimage']; ?>" alt="" class="mainimage"></p>
                                                <p style="width: 200px;"><?php echo $child['title']; ?></p>
                                                <p style="width: 50px;"><?php echo $child['num']; ?></p>
                                                <p style="width: 50px;"><?php echo $child['price']; ?></p>
                                            </li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul>
                                    </td>



                                    <td>
                                        <?php if($vo['paytype']==1): ?>支付宝<?php endif; if($vo['paytype']==2): ?>微信<?php endif; if($vo['paytype']==3): ?>现金<?php endif; if($vo['paytype']==''): ?>待支付<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($vo['status']==1): ?>待支付<?php endif; if($vo['status']==2): ?>待发货<?php endif; if($vo['status']==3): ?>待收货<?php endif; if($vo['status']==4): ?>待评价<?php endif; if($vo['status']==5): ?>已完成<?php endif; if($vo['status']==6): ?>已取消<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $vo['logistics']; ?><br/>
                                        价格：<?php echo $vo['logisticsprice']; ?>
                                    </td>
                                    <td>
                                        <?php echo $vo['allprice']; ?>
                                    </td>
                                    <td>
                                        <?php echo $vo['username']; ?><br/>
                                        <?php echo $vo['telphone']; ?>
                                    </td>

                                    <td>
                                        <?php echo $vo['city']; ?><?php echo $vo['address']; ?>
                                    </td>
                                    <td>
                                        <a href="" class="layui-btn layui-btn-xs layui-btn-blue">查看</a>
                                        <?php if($vo['status']==2): ?>
                                        <a href="<?php echo url('Order/deliver',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-xs layui-btn-danger">发货</a>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>

                        </table>
                        <div class="pagination">
                            <?php echo $order->render(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script src="/static/layui/layui.all.js"></script>
<script src="/static/public/js/jquery.js"></script>
<script>
    var element = layui.element;
    var table = layui.table;
    var form = layui.form;
    form.on('switch()', function(data){
        var id=data.elem.id;
        var recommend;
        if(data.elem.checked){
            recommend=1;
        }else{
            recommend=0;
        }
        $.ajax({
            url: '<?php echo url("iconlist/recommend"); ?>',
            data:{
                recommend:recommend,
                id:id
            },//发送请求数据
            type: "POST",
            dataType: "json",//[重要]数据类型,一般为json格式,有些时候可以为html/text
            success: function(result){
                //成功处理函数,result为返回结果[重要]
                console.log(result)
            },

        });

    });

</script>
</body>
</html>
