<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\phpstudy\PHPTutorial\WWW\mall\public/../application/admin\view\index\console.html";i:1547170499;}*/ ?>
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
    <div class="layui-content">
        <div class="layui-row layui-col-space20">
            <div class="layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-body chart-card">
                        <div class="chart-header">
                            <div class="metawrap">
                                <div class="meta">
                                    <span>文章总数</span>
                                </div>
                                <div class="total"><?php echo $articleNum; ?></div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <div class="contentwrap">
                                文章总数包含显示和隐藏的文章
                            </div>
                        </div>
                        <div class="chart-footer">
                            <div class="field">
                                <span>日添加量</span>
                                <span><?php echo $todayArticle; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-body chart-card">
                        <div class="chart-header">
                            <div class="metawrap">
                                <div class="meta">
                                    <span>产品数量</span>
                                </div>
                                <div class="total"><?php echo $productNum; ?></div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <div class="contentwrap">
                                产品总数包含上架和下架的产品
                            </div>
                        </div>
                        <div class="chart-footer">
                            <div class="field">
                                <span>日添加量</span>
                                <span><?php echo $todayProduct; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-body chart-card">
                        <div class="chart-header">
                            <div class="metawrap">
                                <div class="meta">
                                    <span>总留言数</span>
                                </div>
                                <div class="total">126,560</div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <div class="contentwrap">
                                fsdfdsf
                            </div>
                        </div>
                        <div class="chart-footer">
                            <div class="field">
                                <span>日注册量</span>
                                <span>321</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm6 layui-col-md3">
                <div class="layui-card">
                    <div class="layui-card-body chart-card">
                        <div class="chart-header">
                            <div class="metawrap">
                                <div class="meta">
                                    <span>总用户数</span>
                                </div>
                                <div class="total">126,560</div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <div class="contentwrap">
                                fsdfdsf
                            </div>
                        </div>
                        <div class="chart-footer">
                            <div class="field">
                                <span>日注册量</span>
                                <span>321</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-sm12 layui-col-md12">
                <div class="layui-card">
                    <div class="layui-tab layui-tab-brief">
                        <ul class="layui-tab-title">
                            <li class="layui-this">新增数</li>
                            <li>活跃度</li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                dddd
                            </div>
                            <div class="layui-tab-item">
                                ddd
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/layui/layui.all.js"></script>
    <script>
     var element = layui.element;
    </script>
</body>
</html>