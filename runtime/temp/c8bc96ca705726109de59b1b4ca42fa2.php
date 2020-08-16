<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/product/product_add.html";i:1574232450;}*/ ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/product.css"/>
    <style>

    </style>
    <title></title>
</head>
<body class="layui-view-body">
<form action="" method="post"  enctype="multipart/form-data"  class="layui-form" >
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">

                <form class="layui-form layui-card-body" action="">
                    <div class="layui-tab layui-tab-card">
                        <ul class="layui-tab-title">
                            <li class="layui-this">基本信息</li>
                            <li>商品主图</li>
                            <li>商品详情</li>
                            <li>属性管理</li>
                            <li>商品规格</li>
                            <li>商品服务</li>
                        </ul>
                        <div class="layui-tab-content" style="height: auto;">
                            <!--基本信息-->
                            <div class="layui-tab-item  layui-show">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品分类</label>
                                    <div class="layui-input-block" style="width: 300px;float:left;margin-left:0;">
                                        <select  name="pid" lay-filter="pid">
                                            <option value="0">顶级分类</option>
                                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['catename']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品名称</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="title" placeholder="请输入商品名称(最多不能超过60个字符)" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">活动标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="smalltitle" placeholder="请输入活动标题(最多不能超过30个字符)" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品标签</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="tag" value="1" title="热销"checked="">
                                        <input type="radio" name="tag" value="2" title="新品">
                                        <input type="radio" name="tag" value="3" title="促销">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">推荐类型</label>
                                    <div class="layui-input-block ">
                                            <input type="radio" name="recommended" value="1" title="首页推荐"checked="">
                                            <input type="radio" name="recommended" value="2" title="分类推荐">
                                            <input type="radio" name="recommended" value="3" title="详情推荐">
                                            <input type="radio" name="recommended" value="4" title="购物车推荐">
                                    </div>
                                </div>
                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">商品摘要</label>
                                    <div class="layui-input-block">
                                        <textarea name="summary" placeholder="请输入商品摘要内容" class="layui-textarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--主图信息-->
                            <div class="layui-tab-item  imageTab"  >
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品主图</label>
                                    <div class="layui-input-block imageBox">
                                        <input type="file" name="mainimage" class="imageUpload"/>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">详情图片</label>
                                    <input type="file" name="othermain[]" class="imageUpload"/>
                                    <input type="file" name="othermain[]" class="imageUpload"/>
                                    <input type="file" name="othermain[]" class="imageUpload"/>
                                    <input type="file" name="othermain[]" class="imageUpload"/>
                                </div>
                            </div>
                            <!--文字详情-->
                            <div class="layui-tab-item">
                                <div class="layui-form-item layui-form-text" style="height: 610px;">
                                    <label class="layui-form-label">文章详情</label>
                                    <div class="layui-input-block">
                                        <textarea id="editor" name="content" placeholder="请输入内容"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--属性管理-->
                            <div class="layui-tab-item">
                                <div class="kePublic">
                                    <div class="div_title attrTitle"><span>选择属性[商品信息中需选择顶级分类,最多选择2条商品属性]</span></div>
                                    <!--选择基本信息分类后自动获取对应属性-->

                                    <div id="cateAttr">

                                    </div>
                                    <div id="AttrList">

                                    </div>
                                    <div id="creatTable">

                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">商品价格</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="base_price" placeholder="请输入活动标题(最多不能超过30个字符)" autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">市场价格</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="market_price" placeholder="请输入活动标题(最多不能超过30个字符)" autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--规格管理-->
                            <div class="layui-tab-item ">
                                <div class="specContent">
                                    <div class="layui-form-item" style="clear:both;">
                                        <div class="layui-input-block ">
                                            <input type="button" onclick="addSpec()" class="layui-btn layui-btn-blue" value="添加规格"  style="margin-bottom:0;margin-left:-10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--服务选择-->
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">服务选择</label>
                                    <div class="layui-input-block" >
                                        <!--选择基本信息分类后自动获取对应属性-->
                                        <?php if(is_array($service) || $service instanceof \think\Collection || $service instanceof \think\Paginator): $i = 0; $__LIST__ = $service;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <input lay-filter="checkAttrval" name="service[]"  type="checkbox" value="<?php echo $vo['id']; ?>" lay-skin="primary"  title="<?php echo $vo['title']; ?>">
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="layui-form-item" style="clear:both;">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-blue" lay-submit lay-filter="formDemo" >立即提交</button>
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
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    var cateUrl='<?php echo url("admin/Product/getAttrByCateId"); ?>';
</script>
<script src="/static/admin/js/liandong.js"></script>
</body>
</html>
