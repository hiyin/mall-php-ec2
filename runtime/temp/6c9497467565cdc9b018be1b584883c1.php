<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy\WWW\mall\public/../application/admin\view\index\index.html";i:1585810204;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/admin.css">
    <title>管理后台</title>
    <style>
        .layui-layout-admin .layui-body{bottom:20px;}
    </style>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header custom-header">

            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item slide-sidebar" lay-unselect>
                    <a href="javascript:;" class="icon-font"><i class="ai ai-menufold"></i></a>
                </li>
            </ul>

            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;"><?php echo $username; ?></a>
                    <dl class="layui-nav-child">
                        <dd><a href="">帮助中心</a></dd>
                        <dd><a href="<?php echo url('admin/logout'); ?>">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side custom-admin">
            <div class="layui-side-scroll">

                <div class="custom-logo">
                    <img src="/static/layui/images/logo.png" alt=""/>
                    <h1>英特网络</h1>
                </div>
                <ul id="Nav" class="layui-nav layui-nav-tree">
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe68e;</i>
                            <em>网站后台</em>
                        </a>
                         <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('index/console'); ?>">控制台</a></dd>

                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe770;</i>
                            <em>账号管理</em>
                        </a>
                        <dl class="layui-nav-child">
                            <?php if(in_array('Admin/index',$rulesName)): ?>
                            <dd><a href="<?php echo url('Admin/index'); ?>">管理列表</a></dd>
                            <?php endif; ?>
                            <dd><a href="<?php echo url('Member/index'); ?>">会员列表</a></dd>
                        </dl>
                    </li>
                      <!--<li class="layui-nav-item">-->
                        <!--<a href="javascript:;">-->
                            <!--<i class="layui-icon">&#xe716;</i>-->
                            <!--<em>系统管理</em>-->
                        <!--</a>-->
                        <!--<dl class="layui-nav-child">-->
                            <!--<dd><a href="<?php echo url('Sys/sys'); ?>">系统配置</a></dd>-->
                            <!--<dd><a href="<?php echo url('Sys/index'); ?>">配置列表</a></dd>-->
                        <!--</dl>-->
                    <!--</li>-->
                    <!--<li class="layui-nav-item">-->
                        <!--<a href="javascript:;">-->
                            <!--<i class="layui-icon">&#xe672;</i>-->
                            <!--<em>权限管理</em>-->
                        <!--</a>-->
                        <!--<dl class="layui-nav-child">-->

                            <!--<?php if(in_array('Authgroup/index',$rulesName)): ?>-->
                            <!--<dd><a href="<?php echo url('Authgroup/index'); ?>">配置权限</a></dd>-->
                            <!--<?php endif; ?>-->
                            <!--<?php if(in_array('Authrule/index',$rulesName)): ?>-->
                            <!--<dd><a href="<?php echo url('Authrule/index'); ?>">权限规则</a></dd>-->
                            <!--<?php endif; ?>-->
                        <!--</dl>-->
                    <!--</li>-->
                     <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe64a;</i>
                            <em>首页管理</em>
                        </a>
                         <?php if(in_array('Banner/index',$rulesName)): ?>
                            <dl class="layui-nav-child">
                                <dd><a href="<?php echo url('Banner/index'); ?>">轮播管理</a></dd>
                            </dl>
                             <dl class="layui-nav-child">
                                 <dd><a href="<?php echo url('Iconlist/index'); ?>">图标导航</a></dd>
                             </dl>
                             <dl class="layui-nav-child">
                                 <dd><a href="<?php echo url('Active/index'); ?>">活动管理</a></dd>
                             </dl>
                             <dl class="layui-nav-child">
                                 <dd><a href="<?php echo url('Floor/index'); ?>">楼层管理</a></dd>
                             </dl>
                             <dl class="layui-nav-child">
                                 <dd><a href="<?php echo url('Link/index'); ?>">链接管理</a></dd>
                             </dl>
                         <?php endif; ?>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe653;</i>
                            <em>分类管理</em>
                        </a>
                        <?php if(in_array('Cate/index',$rulesName)): ?>
                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('Cate/index'); ?>">分类列表</a></dd>
                            <dd>
                                <a href="<?php echo url('Cate/add'); ?>">添加分类</a>
                            </dd>
                        </dl>
                        <?php endif; ?>
                    </li>
                    <!--<li class="layui-nav-item">-->
                        <!--<a href="javascript:;">-->
                            <!--<i class="layui-icon">&#xe655;</i>-->
                            <!--<em>文章管理</em>-->
                        <!--</a>-->

                        <!--<dl class="layui-nav-child">-->
                            <!--<?php if(in_array('Article/index',$rulesName)): ?>-->
                            <!--<dd><a href="<?php echo url('Article/index'); ?>">文章管理</a></dd>-->
                            <!--<?php endif; ?>-->
                            <!--<dd><a href="<?php echo url('About/index'); ?>">关于我们</a></dd>-->
                        <!--</dl>-->

                    <!--</li>-->
                    <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe857;</i>
                        <em>产品管理</em>
                    </a>
                    <?php if(in_array('Product/index',$rulesName)): ?>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo url('Attr/index'); ?>">属性管理</a></dd>
                        <dd><a href="<?php echo url('Product/index'); ?>">产品列表</a></dd>
                        <dd><a href="<?php echo url('Product/add'); ?>">添加产品</a></dd>
                        <dd><a href="<?php echo url('Product/serviceList'); ?>">产品服务</a></dd>

                    </dl>
                    <?php endif; ?>
                     </li>
                     <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe63c;</i>
                            <em>订单管理</em>
                        </a>

                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('Order/index'); ?>">订单列表</a></dd>

                        </dl>


                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe7ae;</i>
                            <em>设置管理</em>
                        </a>

                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('Logistics/index'); ?>">物流管理</a></dd>
                            <dd><a href="<?php echo url('Search/index'); ?>">热门搜索</a></dd>
                            <dd><a href="<?php echo url('Search/search_history'); ?>">搜索历史</a></dd>

                            <dd><a href="<?php echo url('Pay/index'); ?>">支付管理</a></dd>
                        </dl>


                    </li>
                </ul>

            </div>
        </div>

        <div class="layui-body">
             <div class="layui-tab app-container" lay-allowClose="true" lay-filter="tabs">
                <ul id="appTabs" class="layui-tab-title custom-tab"></ul>
                <div id="appTabPage" class="layui-tab-content"></div>
            </div>
        </div>

        <div class="mobile-mask"></div>
    </div>
    <script src="/static/layui/layui.js"></script>
    <script src="/static/admin/js/index.js" data-main="static/admin/js/home"></script>
</body>
</html>
