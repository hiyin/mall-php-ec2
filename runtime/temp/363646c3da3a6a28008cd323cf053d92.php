<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/Applications/MAMP/htdocs/mall/public/../application/admin/view/pay/index.html";i:1584343841;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/layui/css/view.css"/>
    <link rel="stylesheet" href="/static/admin/css/view.css"/>
    <title></title>
</head>
<body class="layui-view-body">
    <form class="layui-form" action="" method="post" enctype="multipart/form-data">
        <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">支付宝</li>
                        <li>微信</li>

                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <div class="layui-form-item">
                                <label class="layui-form-label">APPID</label>
                                <div class="layui-input-block">
                                    <input type="text" value="<?php echo $pay['alipay_appid']; ?>" name="alipay_appid"  placeholder="请输入支付宝APPID" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">私钥</label>
                                <div class="layui-input-block">
                                    <textarea name="alipay_privateKey" placeholder="请输入支付宝私钥" class="layui-textarea"><?php echo $pay['alipay_privateKey']; ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">公钥</label>
                                <div class="layui-input-block">
                                    <textarea name="alipay_publicKey" placeholder="请输入支付宝公钥" class="layui-textarea"><?php echo $pay['alipay_publicKey']; ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">回调地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="alipay_url" value="<?php echo $pay['alipay_url']; ?>"  placeholder="请输入支付宝回调地址" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="layui-form-item">
                                <label class="layui-form-label">APPID</label>
                                <div class="layui-input-block">
                                    <input type="text" name="wxpay_appid" value="<?php echo $pay['wxpay_appid']; ?>" placeholder="请输入微信Appid" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">商户号<span style="font-size: 10px;">(MCHID)</span></label>
                                <div class="layui-input-block">
                                    <input type="text" value="<?php echo $pay['wxpay_mchid']; ?>" name="wxpay_mchid"  placeholder="请输入微信商户号(MCHID)" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">密钥(KEY)</label>
                                <div class="layui-input-block">
                                    <input type="text" value="<?php echo $pay['wxpay_key']; ?>"  name="wxpay_key"  placeholder="请输入微信密钥(KEY)" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">回调地址</label>
                                <div class="layui-input-block">
                                    <input type="text" name="wxpay_url" value="<?php echo $pay['wxpay_url']; ?>"   placeholder="请输入微信回调地址" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>

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
      var form = layui.form
        ,layer = layui.layer;
    </script>
</body>
</html>
