<?php $this->include('layouts/zhibo/detailHead') ?>
<body>
<?php $this->include('layouts/zhibo/menu') ?>

<div class="wrap mtop20">
    <div class="zb_left">
        <div class="bifen radt5">
            <div class="bf_top">
                <div class="team_1">
                    <p><a href="javascript:;" id="t1a">
                            <img id="t1" src="<?php echo $data['hometeamLogo'] ?>" alt="" /></a></p>
                            <span class="home_team_name"><?php echo $data['hometeamName'] ?></span>
                </div>

                <div class="bf_box tmtop">
                    <div class="touming"></div>
                    <div class="tmpic"><img src="https://static4style.qiumibao.com/txt_pc_img/loading.png" alt="" /></div>

                    <div class="time_score">
                        <div class="host_score">0</div>
                        <div class="mtime rad3" ms-controller="bifen"><?php echo $data['matchData']['competitionName']; ?></div>
                        <div class="visit_score">0</div>
                    </div> 
                    <div class="cls"></div> 
                </div>

                <div class="team_2">
                    <p><a href="javascript:;" id="t2a"><img id="t2" src="<?php echo $data['visitingteamLogo']; ?>" alt="" /></a></p>
                    <span class="visit_team_name"><?php echo $data['visitingteamName']; ?></span>
                </div>
            </div>

            <div class="bf_bottom rad3">
                <div class="video">
                    <font color="red"><strong>直播信号</strong></font>:
                    <?php foreach($data['playData'] as $plKey => $plVal){ ?>
                      <a href="<?php echo $plVal['playUrl'] ?>" target="_blank"><?php echo $plVal['playPlatform']; ?></a>
                    <?php } ?>
                </div>
                <div class="cls"></div>
            </div>
        </div>

        <div class="topbar">
            <div class="tselect">
                <a href="javascript:;" data-class="zhibo" class="tbar current">直播</a>
                <a href="javascript:;" data-class="chatRoom" class="tbar">聊天室</a>
            </div>

            <div style="clear:both;"></div>
        </div>

        <div class="tmtop">

            <div class="zhibo">
                <div class="zhibo_text">
                    <ul id="livebox">  
                     <?php if($data['liveStatus'] == '1'){ ?>                
                        <li id="jiazaizhong">
                            <?php if(strtotime($data['gameDate'].' '.$data['dataTime']) < time() ): ?>
                           <div class="livetext">直播暂未开始，敬请关注！</div>
                            <?php else:?>
                                <div class="livetext">暂无直播数据！</div>
                            <?php endif; ?>
                        </li>
                    <?php } ?>

                    <?php if($data['liveStatus'] > 1){ ?>                
                        <li id="jiazaizhong">
                           <div class="livetext">正在加载中....请稍后</div>
                        </li>
                    <?php } ?>

                    </ul>
                </div>
            </div>


            <div class="chatRoom">
                <div class="zhibo_text">
                    <ul id="livebox">
                        <li id="jiazaizhong"><div class="livetext">暂无聊天信息！</div></li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="dmsend" ms-controller="dmsend">
            <div class="dmsub">
                聊天 <span class="dmspan" ms-click="danmu_switch" ms-class="dmspan_gray: gray"> &nbsp; </span>
                <input type="text" id="chatContent" class="dmtext rad3" ms-keyup="enterkey">
                <input type="hidden" id="nickName" name="nickName">
                <input type="button" value="发送" id="sendChat" class="dmbtn rad3" ms-click="danmu_send" ms-class="dmbtn_gray: gray">
            </div> 
         </div>
    </div>

    <div class="cls"></div>
</div>
  
<script type="text/javascript">
     var game_id = "<?php echo $data['id']; ?>";
     var liveStatus = "<?php echo $data['liveStatus']; ?>";
     var commentaryData = <?php echo json_encode($data['commentaryData']); ?>;
     var chatData       = <?php echo json_encode($data['chatData']); ?>;
     var narratorData   = <?php echo json_encode($data['narratorData']); ?>;
     var user_id = "<?php echo isset($userInfo['id']) ? $userInfo['id'] : '0'; ?>";
</script>
 

<script src="/static/zhibo8/js/live.js"></script>

<script type="text/javascript">
  $(".tbar").click(function(){
      $(".tbar").removeClass('current');
      $(this).addClass('current');
       var strClass = $(this).data('class');
       if(strClass == 'chatRoom'){
          $(".chatRoom").show();
          $(".zhibo").hide()
      }else{
           $(".chatRoom").hide();
           $(".zhibo").show()
       }
   });
</script>


