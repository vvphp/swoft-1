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

                    <div class="bf_table" ms-controller="bifen">
                        <table width="270">
                            <tr>
                                <td style="width:70px;"></td>
                                <td>1st</td>
                                <td>2nd</td>
                                <td>3rd</td>
                                <td>4th</td>
                                <td ms-if="bifen.quarter>=5">加1</td>
                                <td ms-if="bifen.quarter>=6">加2</td>
                                <td ms-if="bifen.quarter>=7">加3</td>
                                <td ms-if="bifen.quarter>=8">加4</td>
                            </tr>
                            <tr>
                                <td class="home_team_name">主队</td>
                                <td>{{bifen.team1_scores[0]}}</td>
                                <td>{{bifen.team1_scores[1]}}</td>
                                <td>{{bifen.team1_scores[2]}}</td>
                                <td>{{bifen.team1_scores[3]}}</td>
                                <td ms-if="bifen.quarter>=5">{{bifen.team1_scores[4]}}</td>
                                <td ms-if="bifen.quarter>=6">{{bifen.team1_scores[5]}}</td>
                                <td ms-if="bifen.quarter>=7">{{bifen.team1_scores[6]}}</td>
                                <td ms-if="bifen.quarter>=8">{{bifen.team1_scores[7]}}</td>
                            </tr>
                            <tr>
                                <td class="visit_team_name">客队</td>
                                <td>{{bifen.team2_scores[0]}}</td>
                                <td>{{bifen.team2_scores[1]}}</td>
                                <td>{{bifen.team2_scores[2]}}</td>
                                <td>{{bifen.team2_scores[3]}}</td>
                                <td ms-if="bifen.quarter>=5">{{bifen.team2_scores[4]}}</td>
                                <td ms-if="bifen.quarter>=6">{{bifen.team2_scores[5]}}</td>
                                <td ms-if="bifen.quarter>=7">{{bifen.team2_scores[6]}}</td>
                                <td ms-if="bifen.quarter>=8">{{bifen.team2_scores[7]}}</td>
                            </tr>
                        </table>
                    </div>
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
                        <li id="jiazaizhong"><div class="livetext">aaaaaaawerewrewr直播暂未开始，敬请关注！</div></li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="dmsend" ms-controller="dmsend">
            <div class="dmsub">
                聊天 <span class="dmspan" ms-click="danmu_switch" ms-class="dmspan_gray: gray"> &nbsp; </span>

                <input type="text" class="dmtext rad3" ms-keyup="enterkey">

                <input type="button" value="发送" class="dmbtn rad3" ms-click="danmu_send" ms-class="dmbtn_gray: gray">
            </div>

            <p class="dmnote" ms-if="note != ''" ms-text="note"></p>
        </div>
    </div>

    <div class="zb_right">
        <script src="https://www.zhibo8.cc/js/2016/comment/pinglun.js" type="text/javascript"></script>
    </div>

    <div class="cls"></div>
</div>
  
<script type="text/javascript">
     var liveStatus = "<?php echo $data['liveStatus']; ?>";
     var commentaryData = <?php echo json_encode($data['commentaryData']); ?>;
     var narratorData = <?php echo json_encode($data['narratorData']); ?>;
</script>
 

<script src="/static/zhibo8/js/ndanmu.js"></script>
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


