/**
 * Created by Administrator on 2018/4/25.
 */
$(function () {
    var $back = $('#back');
    var $submitBtn = $('#submit-btn');
    // 获取验证吗
    $('#authCodeBtn').click(function (event) {
        var phone_num = $(" input[ name='phone_num' ] ").val()
        url = "live/sms/sendCode?phone_num="+phone_num;
        $(this).html('已发送').attr('disabled', true);
        $.get(url, function (data) {
            // TODO: 将下面3行代码删除
            if (data.status == 'ok') {
                alert('发送完成');
            }
        });
    });

    // 提交表单
    $submitBtn.click(function (event) {
        event.preventDefault();
        var formData = $('form').serialize();
        // TODO: 请求后台接口跳转界面，前端跳转或者后台跳
        $.get("/live/login/signin?"+formData, function (data) {
              console.log(data);
            // location.href='index.html';
        });
    });

    // 返回上一页
    $back.click(function (e) {
         window.history.back();
    });
});
