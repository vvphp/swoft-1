<?php $this->include('layouts/zhibo/detailHead') ?>
<body>
<?php $this->include('layouts/zhibo/menu') ?>

<div class="wrap mtop20">
    <div class="zb_left">
        <div class="bifen radt5">
            <div class="bf_top">
                <div class="team_1">
                    <p><a href="javascript:;" id="t1a"><img id="t1" src="//duihui.qiumibao.com/zuqiu/qitazhudui.png" alt="" /></a></p>
                    <span class="home_team_name">主队</span>
                </div>

                <div class="bf_box tmtop">
                    <div class="touming"></div>
                    <div class="tmpic"><img src="//static4style.qiumibao.com/txt_pc_img/loading.png" alt="" /></div>

                    <div class="time_score">
                        <div class="host_score">0</div>
                        <div class="mtime rad3" ms-controller="bifen">{{bifen.period_cn}}</div>
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
                    <p><a href="javascript:;" id="t2a"><img id="t2" src="//duihui.qiumibao.com/zuqiu/qitakedui.png" alt="" /></a></p>
                    <span class="visit_team_name">客队</span>
                </div>
            </div>

            <div class="bf_bottom rad3">
                <div class="video"><font color="red"><strong>直播信号</strong></font>:    <a href="http://sports.qq.com/kbsweb/game.htm?mid=100002:20184904" target="_blank" t="none">QQ直播(无插件)</a>   <a href="http://sports.qq.com/kbsweb/game.htm?mid=100002:20184904" target="_blank" style="display: none;" plug="only_plug">QQ直播(腾讯视频插件)</a>  <a href="https://wenzi.zhibo8.cc/zhibo/nba/2018/0523124692.htm" target="_blank">互动图文直播</a> <a href="http://www.zhibo8.cc/shouji.htm" target="_blank">新版手机客户端</a> <a href="http://www.188bifen.com/lanqiubifen.htm" target="_blank">比分直播</a><!-- 以下为附加信息 --></div>
                <div class="cls"></div>
            </div>
        </div>

        <div class="topbar">
            <div class="tselect">
                <a href="javascript:;" data-class="zhibo" class="tbar current">直播</a>
                <a href="javascript:;" data-class="shuju" class="tbar">数据</a>
                <a href="javascript:;" data-class="jingcai" class="tbar">聊天室</a>

            </div>

            <div style="clear:both;"></div>
        </div>

        <div class="tmtop">
            <div class="touming"></div>
            <div class="tmpic"><img src="//static4style.qiumibao.com/txt_pc_img/loading.png" alt="" /></div>

            <div class="zhibo">
                <div class="zhibo_text">
                    <ul id="livebox">
                        <li id="jiazaizhong"><div class="livetext">直播暂未开始，敬请关注！</div></li>
                    </ul>
                </div>
            </div>

            <div id="dmbox">
                <canvas id="danmu2"></canvas>
            </div>
        </div>

        <div class="dmsend" ms-controller="dmsend">
            <div class="dmsub">
                弹幕 <span class="dmspan" ms-click="danmu_switch" ms-class="dmspan_gray: gray"> &nbsp; </span>

                <input type="text" class="dmtext rad3" ms-keyup="enterkey">

                <input type="button" value="发送" class="dmbtn rad3" ms-click="danmu_send" ms-class="dmbtn_gray: gray">
            </div>

            <p class="dmnote" ms-if="note != ''" ms-text="note"></p>
        </div>

        <div style="margin:5px 0;">
            <iframe id="ac_im86_69256983" name="ac_im86_69256983" src="//afpeng.alimama.com/ex?a=mm_119500411_19076741_69256983&sp=0&cb=_acM.r" width="580" height="90" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="true" ></iframe>
        </div>

        <div id="mdata">
            <div class="chang mtop5 tmtop" style="display:none;">
                <div class="touming" style="margin-top:35px;height:429px;"></div>
                <div class="tmpic"><img style="margin-top:60px;" src="//static4style.qiumibao.com/txt_pc_img/loading.png" alt="" /></div>

                <div class="chang_tit">
                    <span class="fl home_team_name">主队</span>
                    <span style="margin-left:218px;line-height:40px;">场上球员</span>
                    <span class="fr visit_team_name">客队</span>
                </div>

                <div class="chang_mid" ms-controller="roster_oncourt">
                    <div class="qy_1">
                        <div class="qy_con" ms-repeat="roster_oncourt.host" ms-if-loop="$key!='team_info'">
                            <div class="qy_img">
                                <img src="//static4style.qiumibao.com/txt_pc_img/player.gif" alt="" /><a ms-attr-title="$val.player_name" target="_blank" ms-class="host{{$key}}">
                                </a>
                            </div>

                            <div class="qy_des" ms-visible="roster_oncourt_is_show">
                                <span class="float_left"><a target="_blank" ms-if-loop="$val.player_name">{{$val.player_name | plink(p_host) | html}}</a></span>
                                <span class="float_right">{{$val.points}}分 {{$val.fouls}}犯规</span>

                                <p>
                                    <period ms-if-loop="$val.period">第{{$val.period}}节</period>  <game_clock ms-if-loop="$val.game_clock">还有{{$val.game_clock}}</game_clock><br><event ms-if-loop="$val.event">{{$val.event}}</event>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="qy_2">
                        <div class="qy_con" ms-repeat="roster_oncourt.guest" ms-if-loop="$key!='team_info'">
                            <div class="qy_img">
                                <img src="//static4style.qiumibao.com/txt_pc_img/player.gif" alt="" /><a ms-attr-title="$val.player_name" target="_blank" ms-class="guest{{$key}}">
                                </a>
                            </div>

                            <div class="qy_des" ms-visible="roster_oncourt_is_show">
                                <span class="float_left"><a target="_blank" ms-if-loop="$val.player_name">{{$val.player_name | plink(p_guest) | html}}</a></span>
                                <span class="float_right">{{$val.points}}分 {{$val.fouls}}犯规</span>

                                <p>
                                    <period ms-if-loop="$val.period">第{{$val.period}}节</period>  <game_clock ms-if-loop="$val.game_clock">还有{{$val.game_clock}}</game_clock><br><event ms-if-loop="$val.event">{{$val.event}}</event>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="cls"></div>
                </div>

                <div class="chang_bot"></div>

                <div class="shoufa_text text_box">
                </div>
            </div>

            <div class="shuju mtop5" ms-controller="statistics">
                <div class="db1" ms-repeat="statistics" ms-if-loop="$key=='host'">
                    <div class="sj_head">{{$val.team_name_cn}}实时技术统计<div>首发球员蓝色背景标识<br>场上球员红色名字标识</div></div>

                    <div class="sj_table tmtop">
                        <div class="touming"></div>

                        <table>
                            <tr class="th">
                                <td>球员</td>
                                <td>位置</td>
                                <td>出场时间</td>
                                <td>投篮</td>
                                <td>三分</td>
                                <td>罚球</td>
                                <td>前篮板</td>
                                <td>后篮板</td>
                                <td>总篮板</td>
                                <td>助攻</td>
                                <td>抢断</td>
                                <td>盖帽</td>
                                <td>失误</td>
                                <td>犯规</td>
                                <td>+/-</td>
                                <td>得分</td>
                            </tr>
                            <tr ms-repeat="$val.on">
                                <td ms-css-background="el.position == '首发' ? '#d6ebfd' : ''" ms-css-color="el.on_line ? 'red' : ''">{{el.player_name_cn | plink(p_host) | html}}</td>
                                <td>{{el.pos}}</td>
                                <td>{{el.minutes}}</td>
                                <td>{{el.field}}</td>
                                <td>{{el.three}}</td>
                                <td>{{el.free}}</td>
                                <td>{{el.off}}</td>
                                <td>{{el.def}}</td>
                                <td>{{el['off+def']}}</td>
                                <td>{{el.ass}}</td>
                                <td>{{el.ste}}</td>
                                <td>{{el.blo}}</td>
                                <td>{{el.turn}}</td>
                                <td>{{el.fouls}}</td>
                                <td>{{el.plusMinus}}</td>
                                <td>{{el.points}}</td>
                            </tr>
                            <tr ms-repeat="$val.off" ms-if-loop="el.player_id>0">
                                <td>{{el.player_name_cn | plink(p_host) | html}}</td>
                                <td>{{el.pos}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="th" ms-if="$val.on.size()>=5">
                                <td>总计</td>
                                <td></td>
                                <td>{{$val.total.minutes}}</td>
                                <td>{{$val.total.field}}</td>
                                <td>{{$val.total.three}}</td>
                                <td>{{$val.total.free}}</td>
                                <td>{{$val.total.off}}</td>
                                <td>{{$val.total.def}}</td>
                                <td>{{$val.total['off+def']}}</td>
                                <td>{{$val.total.ass}}</td>
                                <td>{{$val.total.ste}}</td>
                                <td>{{$val.total.blo}}</td>
                                <td>{{$val.total.turn}}</td>
                                <td>{{$val.total.fouls}}</td>
                                <td>{{$val.total.plusMinus}}</td>
                                <td>{{$val.total.points}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="sj_foot tmtop" ms-controller="score_team" ms-if="$val.on.size()>=5">
                        <div class="touming"></div>

                        快攻得分 {{score_team.host.fast_points}}<span>|</span>内线得分 {{score_team.host.points_paint}}<span>|</span>利用对方失误得分 {{score_team.host.off_turnovers}}<span>|</span>最大领先分数 {{score_team.host.biggest}}<br />技术犯规 {{score_team.host.tec_fouls}}<span>|</span>恶意犯规 {{score_team.host.flag}}<span>|</span>六犯离场 {{score_team.host.disqualifications}}<span>|</span>被逐离场 {{score_team.host.ejections}}

                    </div>
                </div>

                <div class="db2 mtop5" ms-repeat="statistics" ms-if-loop="$key=='guest'">
                    <div class="sj_head">{{$val.team_name_cn}}实时技术统计<div>首发球员蓝色背景标识<br>场上球员红色名字标识</div></div>

                    <div class="sj_table tmtop">
                        <div class="touming"></div>

                        <table>
                            <tr class="th">
                                <td>球员</td>
                                <td>位置</td>
                                <td>出场时间</td>
                                <td>投篮</td>
                                <td>三分</td>
                                <td>罚球</td>
                                <td>前篮板</td>
                                <td>后篮板</td>
                                <td>总篮板</td>
                                <td>助攻</td>
                                <td>抢断</td>
                                <td>盖帽</td>
                                <td>失误</td>
                                <td>犯规</td>
                                <td>+/-</td>
                                <td>得分</td>
                            </tr>
                            <tr ms-repeat="$val.on">
                                <td ms-css-background="el.position == '首发' ? '#d6ebfd' : ''" ms-css-color="el.on_line ? 'red' : ''">{{el.player_name_cn | plink(p_guest) | html}}</td>
                                <td>{{el.pos}}</td>
                                <td>{{el.minutes}}</td>
                                <td>{{el.field}}</td>
                                <td>{{el.three}}</td>
                                <td>{{el.free}}</td>
                                <td>{{el.off}}</td>
                                <td>{{el.def}}</td>
                                <td>{{el['off+def']}}</td>
                                <td>{{el.ass}}</td>
                                <td>{{el.ste}}</td>
                                <td>{{el.blo}}</td>
                                <td>{{el.turn}}</td>
                                <td>{{el.fouls}}</td>
                                <td>{{el.plusMinus}}</td>
                                <td>{{el.points}}</td>
                            </tr>
                            <tr ms-repeat="$val.off" ms-if-loop="el.player_id>0">
                                <td>{{el.player_name_cn | plink(p_guest) | html}}</td>
                                <td>{{el.pos}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="th" ms-if="$val.on.size()>=5">
                                <td>总计</td>
                                <td></td>
                                <td>{{$val.total.minutes}}</td>
                                <td>{{$val.total.field}}</td>
                                <td>{{$val.total.three}}</td>
                                <td>{{$val.total.free}}</td>
                                <td>{{$val.total.off}}</td>
                                <td>{{$val.total.def}}</td>
                                <td>{{$val.total['off+def']}}</td>
                                <td>{{$val.total.ass}}</td>
                                <td>{{$val.total.ste}}</td>
                                <td>{{$val.total.blo}}</td>
                                <td>{{$val.total.turn}}</td>
                                <td>{{$val.total.fouls}}</td>
                                <td>{{$val.total.plusMinus}}</td>
                                <td>{{$val.total.points}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="sj_foot tmtop" ms-controller="score_team" ms-if="$val.on.size()>=5">
                        <div class="touming"></div>

                        快攻得分 {{score_team.guest.fast_points}}<span>|</span>内线得分 {{score_team.guest.points_paint}}<span>|</span>利用对方失误得分 {{score_team.guest.off_turnovers}}<span>|</span>最大领先分数 {{score_team.guest.biggest}}<br />技术犯规 {{score_team.guest.tec_fouls}}<span>|</span>恶意犯规 {{score_team.guest.flag}}<span>|</span>六犯离场 {{score_team.guest.disqualifications}}<span>|</span>被逐离场 {{score_team.guest.ejections}}

                    </div>
                </div>
            </div>

            <div class="paixu tmtop mtop5">
                <div class="touming" style="margin-top:30px;height:240px;"></div>

                <div class="px_line"></div>

                <div class="paixu_left">
                    <table ms-controller="score_rank">
                        <tr class="trtit">
                            <td>最高</td>
                            <td>{{score_rank.host.team_info.team_name}}</td>
                            <td></td>
                            <td>{{score_rank.guest.team_info.team_name}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>得分</td>
                            <td>{{score_rank.host.points.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.points.points}}</td>
                            <td>{{score_rank.guest.points.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.points.points}}</td>
                        </tr>
                        <tr>
                            <td>篮板</td>
                            <td>{{score_rank.host['off+def']['player_name'] | plink(p_host) | html}}</td>
                            <td>{{score_rank.host['off+def']['points']}}</td>
                            <td>{{score_rank.guest['off+def']['player_name'] | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest['off+def']['points']}}</td>
                        </tr>
                        <tr>
                            <td>助攻</td>
                            <td>{{score_rank.host.ass.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.ass.points}}</td>
                            <td>{{score_rank.guest.ass.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.ass.points}}</td>
                        </tr>
                        <tr>
                            <td>抢断</td>
                            <td>{{score_rank.host.ste.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.ste.points}}</td>
                            <td>{{score_rank.guest.ste.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.ste.points}}</td>
                        </tr>
                        <tr>
                            <td>盖帽</td>
                            <td>{{score_rank.host.blo.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.blo.points}}</td>
                            <td>{{score_rank.guest.blo.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.blo.points}}</td>
                        </tr>
                        <tr>
                            <td>时间</td>
                            <td>{{score_rank.host.minutes.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.minutes.points}}</td>
                            <td>{{score_rank.guest.minutes.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.minutes.points}}</td>
                        </tr>
                        <tr>
                            <td>失误</td>
                            <td>{{score_rank.host.turn.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.turn.points}}</td>
                            <td>{{score_rank.guest.turn.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.turn.points}}</td>
                        </tr>
                        <tr>
                            <td>犯规</td>
                            <td>{{score_rank.host.per_fouls.player_name | plink(p_host) | html}}</td>
                            <td>{{score_rank.host.per_fouls.points}}</td>
                            <td>{{score_rank.guest.per_fouls.player_name | plink(p_guest) | html}}</td>
                            <td>{{score_rank.guest.per_fouls.points}}</td>
                        </tr>
                    </table>
                </div>

                <div class="paixu_left">
                    <table ms-controller="stats_team">
                        <tr class="trtit">
                            <td>球队数据</td>
                            <td>{{stats_team.host.team_info.team_name}}</td>
                            <td>{{stats_team.guest.team_info.team_name}}</td>
                        </tr>
                        <tr>
                            <td>得分/篮板</td>
                            <td>{{stats_team.host.score_board.points}}</td>
                            <td>{{stats_team.guest.score_board.points}}</td>
                        </tr>
                        <tr>
                            <td>投篮命中率</td>
                            <td>{{stats_team.host.field_rate.points}}</td>
                            <td>{{stats_team.guest.field_rate.points}}</td>
                        </tr>
                        <tr>
                            <td>三分命中率</td>
                            <td>{{stats_team.host.three_rate.points}}</td>
                            <td>{{stats_team.guest.three_rate.points}}</td>
                        </tr>
                        <tr>
                            <td>罚球命中率</td>
                            <td>{{stats_team.host.free_rate.points}}</td>
                            <td>{{stats_team.guest.free_rate.points}}</td>
                        </tr>
                        <tr>
                            <td>快攻/内线得分</td>
                            <td>{{stats_team.host.fp_points.points}}</td>
                            <td>{{stats_team.guest.fp_points.points}}</td>
                        </tr>
                        <tr>
                            <td>技术/恶意犯规</td>
                            <td>{{stats_team.host.fouls.points}}</td>
                            <td>{{stats_team.guest.fouls.points}}</td>
                        </tr>
                        <tr>
                            <td>六犯/被逐出场</td>
                            <td>{{stats_team.host.diq_ejt.points}}</td>
                            <td>{{stats_team.guest.diq_ejt.points}}</td>
                        </tr>
                        <tr>
                            <td>最大领先分数</td>
                            <td>{{stats_team.host.biggest.points}}</td>
                            <td>{{stats_team.guest.biggest.points}}</td>
                        </tr>
                    </table>
                </div>

                <div class="cls"></div>
            </div>
        </div>


        <div id="sqsj" class="sj mtop5 tmtop" ms-controller="dataalalysis">
            <div class="sj_tit">
                <span><img src="//www.zhibo8.cc/js/2016/css/shuju.png" height="40" alt="赛前数据"></span>
            </div>
            <table id="js_jf">
                <tr><td colspan="5" class="jf_tit">交锋历史</td></tr>
                <tr>
                    <th>日期</th>
                    <th>赛事</th>
                    <th>主队</th>
                    <th>比分</th>
                    <th>客队</th>
                </tr>
                <tr ms-repeat="jf[0]" class="js_data">
                    <td>{{el.data}}</td>
                    <td >{{el.game}}</td>
                    <td>{{el.home_team | tlink | html}}</td>
                    <td>{{el.score}}</td>
                    <td>{{el.visit_team | tlink | html}}</td>
                </tr>
            </table>
            <div id="js_zj" ms-controller='dataalalysis'>
                <p  class="zj_tit">最近战绩</p>
                <table class='t_log' style="border-left:1px solid #d0d0d0">
                    <tbody>
                    <tr class="zj_bor zj_host">
                        <td colspan="5"><i class="t24no"><img alt="" width="24px" height="24px" class="t1_logo" src="//duihui.qiumibao.com/nba/default_h.png"></i><span class='ht_name'>主队</span><span class="zj_sf"><span class="zj_win"></span><span class="zj_equal"></span><span class="zj_lose"></span></span></td>
                    </tr>
                    <tr>
                        <td>赛事</td>
                        <td>日期</td>
                        <td>主队</td>
                        <td>比分</td>
                        <td>客队</td>
                    </tr>
                    <tr ms-repeat='zj[0]' class='zj_h_tr'>
                        <td>{{el.saishi}}</td>
                        <td>{{el.data}}</td>
                        <td>{{el.home_team | tlink | html}}</td>
                        <td>{{el.score}}</td>
                        <td>{{el.visit_team | tlink | html}}</td>
                    </tr>
                    <tbody>
                </table>
                <table class='t_log'>
                    <tbody>
                    <tr class="zj_bor zj_visit">
                        <td colspan="5"><i class="t24no"><img alt="" width="24px" height="24px" class="t2_logo" src="//duihui.qiumibao.com/nba/default_v.png"></i><span class='vt_name'>客队</span><span class="zj_sf"><span class="zj_win"></span><span class="zj_equal"></span><span class="zj_lose"></span></span></td>
                    </tr>
                    <tr>
                        <td>赛事</td>
                        <td>日期</td>
                        <td>主队</td>
                        <td>比分</td>
                        <td>客队</td>
                    </tr>
                    <tr ms-repeat='zj[1]' class='zj_v_tr'>
                        <td>{{el.saishi}}</td>
                        <td>{{el.data}}</td>
                        <td>{{el.home_team | tlink | html}}</td>
                        <td>{{el.score}}</td>
                        <td>{{el.visit_team | tlink | html}}</td>
                    </tr>
                    <tbody>
                </table>
                <table class='t_ball'>
                    <tr class="zj_ball" ms-repeat='zj[2]'>
                        <td colspan="2" class="t_dark">{{el[0]}}</td>
                        <td colspan="3">{{el[1]}}</td>
                        <td colspan="2">{{el[4]}}</td>
                        <td colspan="3" class="t_dark">{{el[5]}}</td>
                    </tr>
                </table>
            </div>
            <div id="js_wl" ms-controller='dataalalysis'>
                <p class="wl_tit">未来赛程</p>
                <table class='js_wl_t'>
                    <tbody>
                    <tr class="wl_tname"><td colspan="4"><i class="t24no"><img alt="" width="24px" height="24px" class="t1_logo" src="//duihui.qiumibao.com/nba/default_h.png">
                            </i><span class='ht_name'>主队</span></td></tr>
                    <tr class="wl_t">
                        <td>赛事</td>
                        <td>日期</td>
                        <td>主队</td>
                        <td>客队</td>
                    </tr>
                    <tr ms-repeat='zfg' class='zfg'>
                        <td>{{el.saishi}}</td>
                        <td>{{el.data}}</td>
                        <td>{{el.home_team | tlink | html}}</td>
                        <td>{{el.visit_team | tlink | html}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class='js_wl_t'>
                    <tbody>
                    <tr class="wl_tname"><td colspan="4"><i class="t24no"><img alt="" width="24px" height="24px" class="t2_logo" src="//duihui.qiumibao.com/nba/default_v.png"></i><span class='vt_name'>客队</span></td></tr>
                    <tr class="wl_t">
                        <td>赛事</td>
                        <td>日期</td>
                        <td>主队</td>
                        <td>客队</td>
                    </tr>
                    <tr ms-repeat='kfg' class='kfg'>
                        <td>{{el.saishi}}</td>
                        <td>{{el.data}}</td>
                        <td>{{el.home_team | tlink | html}}</td>
                        <td>{{el.visit_team | tlink | html}}</td>
                    </tr>
                    </tbody>
                </table>
                <p>&nbsp;</p>
            </div>
        </div>


        <div class="jc mtop5 tmtop" ms-controller="guess">
            <div class="jc_tit">
                <span class="jcimg"><img src="//www.zhibo8.cc/js/2016/css/guess.png" height="40" alt="竞猜中心"></span>

                <span ms-if="array.length > 0 && arrtype>0" ms-click="reloadGuess" style="float:right;margin-right:10px;font-size:14px;font-weight:bold;cursor:pointer;color:#58AFF4">刷新竞猜</span>
            </div>

            <div class="jc_touming" ms-if="arrtype == 0"></div>
            <div class="jc_tmpic" ms-if="arrtype == 0">
                <img ms-click="reloadGuess" src="//static4style.qiumibao.com/txt_pc_img/loading.png" alt="" />
            </div>

            <ul ms-class="guess_blur: arrtype==0" style="border:1px solid #d0d0d0;border-top:0;padding:10px 0;">
                <li ms-repeat="array">
                    <div class="jcli_tit">{{el.title}}</div>

                    <div class="jcli_box" ms-attr-id="'g_'+el.id">

                        <div class="jcli_rp" ms-repeat-son="el.items">
                            <div class="rad3 jcli_rp_tit" ms-if-loop="el.status=='normal' && el.terminaltime>now_time()" ms-click="show(son.guess_id,son.id,son.odds,el.maxgold)">{{son.optName}} ({{son.odds}})</div>
                            <div class="rad3 jcli_rp_tit" ms-if-loop="el.status!='normal' || el.terminaltime<now_time()" style="background-color:#AFB1B1;cursor:default;">{{son.optName}} ({{son.odds}})</div>

                            <div class="jcli_rp_jd">
                                <div class="jcli_rp_jd_per">
                                    <div class="jcli_rp_jd_k" ms-css-width="Math.round(son.optNum/el.num*100)+'%'"> &nbsp; </div>
                                </div>

                                <div class="jcli_rp_jd_wz" ms-text="son.optNum == 0 && el.num==0 ? '0%' : Math.round(son.optNum/el.num*100)+'%'"></div>
                            </div>

                            <div class="jcli_rp_ci"><span class="optNum">{{son.optNum}}</span>次 <span class="gold">{{son.gold}}</span>$</div>
                        </div>

                        <div class="cls"></div>

                    </div>

                    <div class="jcli_bottom">截止时间：{{el.terminaltime.substr(5,11)}}</div>
                </li>

                <li ms-if="array.length==0"><div class="jcli_tit" ms-click="reloadGuess" style="cursor:pointer;">暂无竞猜，点击加载。</div></li>
            </ul>
        </div>

    </div>

    <div class="zb_right">
        <ul id="rooms_info" style="display: none;"><li rid="1">球迷房间</li><li rid="2">彩民房间</li></ul>
        <div ms-controller="pl_app" id="pl_box" file="2018-nba-0523124692">
            <div ms-include-src="'/js/2016/comment/main.html'" data-include-rendered="onrendered"></div>
        </div>
        <script src="//www.zhibo8.cc/js/2016/comment/pinglun.js" type="text/javascript"></script>
    </div>

    <div class="cls"></div>

    <div style="height:20px;"></div>
</div>

<div id="overDiv" class="close" ></div>
<div id="bottomNav" ms-controller="user">
    <div class="modal-header">输入金币数量(当前可用<b ms-repeat="jc_task.userinfo" ms-if-loop="$key=='gold'&&jc_task.userinfo" >{{$val}}</b><b  ms-if="!jc_task.userinfo" >0</b>$)<span class="close" >×</span></div>
    <div class="modal-body">
        <input type="hidden" ms-attr-value="order.guess_id" name="guess_id">
        <input type="hidden" ms-attr-value="order.answer_id" name="answer_id">
        <input type="hidden" ms-attr-value="order.odds" name="odds">
        <input type="number" class="inp_text"  min="0" ms-attr-max="order.maxgold" ms-keyup="income()" name="number" value="0"><button class="btns" ms-click="tz_submit">投注</button>
        <div class="alert" ></div>
        <div class="earn_info"><span style="color: #a94442;">MAX:<strong class="maxgold">{{order.maxgold}}</strong></span> 预计猜中收入:<span class="earn_gold">0</span>$</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btns btn-default close">关闭</button>
    </div>
</div>

<div id="liveguess" ms-controller="liveguess" style="display:none;width:0;height:0;overflow:hidden;">
    <li ms-repeat="array" class="jcbox">
        <div class="username">{{el.username}}</div>

        <div style="margin-left:50px;">
            <div class="jcli_tit">{{el.title}}</div>

            <div class="jcli_box">
                <div class="jcli_rp" ms-repeat-son="el.items">
                    <div class="rad3 jcli_rp_tit" ms-if-loop="el.status=='normal' && el.terminaltime>now_time()" onclick="touzhu($(this).attr('value'))" ms-attr-value="son.guess_id+'|'+son.id+'|'+son.odds+'|'+el.maxgold">{{son.optName}} ({{son.odds}})</div>
                    <div class="rad3 jcli_rp_tit" ms-if-loop="el.status!='normal' || el.terminaltime<now_time()" style="background-color:#AFB1B1;cursor:default;">{{son.optName}} ({{son.odds}})</div>
                </div>

                <div class="cls"></div>
            </div>
        </div>
    </li>
</div>



<script>
    var p_host        = '华中科大';
    var p_guest       = '太原理工';
    var p_game_date   = '2018-05-23';
    var p_saishi_id   = '124692';//p_saishi_id
    var p_match_time  = '2018-05-23 18:00';

    var p_host_img    = 'lanqiuzhudui';
    var p_visit_img   = 'lanqiukedui';
    var filename      = '2018-nba-0523124692';
    var txt_live      = '1';
    var total_score_h = '';
    var total_score_v = '';
    var open_txt = '0';

    var rooms = [{"id":1,"name":"球迷房间"},{"id":2,"name":"彩民房间"}];
</script>

<script src="https://www.zhibo8.cc/js/2016/bk2016.js"></script>
<script src="https://www.zhibo8.cc/js/2016/ndanmu.js"></script>


