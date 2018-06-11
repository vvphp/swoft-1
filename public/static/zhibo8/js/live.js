$(document).ready(function(){
	var html =''; 
	var wsUri = 'ws://47.95.14.113:9400/live/?game_id='+game_id;
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
     	  $(".zhibo>.zhibo_text>#livebox").html(html);
          $(".host_score").text(homeTeamScore);
          $(".visit_score").text(visitingTeamScore);
      }
    //预加载历史直播数据 end

    
 //liveStatus : 1:未开始 2:正在直播,3:已结束  
 if(liveStatus == 2){
         //websocket start
	    var ws = new WebSocket(wsUri);   
		ws.onopen = function(evt) {
		};
		ws.onmessage = function(evt) {
			var data = evt.data;
			if(data.indexOf('{')>-1){
			    data = JSON.parse(data);
				var type = data.type;
                //直播数据
                if(type == 'live'){
                    var time_frame = data.time_frame;
                    var time_frame_text = `第${time_frame}节`;
                    if(time_frame == '0' || time_frame == 0){
                        time_frame_text = '';
                    }
                    var html=`
						  <li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${data.content}</div>
						  <div class="period">${data.team_score}</div>
						  <div class="score">${time_frame_text}</div>
						</li>`;
                    $(".host_score").text(data.home_team_score);
                    $(".visit_score").text(data.visiting_team_score);
                }else{


                }
			}else{
				var html=`
						  <li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${data}</div>
						    <div class="period"></div>
						  <div class="score"></div>
						</li>`;
			}
			$(".zhibo>.zhibo_text>#livebox").prepend(html);
		    console.log("Received Message: " + evt.data);
		  };
		 ws.onclose = function(evt) {
		     console.log("Connection closed.");
		};   
    //websocket end  
   }


    /**
     * 发送聊天消息
     */
    $("#sendChat").click(function(){
          var nickName = $("#nickName").val();
          var chatContent = $("#chatContent").val();
          while(nickName=="" || nickName.length<=1){
               nickName = window.prompt("请输入昵称");
               $("#nickName").val(nickName);
          }
          if(chatContent.length<1 ){
              alert("内容不能为空");
              return false;
          }
         $.ajax({
            type: 'POST',
            url: "/live/sendChat",
            data: {"nickName":nickName,"chatContent":chatContent},
            success: function(data){
                 data = JSON.parse(data);
                 console.log(data);
            },
        });
        
    });

})
