$(document).ready(function(){
	var html ='';
    var chatRoom = 1;
	var wsUri = 'ws://47.95.14.113:9400/live/?game_id='+game_id;

    //如果设置过昵称，则还是用原来的昵称
    var nick_name = $.cookie('nick_name');
    if(nick_name != null || nick_name!='null'){
        $("#nickName").val(nick_name);
    }

    //预加载历史直播数据 start
     if(commentaryData.length > 0){
         var homeTeamScore = 0,
             visitingTeamScore = 0;
     	  commentaryData.forEach(function(val,key){     	        
     	        var content = val.content;
                var time_frame = val.timeFrame;
                var time_frame_text = `第${time_frame}节`;
                if(time_frame == '0' || time_frame == 0){
                      time_frame_text = '';
                  }
              if(key == 0){
                 homeTeamScore = val.homeTeamScore;
                 visitingTeamScore = val.visitingTeamScore;
              }
     	         html+=` 
						  <li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${content}</div>
						  <div class="period">${val.homeTeamScore}-${val.visitingTeamScore}</div>
						  <div class="score">${time_frame_text}</div>
						</li>`;
     	    });
          $(".zhibo>.zhibo_text>#livebox>#jiazaizhong").hide();
     	  $(".zhibo>.zhibo_text>#livebox").html(html);
          $(".host_score").text(homeTeamScore);
          $(".visit_score").text(visitingTeamScore);
      }else{
         $(".zhibo>.zhibo_text>#livebox>#jiazaizhong").show();
     }
    //预加载历史直播数据 end


  //加载历史聊天数据 start
    if(chatData.length > 0){
          var html = '';
          chatData.forEach(function(val,key){
               html+=` <li class="">
						  <div class="username">${val.nickName}</div>
						  <div class="livetext">${val.content}</div>
						    <div class="period">${val.date}</div>
						  <div class="score"></div>
						</li>`;
            });
        $(".chatRoom>.zhibo_text>#livebox>#jiazaizhong").hide();
        $(".chatRoom>.zhibo_text>#livebox").html(html);
    }
 //加载历史聊天数据 end
    
 //liveStatus : 1:未开始 2:正在直播,3:已结束
//websocket start
 var ws = new WebSocket(wsUri);
 ws.onopen = function(evt) {
 };
 ws.onmessage = function(evt) {
          var  data = JSON.parse(evt.data);
	      var  type = data.type;
          switch(type){
              case 'live':
                  //直播数据
                    fillLiveData(data);
                    break;
              case 'chat':
                  //聊天数据
                  if(chatRoom){
                      $(".tselect>a").click();
                      $(".chatRoom>.zhibo_text>#livebox>#jiazaizhong").hide();
                         chatRoom = 0;
                     }
                  fillChatData(data);
                  break;
              }
		  };
		 ws.onclose = function(evt) {
		     console.log("Connection closed.");
		};   
    //websocket end  


    /**
     * 发送聊天消息
     */
    $("#sendChat").click(function(){
        layer.open({
            type: 2,
            title: '请登录',
            content: '/live/user/login',
            area: ['400px', '350px'],
            fix: false, //不固定
            maxmin: true,
            shade:0.4
        });
        return false;


          var nickName = $("#nickName").val();
          var chatContent = $("#chatContent").val();
          while(nickName=="" || nickName.length<=1){
               nickName = window.prompt("请输入昵称");
               $("#nickName").val(nickName);
          }
        if(nickName.length>10 ){
            layer.alert('昵称太长,请重新输入', {icon: 5});
            $("#nickName").val('');
            return false;
        }
        if(nickName == 'null'){
            layer.alert('昵称非法', {icon: 5});
            $("#nickName").val('');
            return false;
        }
        if(chatContent.length<1 ){
            layer.alert('内容不能为空', {icon: 5});
            return false;
        }
         $.ajax({
            type: 'POST',
            url: "/live/detail/sendChat",
            data: {"nickName":nickName,"chatContent":chatContent},
            success: function(data){
                 data = JSON.parse(data);
                if(data.code== '-1') {
                    layer.alert(data.msg, {icon: 5});
                }
                if($.cookie('nick_name') == null || $.cookie('nick_name') == 'null'){
                      $.cookie('nick_name',nickName, { expires: 30, path: '/' });
                }
                if(chatRoom){
                   $("#chatContent").val('');
                   $(".tselect>a").click();
                   $(".chatRoom>.zhibo_text>#livebox>#jiazaizhong").hide();
                   chatRoom = 0;
                }
            },
        });
    });

    /**
     * 回车事件
     * @type {*|jQuery|HTMLElement}
     */
    var $inp = $('input');
    $inp.keypress(function (e) {
        var key = e.which; //e.which是按键的值
        if (key == 13) {
            $("#sendChat").click();
        }
    });

        /**
     * 渲染聊天数据
     * @param data
     */
    function fillChatData(data)
    {
        var html=` <li class="">
						  <div class="username">${data.nick_name}</div>
						  <div class="livetext">${data.content}</div>
						    <div class="period">${data.date}</div>
						  <div class="score"></div>
						</li>`;
       $(".chatRoom>.zhibo_text>#livebox").prepend(html);
    }


    /**
     *渲染直播数据
     * @param data
     */
    function fillLiveData(data)
    {
        var time_frame = data.time_frame;
        var time_frame_text = `第${time_frame}节`;
        if(time_frame == '0' || time_frame == 0){
            time_frame_text = '';
        }
        var html=`<li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${data.content}</div>
						  <div class="period">${data.team_score}</div>
						  <div class="score">${time_frame_text}</div>
						</li>`;
        $(".host_score").text(data.home_team_score);
        $(".visit_score").text(data.visiting_team_score);
        $(".zhibo>.zhibo_text>#livebox").prepend(html);
    }


})
