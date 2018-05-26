$(document).ready(function(){
	var html =''; 
	//预加载历史直播数据
     if(commentaryData){
     	  commentaryData.forEach(function(val,key){
     	        console.log(val.content,key);
     	        var content = val.content;
     	        var html +=` 
						  <li class="">
						  <div class="username">${narratorData.nikename}</div>
						  <div class="livetext">${content}</div>
						  <div class="period">109-97</div>
						  <div class="score">第4节</div>
						</li>`;
     	    }); 
     	  $(".zhibo>.zhibo_text>#livebox").html(html);
      }

     //liveStatus : 1:未开始 2:正在直播,3:已结束 


})
