<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录页</title>
    <link rel="stylesheet" type="text/css" href="/static/zhibo8/layer/theme/default/layer.css" />
    <link rel="stylesheet" type="text/css" href="/static/zhibo8/layer/theme/default/style.css" />
</head>
<body>

<div class="login-main">
    <header class="layui-elip">登录</header>
    <form class="layui-form">
        <div class="layui-input-inline">
            <input type="text" name="account" required lay-verify="required" placeholder="用户名" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline">
            <input type="password" name="password" required lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline login-btn">
            <button lay-submit lay-filter="login" class="layui-btn">登录</button>
        </div>
        <hr/>
        <p><a href="register.html" class="fl">立即注册</a></p>
    </form>
</div>


<script src="/static/zhibo8/js/jquery1.11.1.min.js"></script>
<script src="/static/zhibo8/layer/layer.js"></script>
<script type="text/javascript">
    layui.use(['form','layer','jquery'], function () {
        // 操作对象
        var form = layui.form;
        var $ = layui.jquery;
        form.on('submit(login)',function (data) {
            $.ajax({
                url:'login.php',
                data:data.field,
                dataType:'text',
                type:'post',
                success:function (data) {
                    if (data == '1'){
                        location.href = "../index.php";
                    }else{
                        layer.msg('登录名或密码错误');
                    }
                }
            })
            return false;
        })
    });
</script>
</body>
</html>