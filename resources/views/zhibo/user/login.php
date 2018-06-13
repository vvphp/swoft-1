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
                        <input type="text" name="phone" lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
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
                        <input type="text" id="register_phone" name="phone"lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="nike_name" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <input type="hidden" value="<?php echo $token; ?>" name="token" id="token">
                <div class="layui-form-item">
                    <label class="layui-form-label">验证码</label>
                    <div class="layui-input-inline">
                        <input type="text" name="verCode" lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input" style="float: left;width: 53%">
                        <button type="button" class="layui-btn"   lay-filter="getCode" id="getCode" style="float: left; margin-left: 10px;">获取验证码</button>
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

<script src="/static/zhibo8/js/jquery1.11.1.min.js"></script>
<script src="/static/zhibo8/js/jquery.md5.js"></script>
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

        var phoneCheck = true;

        //自定义验证规则
        form.verify({
            pass: [/(.+){6,20}$/, '密码必须6到20位']
        });

        //监听登录
        form.on('submit(login)', function(data){
            var token = data.field.phone+','+data.field.password+"zxr";
            data.field.token = $.md5(token);
            $.post("/live/user/sigin",data.field,function(res){
                data = JSON.parse(res);
                layer.msg(data.msg);
                if(data.code == '1'){
                    //关闭当前窗口
                    layer.closeAll();
                }
            });
            return false;
        });

        //监听注册
        form.on('submit(register)', function(data){
            if(phoneCheck == false){
                layer.msg('手机号已存在');
                return false;
            }
            var token = data.field.phone+','+data.field.password+"zxr";
            data.field.token = $.md5(token);
            $.post("/live/user/register",data.field,function(res){
                data = JSON.parse(res);
                layer.msg(data.msg);
                if(data.code == '1'){
                    //关闭当前窗口
                   // layer.close(layer.index);
                    layer.closeAll();
                }
            });
            return false;
        });

        /**
         *判断手机是否存在
         * */
        $("#register_phone").blur(function(){
            var phone = $("#register_phone").val();
            if(phone.length != 11){
                return false;
            }
            var data = {"phone":phone};
            $.post("/live/user/verifyingPhone",data,function(res){
                data = JSON.parse(res);
                if(data.code== '-1'){
                    phoneCheck = false;
                    layer.msg(data.msg);
                }else{
                     phoneCheck = true;
                }
            });
        });

        /**
         * 获取验证码
          */
        $(document).on('click','#getCode',function(){
            var phone = $("#register_phone").val();
            var token = $("#token").val();
            if(phone.length == 0){
                layer.msg('请填写手机号');
                 return false;
            }
            if (!phone.match(/^[1][3,4,5,7,8][0-9]{9}$/)) {
                layer.msg('手机号不正确');
                return false;
            }
            if(phoneCheck == false){
                layer.msg('手机号已存在');
                return false;
            }
            var data = {"phone":phone,'token':token};
            $.post("/live/code/sendSmsCode",data,function(res){
                 data = JSON.parse(res);
                 if(data.code== '-1'){
                     layer.msg(data.msg);
                 }
            });
        });
    });

</script>

</body>
</html>