<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\phpStudy\WWW\mall\public/../application/admin\view\login\login.html";i:1547200044;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登陆</title>
	<link href="/static/layui/css/layui.css" rel="stylesheet" />
    <link href="/static/public/css/style.css" rel="stylesheet" />
    <link href="/static/admin/css/login.css" rel="stylesheet" />
    <script src="/static/public/js/jquery.js"></script>
    <script>
        $(function () {
            $(".registerBtn").click(function () {


                if($(".username").val()==""){
                    $(".errormsg").text("用户名不能位空");
                    return;
                }
                if($(".password").val()==""){
                    $(".errormsg").text("密码不能为空");
                    return;
                }
                if($(".password").val().length<6){
                    $(".errormsg").text("密码长度不能小于6位");
                    return;
                }
                if($(".code").val()==""){
                    $(".errormsg").text("验证码不能为空");
                    return;
                }
                if($(".code").val().length!=4){
                    $(".errormsg").text("验证码长度不正确");
                    return;
                }



                $.ajax({
                    type:'POST',
                    url:"<?php echo url('login/ajaxLogin'); ?>",
                    data:{username:$(".username").val(),password:$(".password").val(),code:$(".code").val()},
                    dataType:'json',
                    success:function (data) {
                        console.log(data);
                        if(data.staut=='1'){
							window.location.href="<?php echo url('admin/index/index'); ?>";
                        }else{
                            $(".errormsg").text(data.msg);
                            changeCode();
                        }
                    },
                });


            })
            $('.imgCode').click(function () {
                changeCode();
            })
            function changeCode(obj) {
               $(".imgCode").attr('src',$(".imgCode").attr('src')+'?');
            }
        })
    </script>
</head>
<body>

	<div class="login">
		<img src="/static/admin/image/logo_login.jpg" class="logo"/>
		<p class="loginTip">欢迎您回来</p>
		<ul>
			<li><input type="text" placeholder="请输入用户名" name="username" class="username"/></dd></li>
			<li><input type="text" placeholder="请输入密码" name="password" class="password"/></li>
			<li>
				<input type="text" placeholder="验证码" name="code" class="code"/>
				<img src="<?php echo captcha_src(); ?>" alt="captcha" class="imgCode" />
			</li>

			<li><input type="button" value="立即登陆" class="registerBtn"/></li>
			
		</ul>
		<a href="<?php echo url('register/index'); ?>" class='hrefAddress'>未注册,请先注册</a>
		<div class="errormsg"></div>
	</div>

</body>
</html>