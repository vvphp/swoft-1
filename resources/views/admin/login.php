<?php $this->include('layouts/admin/head') ?>
<link href="/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="userName" name="userName" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input id="passwd" name="passwd" type="password" placeholder="密码"  class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="subsignin" type="button" onclick="subData()" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="footer">Copyright 图文直播系统 by H-ui.admin.page.v3.0</div>

<?php $this->include('layouts/admin/footer') ?>

<script type="text/javascript">
    function subData()
    {
        var userName = $("#userName").val();
        var passwd   = $("#passwd").val();
        if(userName.length == 0 || passwd == 0){
            alert("请输入用户名和密码");
            return false;
        }
        if(userName.length < 3 || passwd < 6){
            alert("请输入正确的用户名和密码");
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '/admin/index/signin',
            data: {"userName":userName,"passwd":passwd},
            dataType: 'json',
            success: function(data){
                console.log(data);
            }
        });

    }
</script>

</body>
</html>