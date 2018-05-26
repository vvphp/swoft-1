$(document).ready(function(){
	var html =''; 
	var wsUri = 'ws://47.95.14.113:9400/live';
	//预加载历史直播数据 start
     if(commentaryData){
     	  commentaryData.forEach(function(val,key){     	        
     	        var content = val.content;
     	         html+=` 
						  <li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${content}</div>
						  <div class="period">109-97</div>
						  <div class="score">第4节</div>
						</li>`;
     	    }); 
     	  $(".zhibo>.zhibo_text>#livebox").html(html);
      }
    //预加载历史直播数据 end  
    
 //liveStatus : 1:未开始 2:正在直播,3:已结束  
 if(liveStatus == 2){
         //websocket start
	    var ws = new WebSocket(wsUri);   
		ws.onopen = function(evt) {  
		    console.log("Connection open ...");  
		    ws.send("Hello WebSockets!");  
		};  
		  
		ws.onmessage = function(evt) {  
		    console.log("Received Message: " + evt.data);  
		    console.log(evt);
		  };  
		  
		ws.onclose = function(evt) {  
		    console.log("Connection closed.");  
		};   
    //websocket end  
   }
})
