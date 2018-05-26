$(function(){ 
     //liveStatus : 1:未开始 2:正在直播,3:已结束 
     var html = `<li id="jiazaizhong">
                  <div class="livetext">直播暂未开始，敬请关注！</div>
                 </li>`;
	if(liveStatus == "1"){
         $(".zhibo .zhibo_text #livebox").html(html); 
	}else{
		
	}




})
