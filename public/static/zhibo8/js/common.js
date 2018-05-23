/**
 * Created by zhaoyuanming on 15/10/20.
 */
$(function () {
    $(".nav li").mouseover(function(){
        $(this).children("ul").show();
        $(this).mouseout(function(){
            $(this).children("ul").hide()
            $(this).children("ul").mouseover(function(){
                $(this).children("ul").show();
            });
        });
    });
});


