//jQuery.support.cors = true;

var dm_status = false;

var is_playoffs = $('title').text().indexOf('季后赛') > -1;

//Js start
$(function(){
    load_json();

    if((typeof danmu) == 'object'){
        if(danmu.flag){
            dm_status = true;
        }
    }

    $("#jiazaizhong .livetext").html('正在加载，请稍后！');
	
	if(typeof open_txt !== 'undefined' && open_txt > 0){
		$('.zhibo').append('<p id="apply_zb" style="position: absolute; top: 30%; left: 50%; transform: translateX(-50%); font-size: 18px;"><a href="//zhubo.zhibo8.cc/apply?saishi_id='+ p_saishi_id +'" style="color:blue" target="_blank"><u>申请主播这场比赛</u></a></p>');
	}

   var jdata_str = ''

	jdata_str = '<div class="jd_touming"></div>';
    jdata_str += '<div class="jd_tmpic"><img onclick="show_tj()" src="//static4style.oss-cn-hangzhou.aliyuncs.com/txt_pc_img%2Floading.png" alt="" /></div>';
	
	jdata_str = '<div id="jdata" class="rad5"><div class="jdata_tit">技术统计</div>'+ jdata_str +'</div>';

    $("#mdata").before(jdata_str);
    $("#mdata").hide();
	
    bifen.bifen.period_cn=p_match_time.substr(5,11);

    get_new_msg();
    open_timer();

    setTimeout(function (){
        $(".touming").show();
        $(".tmpic").show();
        $(".zhibo").prevAll().hide();
        $(".time_score").prevAll().hide();
    },500);

    $(".close").click(function(){
        $("#overDiv").hide();
        $("#bottomNav").hide();
    });

    //球队名称
    $(".home_team_name").html(avalon.filters.tlink(p_host));
    $(".visit_team_name").html(avalon.filters.tlink(p_guest));
	
	//
    $('.ht_name').html(avalon.filters.tlink(p_host));
    $(".vt_name").html(avalon.filters.tlink(p_guest));

    if(p_host_img!=''){
        $("#t1").attr('src','//duihui.qiumibao.com/nba/'+p_host_img+'.png');
		$('.t1_logo').attr('src','//duihui.qiumibao.com/nba/'+p_host_img+'.png'); //
    }
    if((p_host == '中国男篮' || p_host == '中国女篮' || p_host=='中国' || p_host=='中国女排') && p_host.indexOf('香港') == -1){
        $("#t1").attr('src','//duihui.qiumibao.com/nba/zhongguo.png');
    }

    if((p_guest == '中国男篮' || p_guest == '中国女篮' || p_guest=='中国' || p_guest=='中国女排') && p_guest.indexOf('香港') == -1){
        $("#t2").attr('src','//duihui.qiumibao.com/nba/zhongguo.png');
    }
    if(p_visit_img!=''){
        $("#t2").attr('src','//duihui.qiumibao.com/nba/'+p_visit_img+'.png');
		 $('.t2_logo').attr('src','//duihui.qiumibao.com/nba/'+p_visit_img+'.png'); //
    }
	
	//
	var host_link = avalon.filters.ilink(p_host);
	if(host_link !== ''){
		$("#t1a").attr({'href':host_link,'target':'_blank'})
	}
	var guest_link = avalon.filters.ilink(p_guest);
	if(guest_link !== ''){
		$("#t2a").attr({'href':guest_link,'target':'_blank'})
	}
	
	//固定顶部
	var ie6 = document.all;
	var dv = $('.topbar'), st;
	var toppx=85;
	dv.attr('otop', dv.offset().top); //存储原来的距离顶部的距离
	$(window).scroll(function () {
		st = Math.max(document.body.scrollTop || document.documentElement.scrollTop);
		if (st > (parseInt(dv.attr('otop')-0))) {
			if (ie6) {//IE6不支持fixed属性，所以只能靠设置position为absolute和top实现此效果
				dv.css({ position: 'absolute', top: st });
			}
			else if (dv.css('position') != 'fixed'){
				dv.css({ 'position': 'fixed', top: 0 ,'z-index':1999,'height' : '36px'});
				toppx=41;
			}
		} else if (dv.css('position') != 'static'){
			dv.css({ 'position': 'static' ,'height' : '35px'});
			toppx=85;
		}
	});

	$('.tbar').on('click',function(){
		var $that = $(this);
		
		var $choose = $that.data('class');
		
		$that.addClass('current');
		$that.siblings().removeClass('current');

		if($choose == 'zhibo'){
			//$('html,body').animate({scrollTop:$('.zhibo').offset().top - toppx + 29}, 300);
			$("html, body").animate({ scrollTop: 0 }, 300);
		}
		
		if($choose == 'shuju'){
			$(".tmpic:first").trigger("click");
			$('html,body').animate({scrollTop:$('.shuju').offset().top-toppx}, 1700);
			setTimeout(function(){
				$('html,body').animate({scrollTop:$('.shuju').offset().top-toppx}, 300);
			},1800);
		}
		if($choose == 'jingcai'){
			$('html,body').animate({scrollTop:$('.jc').offset().top-toppx-5}, 300);
			load_guess(0);
		}
	});
	
    //直播
    $(".qh1").click(function(){
        $(".qiehuan div").css("background-color",'#80B0DE');
        $(this).css("background-color",'#085EB3');
		$('html,body').animate({scrollTop:$('.zhibo').offset().top - toppx + 30}, 300);
    });

    //数据
    $(".qh2").click(function(){
        $(".qiehuan div").css("background-color",'#80B0DE');
        $(this).css("background-color",'#085EB3');
        $(".tmpic:first").trigger("click");
		$('html,body').animate({scrollTop:$('#mdata').offset().top-toppx}, 300);
    });

    //竞猜
    $(".qh3").click(function(){
        $(".qiehuan div").css("background-color",'#80B0DE');
        $(this).css("background-color",'#085EB3');
		$('html,body').animate({scrollTop:$('.jc').offset().top-toppx-5}, 300);
        load_guess(0);
    });

	//赛前
    $(".qh4").click(function () {
        $(".qiehuan div").css("background-color",'#80B0DE');
        $(this).css("background-color",'#085EB3');
		$('html,body').animate({scrollTop:$('#sqsj').offset().top-toppx-5}, 300);
    });

    //下拉加载更多
    $('.zhibo').scroll(function(){
        if(($('.zhibo_text').height()-$(".zhibo")[0].scrollTop)<1000){
            if(loading==false){
                loading=true;
                get_scroll();
            }
        }
    });

    $(".video a").mouseup(function(){
        $(".touming").show();
        $(".tmpic").show();
        close_timer();

        close_net=1;
        update_bifen=0; //更新全部

        if(dm_status){
            danmu.pause();
        }

        $.ajax({
            url: "//ping.qiumibao.com/ping/index.php?url="+encodeURIComponent($(this).attr("href"))+'&match_id='+p_saishi_id+"&t=" + (new Date()).getTime()+"&callback=?",
            type: "get",
            dataType: "json",
            success: function (data) {
                console.log(data);
            }
        });
    });

    $(".tmpic").click(function (){
    	$("#jdata").hide();
		$("#mdata").show();
		
		if($('title').html().indexOf('CBA') > 0){
			$('.chang').hide();
			$('.paixu').hide();
		}
		
        $(".touming").hide();
        $(".tmpic").hide();
        close_timer();
        open_timer();

        update_bifen=0; //更新全部
        user_pause=1; //暂停标记
		
		get_match_data('roster_oncourt');
		get_match_data('score_rank');
		get_match_data('stats_team');
		get_match_data('player');

        if(close_net==1){
            close_net=0;
            timeout_load();
        }

        if(dm_status){
            danmu.start(1);
        }
    });
    
    //外部跳入
    var redirect = J_get('redirect') + '';

    if(redirect != ''){
        if(redirect == 'zhibo'){
            //$("html, body").animate({ scrollTop: 0 }, 300);
        }
        if(redirect == 'shuju'){
            setTimeout(function(){
                $(".tmpic:first").trigger("click");
            },600);
            setTimeout(function(){
                $('html,body').animate({scrollTop:$('.shuju').offset().top-toppx}, 300);
            },2000);
        }
        if(redirect == 'jingcai'){
            setTimeout(function(){
                $('html,body').animate({scrollTop:$('.jc').offset().top-toppx-5}, 300);
                load_guess(0);
            },1000)
        }
        
        $(".tselect a").removeClass('current');
        $(".tselect a[data-class='" + redirect + "']").addClass('current');
    }
    //////

	//
    var $backToTopTxt = "返回顶部", $backToTopEle = $('<div class="backToTop"></div>').appendTo($("body"))
        .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 120);
        }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.show(): $backToTopEle.hide();
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 166);
        }
    };
    //var screenwidth=screen.availWidth;
    //var space = (screenwidth - 960)/2+960;
    //$backToTopEle.css("left",space+"px");
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });

    var room_id = window.location.pathname;

    $("body").append('<iframe src="//www.zhibo8.cc/test/ws.html?room_id='+room_id+ '" width="0" height="0" scrolling="no" frameborder="0" style="display:none;"></iframe>');
	
	//zhanbao
	$.getJSON('//m.zhibo8.cc/json/match/' + p_saishi_id + '.htm?r=' + Math.random(),function(data){
		var str = '';
		
		if(data.jijin_url != ''){
			str = '<a href="//www.zhibo8.cc'+ data.jijin_url +'">集锦</a>';
		}
		
		if(data.luxiang_url != ''){
			str += '<a href="//www.zhibo8.cc'+ data.luxiang_url +'">录像</a>';
		}
		
		if(data.zhanbao_url != ''){
			str += '<a href="//news.zhibo8.cc'+ data.zhanbao_url +'">战报</a>';
		}
		
		if(str !== ''){
			$('.tbar:last').after(str);
		}
	});
	
	get_match_data('bifen');
	
	if(typeof total_score_h === 'string' && total_score_h !== ''){
		$('.team_1 .home_team_name').text($('.team_1 .home_team_name').text() + '（' + total_score_h + '）');
		$('.team_2 .visit_team_name').text($('.team_2 .visit_team_name').text() + '（' + total_score_v + '）');
	}
	//收藏入口
	var tcollect='<style>.tselect a{padding:0;} a.tcollect{width: 40px;float: right;text-align: center; margin: 5px 0 0 -6px;color: #fff;border:1px solid #fff;background:none; line-height: 160%;font-size: 12px;padding: 0 2px;}</style>';
	var isCheck_url=location.pathname;
	//判断是否收藏
	$.ajax({
		type:"get",
		url:"//guanzhu.zhibo8.cc/favorites/isFav",
		data:{type:'saishi',url:isCheck_url},
		dataType:"jsonp",
		async:true,
		success:function(data){
//			console.log(data);
			if(data.status=='success'){
				var data=data.data;
				if(data.fav){
					tcollect+='<a href="javascript:;" class="tcollect rad3" isFav="true">已收藏</a>';
				}else{
					tcollect+='<a href="javascript:;" class="tcollect rad3" isFav="false">收藏</a>';
				}
				$(".topbar .fankui").after(tcollect);
				$(".topbar .tcollect").on("click",actionClt);
			}
		}
	});
	
	function actionClt(){
		var _this=this;
		var list='',dataObj={},obj={},url='';
		if($(this).attr("isFav")==='false'){
			var url='//guanzhu.zhibo8.cc/favorites/update';
		}else{
			var url='//guanzhu.zhibo8.cc/favorites/del';
		}
		obj['url']=location.pathname;
		obj['title']=document.title;
		list='['+JSON.stringify(obj)+']';
		dataObj={type:'saishi',list:list};
		$.ajax({
			type:"GET",
			url:url,
			dataType:"jsonp",
			data:dataObj,
			xhrFields: {
                withCredentials: true
            },
			success:function(data){
//				console.log(data);
				if(data.status=='success'){
					if($(_this).attr("isFav")==='false'){
						$(_this).attr("isFav",'true').text('已收藏');
					}else{
						$(_this).attr("isFav",'false').text('收藏');
					}
				}
			},
			error:function(data){
				console.log(data);
			}
		});
	};
});

var bifen_from = '';
var bifen_server = 'bifen4pc2';

//从页面读取参数
var host = encodeURI(p_host);
var guest = encodeURI(p_guest);
var game_date = p_game_date;
var saishi_id = p_saishi_id;

var server_name = '';

var sys_t = new Date();
var la=navigator.language||navigator.browserLanguage;
if(isNull(server_name)){
    console.log(sys_t.getTimezoneOffset());
    if(la.indexOf('en')>=0||sys_t.getTimezoneOffset()!=-480){
        server_name='dingshi145';
    }else{
        server_name='dingshi4pc';
    }
}

var server_data='dc4pc';

if(server_name=='dingshia'){server_data='dca';}
if(server_name=='dingshib'){server_data='dcb';}
if(server_name=='dingshic'){server_data='dc4pca';}
if(server_name=='dingshid'){server_data='dc4pcb';}
if(server_name=='dingshie'){server_data='dc4pcc';}

var urldc = '';
if(urldc !== ''){
	server_data = urldc;
}

//同步方式 start +++++++++++++++++++++++++++++++++
var user_pause=0,sid_line=0,sid_max=0,sid_min=0,live_num=0,per_num=2,push_ing=0,loading=false,close_net=0;
var load_down,db_count;
var update_bifen=1;  //一开始只更新比分 =1

setInterval("loading=false;",5000); //定时清除loading状态

//开启定时器
function open_timer(){
    load_down = setInterval("get_more()",1000); //底下更多
    db_count = setInterval(update_count,5000);
}

//关闭定时器
function close_timer(){
    clearInterval(load_down);
    clearInterval(db_count);
}

//获取最新
function get_new_msg(){
    var url='//' + server_name + '.qiumibao.com/livetext/data/cache/max_sid/' + saishi_id + '/0.htm?time=' +Math.random();

    $.ajax({url:url,timeout:5000,success:function(sid){
        //有更新
        sid=parseInt(sid);

        //暂停太久
        //if(user_pause==1 && (sid-30)>sid_max && sid_max>0){
        if((sid-30)>sid_max && sid_max>0){
            $("#livebox").empty(); //初始化
            sid_max=0;
            sid_min=0;
            live_num=0;

            user_pause=0;
        }

        if(sid>sid_max){
            sid_line=sid;
            get_live('+');
        }else{
            timeout_load();
        }
    },error:function (){
        timeout_load();

        if($("#jiazaizhong").length==1){
            net_status();
        }
    }});
}

//网络
function net_status(){
    //读取最早接口数据
    if(game_id==0 && match_ing()){
        var score_url=window.location.href + '';
        score_url='//m.zhibo8.cc/json/bifen/zhibo/' + score_url.toLowerCase().split('/zhibo/')[1];

        $.ajax({
            url:score_url+'?jq='+Math.random(),
            timeout:5000,
            dataType:'json',
            success:function(data){
                //$(".host_score").html(data.bifen_a);
                //$(".visit_score").html(data.bifen_b);

                //$("#jiazaizhong .livetext").html('比赛已开始，请查看上方实时比分！');
            },
            error:function(x){
                //$("#jiazaizhong .livetext").html('<a href="'+window.location+'">获取失败，请点此刷新！</a>');
            }
        });

        $("#jiazaizhong .livetext").html('暂无数据！');
        bifen.bifen.period_cn='正在比赛';
    }

    if(!match_ing()){
        $("#jiazaizhong .livetext").html('直播暂未开始，敬请关注！');
        bifen.bifen.period_cn=p_match_time.substr(5,11);
    }
}

//比赛中...
function match_ing(){
    if((typeof p_match_time)=='string'){
        if(p_match_time.localeCompare(now_time())<=0){
            return true;
        }
    }

    return false;
}

//时间
function now_time(){
    var today=new Date();
    var y=today.getFullYear();
    var m=checkTime(today.getMonth()+1);
    var d=checkTime(today.getDate());
    var h=checkTime(today.getHours());
    var n=checkTime(today.getMinutes());
    var s=checkTime(today.getSeconds());

    return  y + '-' + m + '-' + d + ' ' + h + ':' + n + ':' +s;
}
function checkTime(i){
    if (i<10){i="0" + i;}

    return i;
}

//刷新
function timeout_load(){
    if(close_net==1){return false;}

    setTimeout(get_new_msg,1000);
}

//数据获取
function get_live(type){
    var url_sid=get_url_sid(type);

    var url='';

    if(per_num==2){
        url='//' + server_name + '.qiumibao.com/livetext/data/cache/livetext/' + saishi_id + '/0/lit_page_2/' + url_sid + '.htm';
    }

    if(per_num==5){
        url='//' + server_name + '.qiumibao.com/livetext/data/cache/livetext/' + saishi_id + '/0/lit_page_5/' + url_sid + '.htm';
    }

    if(per_num==10){
        url='//' + server_name + '.qiumibao.com/livetext/data/cache/livetext/' + saishi_id + '/0/page_10/' + url_sid + '.htm';
    }

    url+='?get='+Math.random();

    $.ajax({url:url,timeout: 5000,success:function(data){
            process_data(data); //数据处理

            if(type=='-'){
                loading=false;
            }else{
                timeout_load();
            }
        },error:function (){
            if(type=='+'){
                timeout_load();
            }
        },
            dataType:'json'}
    );
}

//加载更多
function get_more(){
    var load_def=15;

    if(live_num>load_def){
        return false;
    }

    if(live_num<=load_def && sid_max>0 && sid_min>per_num){
        get_live('-');
    }
}

//滚动条加载
function get_scroll(){
    if(sid_min>per_num && sid_max>0){
        get_live('-');
    }
}

//获取地址栏sid参数
function get_url_sid(type){
    var sid=0;

    if(type=='+'){
        sid=sid_max + 1;
    }else{
        sid=sid_min - 1;
    }

    //第一次加载
    if(sid_max==0 && sid_line>0){
        sid=sid_line;
    }

    //不能小于最小
    if(sid<per_num){sid=per_num;}

    //返回所在sid对应的那一段
    return Math.ceil(sid/per_num)*per_num;
}

//同步方式 end

var advv={
    "player":{
        "id": "0",
        "code": 0,
        "data": {
            "host": {
                "team_id": 0,
                "team_name_cn": "主队",
                "on": [
                    {
                        "player_id": "",
                        "player_name_cn": "",
                        "player_logo": "",
                        "position": "",
                        "minutes": "",
                        "field": "",
                        "three": "",
                        "free": "",
                        "off": "",
                        "def": "",
                        "off+def": "",
                        "ass": "",
                        "ste": "",
                        "blo": "",
                        "turn": "",
                        "fouls": "",
                        "points": ""
                    }
                ],
                "off": [
                    {
                        "player_id": "",
                        "player_name_cn": "",
                        "player_logo": "",
                        "position": ""
                    }
                ],
                "total": {
                    "minutes": null,
                    "field_made": null,
                    "field_att": null,
                    "three_made": null,
                    "three_att": null,
                    "free_made": null,
                    "free_att": null,
                    "off": null,
                    "def": null,
                    "off+def": null,
                    "ass": null,
                    "ste": null,
                    "blo": null,
                    "turn": null,
                    "fouls": null,
                    "points": null,
                    "field": null,
                    "three": null,
                    "free": null
                }
            },
            "guest": {
                "team_id": 0,
                "team_name_cn": "客队",
                "on": [
                    {
                        "player_id": "",
                        "player_name_cn": "",
                        "player_logo": "",
                        "position": "",
                        "minutes": "",
                        "field": "",
                        "three": "",
                        "free": "",
                        "off": "",
                        "def": "",
                        "off+def": "",
                        "ass": "",
                        "ste": "",
                        "blo": "",
                        "turn": "",
                        "fouls": "",
                        "points": ""
                    }
                ],
                "off": [
                    {
                        "player_id": null,
                        "player_name_cn": null,
                        "player_logo": null,
                        "position": null
                    }
                ],
                "total": {
                    "minutes": null,
                    "field_made": null,
                    "field_att": null,
                    "three_made": null,
                    "three_att": null,
                    "free_made": null,
                    "free_att": null,
                    "off": null,
                    "def": null,
                    "off+def": null,
                    "ass": null,
                    "ste": null,
                    "blo": null,
                    "turn": null,
                    "fouls": null,
                    "points": null,
                    "field": null,
                    "three": null,
                    "free": null
                }
            }
        }
    },
    "stats_team":{
        "id": 0,
        "code": 0,
        "data": {
            "guest": {
                "team_info": {
                    "team_id": null,
                    "team_name": "客场"
                },
                "score_board": {
                    "name": "得分/篮板",
                    "points": null
                },
                "field_rate": {
                    "name": "投篮命中率",
                    "points": null
                },
                "three_rate": {
                    "name": "三分命中率",
                    "points": null
                },
                "free_rate": {
                    "name": "罚球命中率",
                    "points": null
                },
                "fp_points": {
                    "name": "快攻/内线得分",
                    "points": null
                },
                "fouls": {
                    "name": "技术/恶意犯规",
                    "points": null
                },
                "diq_ejt": {
                    "name": "六犯/被逐出场",
                    "points": null
                },
                "biggest": {
                    "name": "最大领先分数",
                    "points": null
                }
            },
            "host": {
                "team_info": {
                    "team_id": null,
                    "team_name": "主场"
                },
                "score_board": {
                    "name": "得分/篮板",
                    "points": null
                },
                "field_rate": {
                    "name": "投篮命中率",
                    "points": null
                },
                "three_rate": {
                    "name": "三分命中率",
                    "points": null
                },
                "free_rate": {
                    "name": "罚球命中率",
                    "points": null
                },
                "fp_points": {
                    "name": "快攻/内线得分",
                    "points": null
                },
                "fouls": {
                    "name": "技术/恶意犯规",
                    "points": null
                },
                "diq_ejt": {
                    "name": "六犯/被逐出场",
                    "points": null
                },
                "biggest": {
                    "name": "最大领先分数",
                    "points": null
                }
            }
        }
    },
    "roster_oncourt":{
        "id": "0",
        "code": 0,
        "data": {
            "host": {
                "0": {
                    "player_id": 0,
                    "points": 0,
                    "fouls": 0,
                    "player_name": 0,
                    "if_pic": 0,
                    "period": 0,
                    "game_clock": 0,
                    "event": 0,
                    "player_logo":0
                }
            },
            "guest": {
                "0": {
                    "player_id": 0,
                    "points": 0,
                    "fouls": 0,
                    "player_name": 0,
                    "if_pic": 0,
                    "period": 0,
                    "game_clock": 0,
                    "event": 0,
                    "player_logo":0
                }
            }
        }
    },
    "score_rank":{
        "id": "0",
        "code": 0,
        "data": {
            "host": {
                "team_info": {
                    "team_id": 0,
                    "team_name": "主场"
                },
                "points": {
                    "player_id": null,
                    "name": "得分",
                    "points": null,
                    "player_name": ''
                },
                "off+def": {
                    "player_id": null,
                    "name": "篮板",
                    "points": null,
                    "player_name": ''
                },
                "ass": {
                    "player_id": null,
                    "name": "助攻",
                    "points": null,
                    "player_name": ''
                },
                "ste": {
                    "player_id": null,
                    "name": "抢断",
                    "points": null,
                    "player_name": ''
                },
                "blo": {
                    "player_id": null,
                    "name": "盖帽",
                    "points": null,
                    "player_name": ''
                },
                "minutes": {
                    "player_id": null,
                    "name": "时间",
                    "points": null,
                    "player_name": ''
                },
                "turn": {
                    "player_id": null,
                    "name": "失误",
                    "points": null,
                    "player_name": ''
                },
                "per_fouls": {
                    "player_id": null,
                    "name": "犯规",
                    "points": null,
                    "player_name": ''
                }
            },
            "guest": {
                "team_info": {
                    "team_id": null,
                    "team_name": "客场"
                },
                "points": {
                    "player_id": null,
                    "name": "得分",
                    "points": null,
                    "player_name": ''
                },
                "off+def": {
                    "player_id": null,
                    "name": "篮板",
                    "points": null,
                    "player_name": ''
                },
                "ass": {
                    "player_id": null,
                    "name": "助攻",
                    "points": null,
                    "player_name": ''
                },
                "ste": {
                    "player_id": null,
                    "name": "抢断",
                    "points": null,
                    "player_name": ''
                },
                "blo": {
                    "player_id": null,
                    "name": "盖帽",
                    "points": null,
                    "player_name": ''
                },
                "minutes": {
                    "player_id": null,
                    "name": "时间",
                    "points": null,
                    "player_name": ''
                },
                "turn": {
                    "player_id": null,
                    "name": "失误",
                    "points": null,
                    "player_name": ''
                },
                "per_fouls": {
                    "player_id": null,
                    "name": "犯规",
                    "points": null,
                    "player_name": ''
                }
            }
        }
    },
    "score_period":{
        "id": "0",
        "code": 0,
        "data": {
            "remain": {
                "livecast_id": "0",
                "live": "0",
                "date": 0,
                "time": 0,
                "status": "比赛未开始",
                "period": 0
            },
            "host": {
                "team_id": 0,
                "team_conference": 0,
                "team_rank": 0,
                "full_timeouts": "0",
                "short_timeouts": "0",
                "team_fouls": 0,
                "wins": 0,
                "losses": 0,
                "scores": [
                    "0",
                    "0",
                    "0",
                    "0"
                ],
                "team_name": "主队"
            },
            "guest": {
                "team_id": 0,
                "team_conference": 0,
                "team_rank": 0,
                "full_timeouts": "0",
                "short_timeouts": "0",
                "team_fouls": 0,
                "wins": 0,
                "losses": 0,
                "scores": [
                    "0",
                    "0",
                    "0",
                    "0"
                ],
                "team_name": "客队"
            }
        }
    },
    "score_team":{
        "id": "0",
        "code": 0,
        "data": {
            "guest": {
                "team_id": 0,
                "color": 0,
                "area": 0,
                "score": 0,
                "full_timeouts": "0",
                "short_timeouts": "0",
                "team_fouls": 0,
                "fast_points": 0,
                "points_paint": 0,
                "off_turnovers": 0,
                "biggest": 0,
                "tec_fouls": 0,
                "flag": 0,
                "disqualifications": 0,
                "ejections": 0,
                "team_name": 0
            },
            "host": {
                "team_id": 0,
                "color": 0,
                "area": 0,
                "score": 0,
                "full_timeouts": "0",
                "short_timeouts": "0",
                "team_fouls": 0,
                "fast_points": 0,
                "points_paint": 0,
                "off_turnovers": 0,
                "biggest": 0,
                "tec_fouls": 0,
                "flag": 0,
                "disqualifications": 0,
                "ejections": 0,
                "team_name": 0
            }
        }
    },
    "bifen":{
		"id": "0",
		"sdate": "",
		"time": "",
		"url": "",
		"type": "",
		"start": "",
		"home_team": "主队",
		"visit_team": "客队",
		"home_score": "0",
		"visit_score": "0",
		"team1_scores": [
			"0",
			"0",
			"0",
			"0",
			"",
			"",
			"",
			""
		],
		"team2_scores": [
			"0",
			"0",
			"0",
			"0",
			"",
			"",
			"",
			""
		],
		"period_cn": "未赛",
		"code": "0",
	}
};

///////////////////////////////

//avalon start
// avalon.config({
    // interpolate: ["<!--","-->"]
// });

//////
var html_title = $('title').html() , isNba = false , isCba = false, isOther = false;

if(html_title.indexOf('NBA') > -1){
	isNba = true;
}

if(html_title.indexOf('CBA') > -1 && html_title.indexOf('WCBA') === -1){
	isCba = true;
	$('.sj_table').each(function(){
		$(this).find('td:eq(3)').text('投篮');
	});
}


if((html_title.indexOf('排') > -1 && html_title.indexOf('F1') === -1) || (html_title.indexOf('网') > -1 && html_title.indexOf('篮网') === -1) || html_title.indexOf('乒乓球') > -1 || html_title.indexOf('羽毛') > -1){
	isOther = true;
	
	var $_tr = $('.bf_table tr:eq(0)');
	$_tr.find('td').eq(5).text('5th');
	$_tr.find('td').eq(6).text('6th');
	$_tr.find('td').eq(7).text('7th');
	
	$('.host_score, .visit_score').css('font-size', '16px');
}

avalon.filters.ilink = function(team){
	var type = '', ret = '';
	
	if(team == '直播吧商城' || team == '双十一'){
		return '//daogou.zhibo8.cc/';
	}
	
	if(isNba){type = 'nba';}
	if(isCba){type = 'cba';}

    if(type == 'nba'){
        ret = '//data.zhibo8.cc/nbaData/team/#/team?teamName=' + encodeURIComponent(team);
    }else if(type == 'cba'){
        ret = '//data.zhibo8.cc/html_' + type + '/team.html?team=' + encodeURIComponent(team);
    }
	return ret;
}

avalon.filters.tlink = function(team){
	var type = '', ret = team;
	
	if(team == '直播吧商城' || team == '双十一'){
		return '<a href="//daogou.zhibo8.cc/" target="_blank">' + team + '</a>';
	}
	
	if(isNba){type = 'nba';}
	if(isCba){type = 'cba';}
	
	if(type == 'cba'){
		ret = '<a href="//data.zhibo8.cc/html_' + type + '/team.html?team=' + encodeURIComponent(team) + '" target="_blank">' + team + '</a>';
	}else if(type == 'nba'){
        ret = '<a href="//data.zhibo8.cc/nbaData/team/#/team?teamName=' + encodeURIComponent(team) + '" target="_blank">' + team + '</a>';
    }
	
	return ret;
}

avalon.filters.plink = function(player ,team){
	var type = '', ret = player;
	
	if(isNba){type = 'nba';}
	if(isCba){type = 'cba';}
	
	if(type == 'cba'){
		ret  = '<a href="//data.zhibo8.cc/html_' + type + '/player.html?team=' + encodeURIComponent(team);
		ret += '&player=' + encodeURIComponent(player) + '" target="_blank">' + player + '</a>';
	}else if(type == 'nba'){
        ret  = '<a href="//data.zhibo8.cc/nbaData/player/#/shuju?teamName=' + encodeURIComponent(team);
        ret += '&playerName=' + encodeURIComponent(player) + '" target="_blank">' + player + '</a>';
    }
	
	return ret;
}
//////

var roster_player = [], s_player_list = {}; //增加球员在场上属性

var json_data,player_data;
//球员当场统计 //实时技术统计
var statistics  = avalon.define("statistics", function(vm){
    vm.statistics  = {};
});
//球队当场比赛各项数据 //白表格-右
var stats_team = avalon.define("stats_team", function(vm){
    vm.stats_team = {};
});
//场上球员得分犯规数 //场上球员
var roster_oncourt = avalon.define("roster_oncourt", function(vm){
    vm.roster_oncourt = {};
    vm.roster_oncourt_is_show = false;
});
//各项最高 //白表格-左
var score_rank = avalon.define("score_rank", function(vm){
    vm.score_rank = {};
});
//比赛状态 //几胜几负 --未用
var score_period = avalon.define("score_period", function(vm){
    vm.score_period = {};
});
//球队统计 //统计表格底部
var score_team = avalon.define("score_team", function(vm){
    vm.score_team = {};
});
//球队比分 //顶部比分栏
var bifen = avalon.define("bifen", function(vm){
    vm.bifen = {};
});

//竞猜
var guess = avalon.define("guess",function (vm){
    vm.array=[];
    vm.array=JSON.parse('[{"id":"6761","filename":"2015-zuqiu-0804shanghaishanggangvsmadelijingji","type":"","title":"\u3010\u8db3\u7403\u53cb\u8c0a\u8d5b \u4e0a\u6d77\u4e0a\u6e2f\u8fdb\u7403\u3011\u672c\u573a\u6bd4\u8d5b\uff0c\u4e0a\u6d77\u4e0a\u6e2f\u80fd\u5426\u53d6\u5f97\u8fdb\u7403\uff1f\uff0808\u670804\u65e5 19:00\uff09 ","description":"","mingold":"1","status":"normal","terminaltime":"2015-08-01 19:00:00","creater":"\u94dc\u724c\u7ecf\u7eaa\u4eba","updater":"","createtime":"2015-07-26 09:38:12","updatetime":"0000-00-00 00:00:00","items":[{"id":"13877","guess_id":"6761","optName":"\u80fd","optNum":"499","odds":"1.9","status":"0","createtime":"2015-07-26 09:38:15","updatetime":"0000-00-00 00:00:00","creater":"\u94dc\u724c\u7ecf\u7eaa\u4eba","updater":"","gold":"340129"},{"id":"13878","guess_id":"6761","optName":"\u4e0d\u80fd","optNum":"100","odds":"1.9","status":"0","createtime":"2015-07-26 09:38:17","updatetime":"0000-00-00 00:00:00","creater":"\u94dc\u724c\u7ecf\u7eaa\u4eba","updater":"","gold":"49380"}],"verifier":"","maxgold":"2000","answer_id":"0","g_order":"0","num":"599","gold":"389509","open_status":null}]');

    vm.arrtype=0;

    //user.jc_task.userinfo.gold=0;

    vm.show=function(guess_id,answer_id,odds,maxgold){
        user.order= {"guess_id":guess_id,"answer_id":answer_id,"odds":odds,"maxgold":maxgold};

        $('#bottomNav').show();
        $('#overDiv').show();

        //弹出框初始化
        $('.alert').html('');
        $('.alert').removeClass('alert-success');
        $('.alert').removeClass('alert-danger');

        if(!cookie('bbs_username')){
            $('.alert').html('请登陆后进行操作');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            $('.modal-header b').html(0);
        }else{
            //用户金币数量
            if(user.jc_task.userinfo.gold == 0){
                $.getJSON('//guess.zhibo8.cc/guess/ajax/encourageInfo.php?onlygold=1&callback=?',function(data){
                    user.jc_task.userinfo.gold = data.userinfo.gold;
                });
            }
        }
    };

    vm.reloadGuess = function(){
        vm.array=[];
        load_guess(1);
    };

});

//用户信息
var bbs_username = cookie('bbs_username');
var host_url = '//guess.zhibo8.cc';

var user = avalon.define("user",function(vm){
    vm.jc_task = {};
    vm.order = {};

    vm.jc_task.userinfo= {"gold":0};
    vm.order= {"guess_id":0,"answer_id":0,"odds":0,"maxgold":0};

    vm.income = function(){
        var num =Math.floor($(this).val());
        var user_gold = Math.floor($('.modal-header b').html());
        if(!bbs_username){
            $('.alert').html('请登陆后进行操作');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }
        if(num<=0){
            $('.alert').html('投注金币要大于0');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }else{
            $('.alert').html('');
            $('.alert').removeClass('alert-danger');
            $('.alert').removeClass('alert-success');
        }
        if(num>user_gold){
            $('.alert').html('您的金币不够');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }else{
            $('.alert').html('');
            $('.alert').removeClass('alert-danger');
            $('.alert').removeClass('alert-success');
        }

        var odds =  $("input[name='odds']").val();
        var result = Math.floor(num*odds);
        $('.earn_gold').html(result);
    };

    vm.tz_submit = function(){
        var num =Math.floor($("input[name='number']").val());
        var user_gold = Math.floor($('.modal-header b').html());

        if(!bbs_username){
            $('.alert').html('请登陆后进行操作');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }

        if(num<=0){
            $('.alert').html('投注金币要大于0');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }else{
            $('.alert').html('');
            $('.alert').removeClass('alert-danger');
            $('.alert').removeClass('alert-success');
        }

        if(num>user_gold){
            $('.alert').html('投注金币超过限制');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('.earn_gold').html(0);
            return false;
        }else{
            $('.alert').html('');
            $('.alert').removeClass('alert-danger');
        }

        var answer_id = $("input[name='answer_id']").val();
        var guess_id = $("input[name='guess_id']").val();

        $.getJSON(host_url+"/guess/ajax/guessOrderSave.php?answer_id="+answer_id+"&guess_id="+guess_id+"&credit="+num+'&callback=?',function(data){
            if(data.code==0){
                var result_data = data.data;
                //var guess_id = $("input[name='guess_id']").val();

                user.jc_task.userinfo.gold = data.data.user_gold;

                $('.alert').html('投注成功');
                $('.alert').addClass('alert-success');

                //更新投注信息
                $('#g_'+guess_id+' .jcli_rp').each(function(i){
                    var percent = Math.floor(100*(result_data.items[i].optNum/result_data.num));

                    $(this).find(".optNum").html(result_data.items[i].optNum);
                    $(this).find(".gold").html(result_data.items[i].gold);
                    $(this).find(".jcli_rp_jd_wz").html(percent+"%");
                    $(this).find(".jcli_rp_jd_k").css("width",parseInt(percent)+"%");
                });

                setTimeout(function(){
                    $('#bottomNav').hide();
                    $('#overDiv').hide();
                },500);
            }else{
                $('.alert').html(data.info);
                $('.alert').addClass('alert-danger');
            }
        });
    };
});

var liveguess = avalon.define("liveguess",function (vm){
    vm.array=[];
});

//文字列表竞猜投注中转
function touzhu(str){
    str+='';

    if(str.indexOf('|')==-1){return;}

    var arr=str.split('|');

    if(arr.length==4){
        guess.show(arr[0],arr[1],arr[2],arr[3]);
    }
}

//jc
var jc_ids='',jc_lg=[];

function load_guess(reload){
    if(guess.arrtype == 0){
        guess.array = [];
        guess.arrtype=1;
    }

    if(guess.array.length>0 && reload==0){return;} //成功后不再重复更新

    $.ajax({
        url:'//guess.zhibo8.cc/guess/?file='+filename+'&format=json',
        dataType:'jsonp',
        timeout:3000,
        success:function(data){
            for(var i in data.guess){
                jc_ids+=','+data.guess[i].id;
            }

            guess.array=data.guess.concat(jc_lg); //文字直播里的竞猜也加入
        },
        error:function(){
            guess.array=[];
            $(".jc li .jcli_tit:first").html('<a href="javascript:;" onclick="$(this).text(\'加载中...\');load_guess(0);">点击重新加载</a>');
        }
    });
}
//avalon

var game_id=p_saishi_id,game_over=0,player_now_code=0,stats_team_now_code=0,roster_oncourt_now_code=0, score_rank_now_code=0,score_period_now_code=0,bifen_now_code=0,score_team_now_code=0;

/////////////////////////////////////////////////

var db_code={"player":0,"stats_team":0,"roster_oncourt":0,"score_rank":0,"score_period":0,"score_team":0};

//更新统计
function update_count(){
    if(game_id<1 || (game_over==-1 && update_bifen==1)){return false;}

    var url;

    //只更新比分

	url="//" + bifen_server + ".qiumibao.com/json/"+game_date+"/"+p_saishi_id+"_code.htm?get="+Math.random();

	//比分一直都更新
	$.get(url,function(data){
		if(data.code != bifen_now_code){
			get_match_data('bifen');

			bifen_now_code = data.code;
		}
	},'json');
	
    if(update_bifen!=1){
        url="//" + server_data + ".qiumibao.com/dc/matchs/data/"+game_date+"/"+game_id+"_v.htm?get="+Math.random();

        $.get(url,function(data){
            for(var type in db_code){
                if(data[type] != db_code[type]){
                    get_match_data(type);

                    db_code[type]=data[type]; //刷新
                }
            }
        },'json');
    }

    if(game_over == -1 && update_bifen == 0){
        update_bifen = 1;
    }
}
/////////////////////////////////////////////////

//载入预加载数据
function load_json(){
    //球员当场统计
    json_data = advv.player;
    statistics.statistics = json_data.data;

    //球队当场比赛各项数据
    json_data = advv.stats_team;
    stats_team.stats_team = json_data.data;

    //场上球员得分犯规数
    json_data = advv.roster_oncourt;
    roster_oncourt.roster_oncourt = json_data.data;

    //各项最高
    json_data = advv.score_rank;
    score_rank.score_rank = json_data.data;
    roster_oncourt.roster_oncourt_is_show = false;

    //比赛状态
    json_data = advv.score_period;
    score_period.score_period = json_data.data;

    //球队统计
    json_data = advv.score_team;
    score_team.score_team = json_data.data;

    //球队比分
    bifen.bifen = advv.bifen;
}


					
function insert_on_line(){
	if(typeof s_player_list.host !== 'undefined'){
		var p = {};

		for(var i in s_player_list.host.on){
			p = s_player_list.host.on[i];
			
			s_player_list.host.on[i]['on_line'] = false;
			if(roster_player.indexOf && roster_player.indexOf(parseInt(p.player_id)) > -1){
				s_player_list.host.on[i]['on_line'] = true;
			}
		}
		
		for(var i in s_player_list.guest.on){
			p = s_player_list.guest.on[i];
			
			s_player_list.guest.on[i]['on_line'] = false;
			if(roster_player.indexOf && roster_player.indexOf(parseInt(p.player_id)) > -1){
				s_player_list.guest.on[i]['on_line'] = true;
			}
		}
		
		statistics.statistics = s_player_list;
	}
}

//统计数据
function get_match_data(type){
	
	var data_url = "//" + server_data + ".qiumibao.com/dc/matchs/data/"+game_date+"/"+type+"_"+game_id+".htm?get="+Math.random();
	
	if(type == 'bifen'){
		data_url = "//" + bifen_server + ".qiumibao.com/json/"+game_date+"/"+p_saishi_id+".htm?get="+Math.random();
	}
	
    $.ajax({
        type: "get",
        dataType: "json",
        async: true,
        url: data_url,
        success: function(data){
			
			//球队比分
			if(type=='bifen'){
				bifen_now_code = data.code;

				//禁止未赛的时候数据更新
				/*
				if(json_data.data.period_cn != '未赛'){
				   if(json_data.data.Team1 == p_host || json_data.data.Team2 == p_guest){
						var t_bifen = json_data.data.team1_scores;
						json_data.data.team1_scores = json_data.data.team2_scores;
						json_data.data.team2_scores = t_bifen;
					}
					
					if($("title").html().indexOf('CBA') > -1){
						json_data.data['period_cn'] = $(".mtime").html();
					}
					
					 bifen.bifen = json_data.data;
				}
				*/
				
				var quarter = 4;
				
				for (var i in data.team1_scores){
					if(parseInt(i) > 3){
						if(parseInt(data.team1_scores[i]) > 0 || parseInt(data.team2_scores[i]) > 0){
							quarter = parseInt(i) + 1;
						}
					}
				}

                if(bifen_from === ''){
					$(".host_score").html(data.home_score);
					$(".visit_score").html(data.visit_score);
				}

				data.quarter = quarter;
				bifen.bifen = data;

				//game_over=parseInt(json_data.data.period); //比赛结束 无需获取
				
				if(data.period_cn == '完赛'){
					setTimeout(function(){
						game_over = -1; //比赛结束 无需获取
					},10000);
				}
				
				if(typeof data.full_timeouts_1 !== 'undefined' && data.full_timeouts_1 !== ''){
					var span_tmp = '<span>'+(parseInt(data.full_timeouts_1) + parseInt(data.short_timeouts_1)) +'</span>';
					span_tmp += '<span>暂停</span>';
					span_tmp += '<span>'+(parseInt(data.full_timeouts_2) + parseInt(data.short_timeouts_2))+'</span>';
					
					var team1_fouls = '本节犯规：' + data.team_fouls_1;
					var team2_fouls = '本节犯规：' + data.team_fouls_2;
					
					if($('#pause-times').length > 0){
						$('#pause-times').html(span_tmp);
						$('.team_1 p:eq(1)').text(team1_fouls);
						$('.team_2 p:eq(1)').text(team2_fouls);
					}else{
						$('.bf_table').after('<div id="pause-times">' + span_tmp + '</div>');
						$('.team_1').append('<p>' + team1_fouls + '</p>');
						//$('.team_1 .home_team_name').text($('.team_1 .home_team_name').text() + '（' + data.big_score_1 + '）');
						
						$('.team_2').append('<p>' + team2_fouls + '</p>');
						//$('.team_2 .visit_team_name').text($('.team_2 .visit_team_name').text() + '（' + data.big_score_2 + '）');

						$('.bf_top').css('height', '141px');
						$('.bf_table').css('height', '54px').css('margin-top', '8px');
						$('.bf_box').css('height', '141px');
					}
				}
			}
			
            if(data.id>=0&&data.data!=null&&!$.isEmptyObject(data.data)) {
                json_data = data;
                //球员当场统计
                if(type=='player'){
                    player_data = data;
                    player_now_code = json_data.code;
                    if(typeof json_data.data.host.on == 'undefined'||typeof json_data.data.host.off == 'undefined'||typeof json_data.data.host.total == 'undefined'){
                        if(typeof json_data.data.host.on == 'undefined'||typeof json_data.data.guest.on== 'undefined'){
                            player_data.data.host.on = advv.player.data.host.on;
                            player_data.data.guest.on = advv.player.data.guest.on;
                            statistics.statistics = player_data.data;
                        }
                        if(typeof json_data.data.host.off == 'undefined'||typeof json_data.data.guest.off== 'undefined'){
                            player_data.data.host.off = advv.player.data.host.off;
                            player_data.data.guest.off = advv.player.data.guest.off;
                            statistics.statistics = player_data.data;
                        }
                        if(typeof json_data.data.host.total == 'undefined'||typeof json_data.data.guest.total== 'undefined'){
                            player_data.data.host.total = advv.player.data.host.total;
                            player_data.data.guest.total = advv.player.data.guest.total;
                            statistics.statistics = player_data.data;
                        }
                    }else {
                        //statistics.statistics = player_data.data;
                        
                        s_player_list = player_data.data;
                        insert_on_line();
                    }
                }
                //球队当场比赛各项数据
                if(type=='stats_team'){
                    stats_team_now_code = json_data.code;
                    stats_team.stats_team = json_data.data;
                }
                //场上球员得分犯规数
                if(type=='roster_oncourt'){
                    //球员头像
                    roster_oncourt_now_code = json_data.code;
                    roster_oncourt.roster_oncourt = json_data.data;

                    //11.13
                    if(roster_oncourt.roster_oncourt.host && roster_oncourt.roster_oncourt.host.team_info){
                        $(".chang_tit .home_team_name").html(roster_oncourt.roster_oncourt.host.team_info.team_name);
                        $(".chang_tit .visit_team_name").html(roster_oncourt.roster_oncourt.guest.team_info.team_name);
                    }
					
					roster_player = [];
					for(var i in json_data.data.host){
						if(i != 'team_info'){
							roster_player.unshift(parseInt(json_data.data.host[i]['player_id']));
						}
					}
					for(var i in json_data.data.guest){
						if(i != 'team_info'){
							roster_player.unshift(parseInt(json_data.data.guest[i]['player_id']));
						}
					}
					
					insert_on_line();

                    /*判断场上球员显示和隐藏*/
                    roster_oncourt.roster_oncourt_is_show = true;
                }

                //各项最高
                if(type=='score_rank'){
                    if(typeof json_data.data.host.team_info === 'object'){
						score_rank_now_code = json_data.code;
						score_rank.score_rank = json_data.data;
					}
                }
                //比赛状态
                if(type=='score_period'){
                    score_period_now_code = json_data.code;
                    score_period.score_period = json_data.data;

                    if(bifen.visit_img==null&&json_data.data.guest.team_id>0){
                        if(decodeURI(guest)=='老鹰'){
                            bifen.visit_img='//duihui.qiumibao.com/nba/laoying.png';
                        }else if(decodeURI(guest)=='骑士'){
                            bifen.visit_img='//duihui.qiumibao.com/nba/qishi.png';
                        }else if(decodeURI(guest)=='勇士'){
                            bifen.visit_img='//duihui.qiumibao.com/nba/yongshi.png';
                        }else if(decodeURI(guest)=='火箭'){
                            bifen.visit_img='//duihui.qiumibao.com/nba/huojian.png';
                        }else{
                            bifen.visit_img = '//i2.sinaimg.cn/ty/nba/stats2012/logo86/'+json_data.data.guest.team_id+'.png';
                        }
                    }

                    //$("#t2").attr('src',bifen.visit_img);

                    if(bifen.host_img==null&&json_data.data.host.team_id>0){
                        if(decodeURI(host)=='老鹰'){
                            bifen.host_img='//duihui.qiumibao.com/nba/laoying.png';
                        }else if(decodeURI(host)=='骑士'){
                            bifen.host_img='//duihui.qiumibao.com/nba/qishi.png';
                        }else if(decodeURI(host)=='勇士'){
                            bifen.host_img='//duihui.qiumibao.com/nba/yongshi.png';
                        }else if(decodeURI(host)=='火箭'){
                            bifen.host_img='//duihui.qiumibao.com/nba/huojian.png';
                        }else{
                            bifen.host_img = '//i2.sinaimg.cn/ty/nba/stats2012/logo86/'+json_data.data.host.team_id+'.png';
                        }
                    }

                    //$("#t1").attr('src',bifen.host_img);
                }
                //球队统计
                if(type=='score_team'){
                    score_team_now_code = json_data.code;
                    score_team.score_team = json_data.data;
                }
                
            }
        }
    })
}
////////////////////////////////////

//数据处理
function process_data(data){
    //只能同时处理一个
    if(push_ing==1){
        return false;
    }

    //非连续数据
    if(push_verify(data)===false){
        return false;
    }

    var len=data.length;
    var bf='',lv_sid=0;

    //最新的
    if(parseInt(data[len-1]['live_sid'])>sid_max){
        bf='before';

        //比分设置
		//if(isOther === false){ //06.21
			$('.host_score').html(data[len-1]['home_score']);
			$('.visit_score').html(data[len-1]['visit_score']);
			
			bifen_from = 'live';
		//}
    }else{
        //旧的倒序
        data.reverse();
    }

    push_ing=1; //标记

    for(var i in data){
        lv_sid=parseInt(data[i]['live_sid']);

        if((bf=='before' && lv_sid>sid_max) || (bf=='' && lv_sid<sid_min)){
            add_data(data[i],bf);
            live_num++;
        }

        if(lv_sid>sid_max){sid_max=lv_sid;} //最大sid

        if(lv_sid<sid_min || sid_min==0){sid_min=lv_sid;} //最小sid
    }
	
	var cba_set = false;
	
	//cba 12.23
	if(len > 0 && $("title").html().indexOf('CBA') > -1 && lv_sid>=sid_max){
		//$(".mtime").html(data[len-1]['pid_text']); //16.01.27 
		cba_set = true;
	}

    //每节比分
    if(len>0 && lv_sid>=sid_max){
        var bifen_arr=data[len-1]['period_score'].split("#");

        if(bifen_arr.length==2){
            // if(get_mstat(data[len-1]['live_pid']) != '未赛' && !cba_set){
                // bifen.bifen.period_cn=data[len-1]['live_ptime'] + ' ' + data[len-1]['pid_text'];
            // }
			
			var p_s1 = bifen_arr[0].split("|")[0];
			var p_s2 = bifen_arr[1].split("|")[0];
			
			if(p_s1 > 0 || p_s2 > 0){
				if(parseInt(data[len-1]['live_pid'])>4){
					bifen.bifen.quarter=parseInt(data[len-1]['live_pid']);
				}

				bifen.bifen.team1_scores=bifen_arr[0].split("|");
				bifen.bifen.team2_scores=bifen_arr[1].split("|");
			}

        }
    }

    //移除载入中...
    if(sid_max>0 && $("#jiazaizhong").length==1){$("#jiazaizhong").remove();}
    if(sid_max>0 && $("#apply_zb").length==1){$("#apply_zb").remove();}

    push_ing=0;
}

//比赛状态获取
function get_mstat(pid){
    var s='';

    pid=parseInt(pid);

    if(pid==-9){s='未赛';}
    if(pid==-5){s='休息';}
    if(pid==-1){s='完赛';}

    if(pid>=1 && pid<=4){s='第'+pid+'节';}
    if(pid>=5 && pid<=8){s='加时'+(pid-4);}

    return s;
}

//数据是否可插入
function push_verify(data){
    //是否连续数据
    var len=data.length;
    var status=false;

    //sid_min=1641;data[0]['live_sid']=1639;

    //同一段数据
    if(Math.ceil(data[0]['live_sid']/per_num)==Math.ceil(sid_max/per_num)){
        status=true;
    }

    //连续
    if((data[0]['live_sid']-1)==sid_max){
        status=true;
    }

    //上一段已经完成 两段连续
    if((sid_max % per_num)==0 && ((sid_max/per_num+1)==Math.ceil(data[0]['live_sid']/per_num))){
        status=true;
    }

    //===========
    //同一段上面已有
    //向下连续
    if((data[len-1]['live_sid']+1)==sid_min){
        status=true;
    }

    //上一段已经完成 两段连续
    if((sid_min % per_num)==1 && ((Math.ceil(sid_min/per_num)-1)==Math.ceil(data[0]['live_sid']/per_num))){
        status=true;
    }

    //第一次加载
    if(sid_max==0){
        status=true;
    }

    //alert(status);

    return status;
}

//数据插入
function add_data(data,bf){
    var str='',arrtmp;

    if (parseInt(data['guess_id']) > 0  || data['live_text']=='' || data['live_text']==' '){

        // if(parseInt(data['guess_id']) > 0 && jc_ids.indexOf(','+data['guess_id']) == -1){
        // if(guess.arrtype == 0){
        // guess.array = [];
        // guess.arrtype = 1;
        // }

        // arrtmp=JSON.parse(data['guess_data']);

        // guess.array.unshift(arrtmp);

        // jc_lg.push(arrtmp);
        // }

        if(parseInt(data['guess_id']) > 0){
            liveguess.array=[];

            arrtmp=JSON.parse(data['guess_data']);

            arrtmp.username=data['user_chn'];

            liveguess.array.push(arrtmp);

            str=$("#liveguess").html();
        }
    }else{
        str='<div class="username">' + data['user_chn'] + '</div>';

        var pic='',cls='',text=data['live_text'] + '';
        text = text.replace('点开后再次点击观看。', '').replace('[打开再次点击观看，打不开请升级到最新版]', '').replace('[打不开请升级到最新版]', '');

        //文字颜色
        if(!isNull(data['text_color'])){
            text='<span style="color:'+data['text_color']+'">' + text + '</span>';
        }

        //文字链接
        if(!isNull(data['text_url'])){
            text='<a href="'+data['text_url']+'" target="_blank">'+ text +'</a>';
        }
		else if(data['weibo_url'] && (data['weibo_url'] + '').indexOf('http') > -1){
			text='<a href="'+data['weibo_url']+'" target="_blank">'+ text +'</a>';
			data['img_url'] = '';
		}

        //图片
        if(!isNull(data['img_url'])){
			var $keywords = $('meta[name="keywords"]').attr('content') || '';

			if(($keywords.indexOf('NBA') >= 0 && $keywords != '篮球,NBA') || data['user_id'] == '2'){
				data['img_url'] = data['img_url'].replace('&_abc=.gif', '');
				text='<a href="'+data['img_url']+'" target="_blank">'+ text +'</a>';
			}else{
				pic='<p><a href="'+data['img_url']+'" target="_blank"><img src="'+data['img_url']+'" alt="" /></a></p>';
			}
        }

        str+='<div class="livetext">' + pic + text + '</div>';
        str+='<div class="period">' + (data['home_score'] + '').replace(/\(.*?\)/g, '')+'-'+ (data['visit_score'] + '').replace(/\(.*?\)/g, '') + '</div>';

        //8.26
        if(data['pid_text'].indexOf('局')>0 && data['pid_text'].indexOf(' ') > 0){
            str+='<div class="score">' + data['pid_text'].substr(data['pid_text'].indexOf('局')+2) + '</div>';
        }else if(data['pid_text'].indexOf('盘')>0){
            str+='<div class="score">' + data['pid_text'].substr(data['pid_text'].indexOf('盘')+2) + '</div>';
        }else{
            str+='<div class="score">' +data['pid_text'] + '</div>';
        }


        str='<li class="'+cls+'">'+str+'</li>';
    }

    if(str!=''){
		
		if(data['live_sid'] == 1){
			str += '<li style="height:100px;border:0;"></li>';
		}
		
        if(bf=='before'){
            $("#livebox").prepend(str);
        }else{
            $("#livebox").append(str);
        }
    }
}

//数组遍历
function arrayeach(arr){
    //if($.isArray(arr)){
    for(var ele in arr){
        alert(ele + ' --- ' + arr[ele]);
    }
    //}
}

//判断输入字符串是否为空或者全部都是空格
function isNull( str ){
    if ( str == "" ) return true;
    var regu = "^[ ]+$";
    var re = new RegExp(regu);

    return re.test(str);
}

//URL
function J_get(name, url){
    url  = url?url:self.window.document.location.href;
    var start	= url.indexOf(name + '=');
    if (start == -1) return '';
    var len = start + name.length + 1;
    var end = url.indexOf('&',len);
    if (end == -1) end = url.length;
    return url.substring(len,end);
}

// js 清除字符串左右两端空格
function trim(str) {//删除左右两端的空格
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
function ltrim(str){ //删除左边的空格
    return str.replace(/(^\s*)/g,"");
}
function rtrim(str){//删除右边的空格
    return str.replace(/(\s*$)/g,"");
}


function show_tj(){
	 $(".tmpic:first").trigger("click");
}


//
//历史数据
var dataalalysis = avalon.define("dataalalysis",function (vm){
    vm.jf={};
    vm.zj={};
    vm.zfg={};
    vm.kfg={};
});
//伤病球员
$.getJSON('//data.zhibo8.cc/json/'+p_saishi_id+'_injuries.html',function(data){
//	console.log(data);
	var players=data,flag=false;
	var str='<style>'+
			'	.sj_injured{width: 100%;border-left: 1px solid #d0d0d0;border-right: 1px solid #d0d0d0;}'+
			'	.sj_injured .tlt{font-size: 14px; padding-left: 10px; text-align: left;}'+
			'	.sj_injured tr.dark{background-color: #F0EEEF;}'+
			'	.sj_injured tr td,.sj_injured tr th{text-align: left;line-height: 30px; min-width: 35px;padding-left:40px;}'+
			'	.sj_injured tr th{text-align:center;padding-left:0;}'+
			'	.sj_injured tr td.remarks{text-align:left}'+
			'</style>';
		str+='<table class="sj_injured"><td colspan="4" class="tlt">伤病名单</td>';
		for(var i=0;i<players.length;i++){
			var lists=players[i];
			str+='<tr><th colspan="4">'+lists['team']+'</th></tr>';
			for(var j=0;j<lists['list'].length;j++){
				flag=true;
				var player=lists['list'][j];
				var className=j%2==0?'class="dark"':'';
                var injury = player['injury']!=null?player['injury']:'';
				str+='<tr '+className+'><td>'+player['displayName']+'</td><td>'+injury+'</td><td>'+player['statusCn']+'</td><td>'+player['dateCn']+'</td></tr>';
				if(player['commentCn']){
					str+='<tr '+className+'><td colspan="4">备注：'+player['commentCn']+'</td></tr>';
				}
			}
		}
		str+='</table>';
	if(data.length>0&&flag){
		$("#sqsj").find(".sj_tit").after(str);
	}
});
//交锋历史
$.getJSON('//data.zhibo8.cc/json/'+p_saishi_id+'_his.html',function(data){
    //console.log(data);
    dataalalysis.jf = data;
    setTimeout(function(){
        $('.js_data').each(function(i,v){
            if(i%2){
                $(this).addClass('jf_tr_dark');
                $(this).find('td').eq(1).addClass('jf_td_dark');
            }else{
                $(this).find('td').eq(1).addClass('jf_td_light');
            }
        })
    },1000)

})

//最近战绩
$.getJSON('//data.zhibo8.cc/json/'+p_saishi_id+'_log.html',function(data){
    var h_win= 0,h_equal = 0, h_lose = 0,v_win= 0,v_equal = 0, v_lose = 0;
    //console.log(data);
    dataalalysis.zj = data;
    for(var i in data[0]){
        if(data[0][i]['saiguo']=='胜'){
            h_win++;
        }else if(data[0][i]['saiguo']=='平'){
            h_equal++;
        }else if(data[0][i]['saiguo']=='负'){
            h_lose++;
        }
        $('.zj_host .zj_win').html(h_win+'胜');
        $('.zj_host .zj_equal').html(h_equal+'平');
        $('.zj_host .zj_lose').html(h_lose+'负');
    }
    for(var i in data[1]){
        if(data[1][i]['saiguo']=='胜'){
            v_win++;
        }else if(data[1][i]['saiguo']=='平'){
            v_equal++;
        }else if(data[1][i]['saiguo']=='负'){
            v_lose++;
        }
        $('.zj_visit .zj_win').html(v_win+'胜');
        $('.zj_visit .zj_equal').html(v_equal+'平');
        $('.zj_visit .zj_lose').html(v_lose+'负');
    }
    setTimeout(function(){
        $('.zj_h_tr').each(function(i,v){
            if(i%2){
                $(this).addClass('jf_tr_dark');
                $(this).find('td').eq(0).addClass('jf_td_dark');
            }else{
                $(this).find('td').eq(0).addClass('jf_td_light');
            }
        })
    },1000)
    setTimeout(function(){
        $('.zj_v_tr').each(function(i,v){
            if(i%2){
                $(this).addClass('jf_tr_dark');
                $(this).find('td').eq(0).addClass('jf_td_dark');
            }else{
                $(this).find('td').eq(0).addClass('jf_td_light');
            }
        })
    },1000)

})

//主队未来赛事安排
$.getJSON('//data.zhibo8.cc/json/'+p_saishi_id+'_zfg.html',function(data){
    dataalalysis.zfg = data;
    setTimeout(function(){
        $('.zfg').each(function(i,v){
            if(i%2){
                $(this).addClass('wl_tr_dark');
            }
        })
    },1000)
})
//客队未来赛事安排
$.getJSON('//data.zhibo8.cc/json/'+p_saishi_id+'_kfg.html',function(data){
    dataalalysis.kfg = data;
    setTimeout(function(){
        $('.kfg').each(function(i,v){
            if(i%2){
                $(this).addClass('wl_tr_dark');
            }
        })
    },1000)
})