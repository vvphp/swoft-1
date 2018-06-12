<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/zhibo8/layui/layui/css/layui.css"  media="all">
</head>
<body>

<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">登录</li>
        <li>注册</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form layui-form-pane" action="/live/user/sigin">
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" lay-verify="pass" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="login">登录</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="layui-tab-item">
            <form class="layui-form layui-form-pane" action="/live/user/register">
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username"lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">验证码</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input" style="float: left;width: 53%">
                        <button class="layui-btn" style="float: left; margin-left: 10px;">获取验证码</button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="register">注册</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 </div>

<script src="/static/zhibo8/layui/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'layedit', 'laydate','element'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
            ,laydate = layui.laydate;
        var $ = layui.jquery
            ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块

        //自定义验证规则
        form.verify({
            pass: [/(.+){6,12}$/, '密码必须6到12位']
        });

        //监听提交
        form.on('submit(login)', function(data){
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            })
            console.log(data);
            return false;
        });
    });
</script>

</body>
</html>