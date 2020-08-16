<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\mall\public/../application/admin\view\product\product_edit.html";i:1574232793;}*/ ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/product.css"/>
    <title></title>
</head>
<body class="layui-view-body">
<form action="" method="post"  enctype="multipart/form-data" class="layui-form" >
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
                                            <option value="<?php echo $vo['id']; ?>" <?php if($vo['id']==$product['pid']): ?>selected<?php endif; ?>><?php echo $vo['catename']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品名称</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="title"
                                               placeholder="请输入商品名称(最多不能超过60个字符)"
                                               autocomplete="off"
                                               value="<?php echo $product['title']; ?>"
                                               class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">活动标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="smalltitle"
                                               value="<?php echo $product['smalltitle']; ?>"
                                               placeholder="请输入活动标题(最多不能超过30个字符)"
                                               autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品标签</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="tag" value="1" title="热销" <?php if($product['tag']=='1'): ?>checked<?php endif; ?>>
                                        <input type="radio" name="tag" value="2" title="新品" <?php if($product['tag']=='2'): ?>checked<?php endif; ?>>
                                        <input type="radio" name="tag" value="3" title="促销" <?php if($product['tag']=='3'): ?>checked<?php endif; ?>>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">推荐类型</label>
                                    <div class="layui-input-block ">
                                        <input <?php if($product['recommended']=='1'): ?>checked<?php endif; ?> type="radio" name="recommended" value="1" title="首页推荐">
                                        <input <?php if($product['recommended']=='2'): ?>checked<?php endif; ?> type="radio" name="recommended" value="2" title="分类推荐">
                                        <input <?php if($product['recommended']=='3'): ?>checked<?php endif; ?> type="radio" name="recommended" value="3" title="详情推荐">
                                        <input <?php if($product['recommended']=='4'): ?>checked<?php endif; ?> type="radio" name="recommended" value="4" title="购物车推荐">
                                    </div>
                                </div>

                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">商品摘要</label>
                                    <div class="layui-input-block">
                                        <textarea name="summary" placeholder="请输入商品摘要内容"
                                                  class="layui-textarea"><?php echo $product['summary']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--主图信息-->
                            <div class="layui-tab-item  imageTab"  >
                                <div class="layui-form-item">
                                    <label class="layui-form-label">商品主图</label>
                                    <div class="layui-input-block imageBox">
                                        <input type="file" name="mainimage" class="imageUpload" value="<?php echo $product['mainimage']; ?>"/>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">详情图片</label>
                                    <?php $__FOR_START_5995__=0;$__FOR_END_5995__=4;for($i=$__FOR_START_5995__;$i < $__FOR_END_5995__;$i+=1){ if(isset($productimg[$i])): ?>
                                            <input type="file" name="othermain[]" class="imageUpload" value="<?php echo $productimg[$i]['othermain']; ?>"/>
                                            <?php else: ?>
                                            <input type="file" name="othermain[]" class="imageUpload" value=""/>
                                            <?php endif; } ?>
                                </div>
                            </div>
                            <!--文字详情-->
                            <div class="layui-tab-item">
                                <div class="layui-form-item layui-form-text" style="height: 610px;">
                                    <label class="layui-form-label">文章详情</label>
                                    <div class="layui-input-block">
                                        <textarea id="editor" name="content" placeholder="请输入内容"><?php echo $product['content']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--属性管理-->
                            <div class="layui-tab-item">
                                <div class="kePublic">
                                    <div class="div_title attrTitle"><span>选择属性[商品信息中需选择顶级分类,最多选择2条商品属性]</span></div>
                                    <!--选择基本信息分类后自动获取对应属性-->
                                    <div id="cateAttr">
                                        <?php if(is_array($cateAllAttr) || $cateAllAttr instanceof \think\Collection || $cateAllAttr instanceof \think\Paginator): $i = 0; $__LIST__ = $cateAllAttr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <input lay-filter="checkAttr" class="checkAttr" <?php if(in_array($vo['id'],$checkAttrId)): ?>checked<?php endif; ?> type="checkbox" id="<?php echo $vo['id']; ?>" val="<?php echo $vo['attrvalue']; ?>" lay-skin="primary" title="<?php echo $vo['attrname']; ?>">
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <input type="text" class="attrid" name="attr_id" value="<?php echo $product['attr_id']; ?>"></div>
                                    <!--属性列表-->
                                    <div id="AttrList">
                                        <?php if(is_array($cateattr) || $cateattr instanceof \think\Collection || $cateattr instanceof \think\Paginator): $k = 0; $__LIST__ = $cateattr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                                            <dl>
                                                <dt><?php echo $vo['attrname']; ?></dt>
                                                <dd>
                                                    <?php if(is_array($vo['attr_value']) || $vo['attr_value'] instanceof \think\Collection || $vo['attr_value'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['attr_value'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
                                                    <input lay-filter="checkAttrval" <?php if(in_array($child,$checkValue['attr_'.($k-1)])): ?>checked<?php endif; ?> class="checkAttrval"  type="checkbox" lay-skin="primary" id="<?php echo $vo['id']; ?>" ptitle="<?php echo $vo['attrname']; ?>" title="<?php echo $child; ?>">
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </dd>
                                            </dl>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                    <!--属性表格-->

                                    <div id="creatTable">
                                        <table>
                                            <?php if($productattr): ?>
                                            <tr>
                                                <th>颜色</th>
                                                <th>内存</th>
                                                <th>价格</th>
                                                <th>库存</th>
                                                <th>编号</th>
                                                <th>备注</th>
                                            </tr>
                                            <?php endif; if(is_array($productattr) || $productattr instanceof \think\Collection || $productattr instanceof \think\Paginator): $i = 0; $__LIST__ = $productattr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <tr>
                                                <td><input type="text" name="attr_0[]" value="<?php echo $vo['attr_0']; ?>" placeholder="请输入价格" class="layui-input"></td>
                                                <td><input type="text" name="attr_1[]" value="<?php echo $vo['attr_1']; ?>" placeholder="请输入价格" class="layui-input"></td>
                                                <td><input type="text" name="price[]"  value="<?php echo $vo['price']; ?>" placeholder="请输入价格" class="layui-input"></td>
                                                <td><input type="text" name="stock[]"  value="<?php echo $vo['stock']; ?>" placeholder="请输入库存" class="layui-input"></td>
                                                <td><input type="text" name="product_num[]" value="<?php echo $vo['product_num']; ?>" placeholder="请输入商品编号" class="layui-input"></td>
                                                <td><input type="text" name="remark[]" value="<?php echo $vo['remark']; ?>"  placeholder="请输入备注信息" class="layui-input"></td>
                                            </tr>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </table>
                                    </div>

                                    <div class="layui-form-item">
                                        <label class="layui-form-label">商品价格</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="base_price" value="<?php echo $product['price']; ?>" placeholder="请输入活动标题(最多不能超过30个字符)" autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">市场价格</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="market_price" value="<?php echo $product['market_price']; ?>" placeholder="请输入活动标题(最多不能超过30个字符)" autocomplete="off" class="layui-input">
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
                                    <?php if(is_array($productspec) || $productspec instanceof \think\Collection || $productspec instanceof \think\Paginator): $i = 0; $__LIST__ = $productspec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <div class="layui-form-item">
                                        <div class="layui-input-inline" style="margin-left: 100px;">
                                            <input type="text" value="<?php echo $vo['specname']; ?>" name="specname[]" class="layui-input" placeholder="请输入规格名称">
                                        </div>
                                        <div class="layui-input-inline">
                                            <input type="text" value="<?php echo $vo['specvalue']; ?>"  name="specvalue[]" class="layui-input" placeholder="请输入规格内容">
                                        </div>
                                        <a href="javascript:;" class="specDelBtn" onclick="specDelBtn(this)">删除规格</a>
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <!--服务选择-->
                            <div class="layui-tab-item">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">服务选择</label>
                                    <div class="layui-input-block" >
                                        <!--选择基本信息分类后自动获取对应属性-->
                                        <?php if(is_array($service) || $service instanceof \think\Collection || $service instanceof \think\Paginator): $i = 0; $__LIST__ = $service;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <input lay-filter="checkAttrval" <?php if(in_array($vo['id'],$checkSevice)): ?>checked<?php endif; ?> name="service[]"  type="checkbox" value="<?php echo $vo['id']; ?>" lay-skin="primary"  title="<?php echo $vo['title']; ?>">
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
