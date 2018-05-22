<body>
<!-- 赛事选择（重要、足球、篮球、其他、全部）-->
<div class="module saishi shaixuan hid">
    <span value="zhongyao">重要</span>
    <span value="football">足球</span>
    <span value="basketball">篮球</span>
    <span class="current" value="all">全部</span>
</div>

<?php  foreach($data as $key => $value){ ?>
<div class="module saishi">
    <div class="head">
        <h2 class="current"><?php echo $key;?> <?php echo  $value[0]['weekDay']; ?></h2>
    </div>
    <div class="content">
        <div class="panel">
            <div class="list">
                <ul class="ent">
                    <?php   foreach($value as $index => $item){ ?>
                    <li class="lite" type="other "label="<?php echo $item['label'] ?>" >
                        <h2><a href="/zhibo/detail/<?php echo $item['id'] ?>" title="16:30 世界女排联赛 泰国女排 - 塞尔维亚女排"  >
                                <table id='124530'><tr>
                                        <td class="s_time" >16:30</td><td><div>泰国女排</div></td><td ><div class="s_name">世界女排联赛</div><div class="s_keyword">CCTV5+</div></td><td><div>塞尔维亚女排</div></td><td><div class="remind">进行中</div></td><td><div class="hideTime" style="display:none;">2018-05-22 16:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <?php } ?>

                    <li class="lite" type="football "label="天下足球,足球" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0522124509.htm" title="18:35 天下足球"  ><table ><tr>
                                        <td class="s_time" >18:35</td><td style="width:1%;"></td><td style="width:67%;"><div class="s_name">天下足球</div><div class="s_keyword">CCTV5</div></td><td style="width:1%;"></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 天下足球 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 18:35&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 18:35</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="other "label="排球,其他,中国女排,波兰女排" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0522124498.htm" title="20:00 女排国家联赛 中国女排 - 波兰女排"  ><table id='124498'><tr>
                                        <td class="s_time" >20:00</td><td><div>中国女排</div></td><td ><div class="s_name">女排国家联赛</div><div class="s_keyword">CCTV5 广东体育</div></td><td><div>波兰女排</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 女排国家联赛 中国女排 - 波兰女排 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 20:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 20:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="other "label="排球,其他,中国羽毛球队,印度羽毛球队" >

                    <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0522124531.htm" title="20:00 汤姆斯杯小组赛A组 中国羽毛球队 - 印度羽毛球队"  ><table id='124531'><tr>
                                        <td class="s_time" >20:00</td><td><div>中国羽毛球队</div></td><td ><div class="s_name">汤姆斯杯小组赛A组</div><div class="s_keyword">CCTV5+</div></td><td><div>印度羽毛球队</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 汤姆斯杯小组赛A组 中国羽毛球队 - 印度羽毛球队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 20:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 20:00</div></td>
                                    </tr></table>
                            </a></h2>

                    </li>
                    <li class="lite" type="other "label="羽毛球,其他,中国羽毛球队,印度羽毛球队" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0522124510.htm" title="22:30 汤姆斯杯小组赛A组 中国羽毛球队 - 印度羽毛球队"  ><table id='124510'><tr>
                                        <td class="s_time" >22:30</td><td><div>中国羽毛球队</div></td><td ><div class="s_name">汤姆斯杯小组赛A组</div><div class="s_keyword">CCTV5</div></td><td><div>印度羽毛球队</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 汤姆斯杯小组赛A组 中国羽毛球队 - 印度羽毛球队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 22:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 22:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="football "label="其他,足球,PS凯米,埃尔维斯" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0522124623.htm" title="23:30 芬超 PS凯米 - 埃尔维斯"  ><table id='124623'><tr>
                                        <td class="s_time" >23:30</td><td><div>PS凯米</div></td><td ><div class="s_name">芬超</div><div class="s_keyword">体育直播</div></td><td><div>埃尔维斯</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 芬超 PS凯米 - 埃尔维斯 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 23:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 23:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="football "label="其他,足球,瓦萨,库普斯" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0522124624.htm" title="23:30 芬超 瓦萨 - 库普斯"  ><table id='124624'><tr>
                                        <td class="s_time" >23:30</td><td><div>瓦萨</div></td><td ><div class="s_name">芬超</div><div class="s_keyword">体育直播</div></td><td><div>库普斯</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 芬超 瓦萨 - 库普斯 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 23:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 23:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="football "label="其他,足球,TPS土尔库,洪卡" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0522124625.htm" title="23:30 芬超 TPS土尔库 - 洪卡"  ><table id='124625'><tr>
                                        <td class="s_time" >23:30</td><td><div>TPS土尔库</div></td><td ><div class="s_name">芬超</div><div class="s_keyword">体育直播</div></td><td><div>洪卡</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 芬超 TPS土尔库 - 洪卡 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 23:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 23:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                    <li class="lite" type="football "label="其他,足球,赫尔辛基,国际图尔库" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0522124626.htm" title="23:30 芬超 赫尔辛基 - 国际图尔库"  ><table id='124626'><tr>
                                        <td class="s_time" >23:30</td><td><div>赫尔辛基</div></td><td ><div class="s_name">芬超</div><div class="s_keyword">体育直播</div></td><td><div>国际图尔库</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 芬超 赫尔辛基 - 国际图尔库 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-22 23:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-22 23:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li>
                </ul>
            </div><!--end list-->
        </div><!--end panel-->
    </div><!--end content-->
</div><!--end module-->
<?php } ?>


<div class="module saishi">
    <div class="head">

        <h2 class="current">05月23日 星期三</h2>
    </div>
    <div class="content">
        <div class="panel">
            <div class="list">
                <ul class="ent"> <li class="lite" type="football "label="其他,足球,玛丽港,拉赫蒂" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124627.htm" title="00:00 芬超 玛丽港 - 拉赫蒂"  ><table id='124627'><tr>
                                        <td class="s_time" >00:00</td><td><div>玛丽港</div></td><td ><div class="s_name">芬超</div><div class="s_keyword">体育直播</div></td><td><div>拉赫蒂</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 芬超 玛丽港 - 拉赫蒂 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 00:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 00:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="其他,足球,奥厄,卡尔斯鲁厄" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124628.htm" title="00:15 德乙 奥厄 - 卡尔斯鲁厄"  ><table id='124628'><tr>
                                        <td class="s_time" >00:15</td><td><div>奥厄</div></td><td ><div class="s_name">德乙</div><div class="s_keyword">体育直播</div></td><td><div>卡尔斯鲁厄</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 德乙 奥厄 - 卡尔斯鲁厄 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 00:15&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 00:15</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="西甲,马德里竞技,尼日利亚,足球" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124638.htm" title="01:00 足球友谊赛 尼日利亚 - 马德里竞技"  ><table id='124638'><tr>
                                        <td class="s_time" >01:00</td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/niriliya.png" src="//duihui.qiumibao.com/nba/default_h.png
                " alt=""/></div>
                                            <div><b>尼日利亚</b></div></td><td ><div class="s_name"><b>足球友谊赛</div><div class="s_keyword">PPTV</div></td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/madelijingji.png" src="//duihui.qiumibao.com/nba/default_v.png
                " alt=""/></div>
                                            <div><b>马德里竞技</b></div>
                                        </td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 足球友谊赛 尼日利亚 - 马德里竞技 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 01:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 01:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="其他,足球,桑德捷斯基,奥胡斯" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124629.htm" title="01:00 丹超 桑德捷斯基 - 奥胡斯"  ><table id='124629'><tr>
                                        <td class="s_time" >01:00</td><td><div>桑德捷斯基</div></td><td ><div class="s_name">丹超</div><div class="s_keyword">体育直播</div></td><td><div>奥胡斯</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 丹超 桑德捷斯基 - 奥胡斯 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 01:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 01:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="其他,足球,厄勒布鲁,卡尔马" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124640.htm" title="01:00 瑞典超 厄勒布鲁 - 卡尔马"  ><table id='124640'><tr>
                                        <td class="s_time" >01:00</td><td><div>厄勒布鲁</div></td><td ><div class="s_name">瑞典超</div><div class="s_keyword">体育直播</div></td><td><div>卡尔马</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 瑞典超 厄勒布鲁 - 卡尔马 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 01:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 01:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="其他,足球,布格勒斯特祖云斯,康戈迪亚齐安" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124641.htm" title="01:45 罗甲 布格勒斯特祖云斯 - 康戈迪亚齐安"  ><table id='124641'><tr>
                                        <td class="s_time" >01:45</td><td><div>布格勒斯特祖云斯</div></td><td ><div class="s_name">罗甲</div><div class="s_keyword">体育直播</div></td><td><div>康戈迪亚齐安</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 罗甲 布格勒斯特祖云斯 - 康戈迪亚齐安 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 01:45&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 01:45</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="其他" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124637.htm" title="08:00 WWE美国职业摔角"  ><table ><tr>
                                        <td class="s_time" >08:00</td><td style="width:1%;"></td><td style="width:67%;"><div class="s_name">WWE美国职业摔角</div><div class="s_keyword">PPTV</div></td><td style="width:1%;"></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 WWE美国职业摔角 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 08:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 08:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="解放者杯,足球,智利大学,瓦斯科达伽马" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124642.htm" title="08:30 解放者杯 智利大学 - 瓦斯科达伽马"  ><table id='124642'><tr>
                                        <td class="s_time" >08:30</td><td><div>智利大学</div></td><td ><div class="s_name">解放者杯</div><div class="s_keyword">体育直播</div></td><td><div>瓦斯科达伽马</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 解放者杯 智利大学 - 瓦斯科达伽马 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 08:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 08:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="解放者杯,足球,克鲁塞罗,竞技俱乐部" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124643.htm" title="08:30 解放者杯 克鲁塞罗 - 竞技俱乐部"  ><table id='124643'><tr>
                                        <td class="s_time" >08:30</td><td><div>克鲁塞罗</div></td><td ><div class="s_name">解放者杯</div><div class="s_keyword">体育直播</div></td><td><div>竞技俱乐部</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 解放者杯 克鲁塞罗 - 竞技俱乐部 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 08:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 08:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="basketball "label="NBA,勇士,火箭,篮球" >
                        <h2><a href="//m.zhibo8.cc/zhibo/nba/2018/0523123632.htm" title="09:00 NBA西部决赛4 勇士 - 火箭"  ><table id='123632'><tr>
                                        <td class="s_time" >09:00</td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/nba/yongshi.png" src="//duihui.qiumibao.com/nba/default_h.png
                " alt=""/></div>
                                            <div><b>勇士</b></div></td><td ><div class="s_name"><b>NBA西部决赛4</div><div class="s_keyword">CCTV5 广体 QQ直播 互动直播</div></td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/nba/huojian.png" src="//duihui.qiumibao.com/nba/default_v.png
                " alt=""/></div>
                                            <div><b>火箭</b></div>
                                        </td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 NBA西部决赛4 勇士 - 火箭 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 09:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 09:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="NHL,其他" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124532.htm" title="09:00 NHL西部决赛5"  ><table ><tr>
                                        <td class="s_time" >09:00</td><td style="width:1%;"></td><td style="width:67%;"><div class="s_name">NHL西部决赛5</div><div class="s_keyword">CCTV5+</div></td><td style="width:1%;"></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 NHL西部决赛5 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 09:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 09:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="德甲,多特蒙德,MLS,足球,洛杉矶FC" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124644.htm" title="10:00 足球友谊赛 洛杉矶FC - 多特蒙德"  ><table id='124644'><tr>
                                        <td class="s_time" >10:00</td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/luoshanjifc.png" src="//duihui.qiumibao.com/nba/default_h.png
                " alt=""/></div>
                                            <div><b>洛杉矶FC</b></div></td><td ><div class="s_name"><b>足球友谊赛</div><div class="s_keyword">体育直播</div></td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/duotemengde.png" src="//duihui.qiumibao.com/nba/default_v.png
                " alt=""/></div>
                                            <div><b>多特蒙德</b></div>
                                        </td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 足球友谊赛 洛杉矶FC - 多特蒙德 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 10:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 10:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="羽毛球,其他,中国羽毛球队,印度尼西亚羽毛球队" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124511.htm" title="12:35 尤伯杯小组赛D组 中国羽毛球队 - 印度尼西亚羽毛球队"  ><table id='124511'><tr>
                                        <td class="s_time" >12:35</td><td><div>中国羽毛球队</div></td><td ><div class="s_name">尤伯杯小组赛D组</div><div class="s_keyword">CCTV5</div></td><td><div>印度尼西亚羽毛球队</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 尤伯杯小组赛D组 中国羽毛球队 - 印度尼西亚羽毛球队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 12:35&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 12:35</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="其他,日本羽毛球队,印度羽毛球队" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124533.htm" title="15:00 尤伯杯小组赛A组 日本羽毛球队 - 印度羽毛球队"  ><table id='124533'><tr>
                                        <td class="s_time" >15:00</td><td><div>日本羽毛球队</div></td><td ><div class="s_name">尤伯杯小组赛A组</div><div class="s_keyword">CCTV5+</div></td><td><div>印度羽毛球队</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 尤伯杯小组赛A组 日本羽毛球队 - 印度羽毛球队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 15:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 15:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="中超,天津权健,亚冠,J联赛,K联赛,足球,抽签" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124639.htm" title="16:30 亚冠1/4决赛抽签仪式 亚冠 - 抽签"  ><table id='124639'><tr>
                                        <td class="s_time" >16:30</td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/yaguan.png" src="//duihui.qiumibao.com/nba/default_h.png
                " alt=""/></div>
                                            <div><b>亚冠</b></div></td><td ><div class="s_name"><b>亚冠1/4决赛抽签仪式</div><div class="s_keyword">等待更新</div></td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/chouqian.png" src="//duihui.qiumibao.com/nba/default_v.png
                " alt=""/></div>
                                            <div><b>抽签</b></div>
                                        </td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 亚冠1/4决赛抽签仪式 亚冠 - 抽签 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 16:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 16:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="排球,其他,波兰女排队,塞尔维亚女排队" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124534.htm" title="17:30 女排国家联赛 波兰女排队 - 塞尔维亚女排队"  ><table id='124534'><tr>
                                        <td class="s_time" >17:30</td><td><div>波兰女排队</div></td><td ><div class="s_name">女排国家联赛</div><div class="s_keyword">CCTV5+</div></td><td><div>塞尔维亚女排队</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 女排国家联赛 波兰女排队 - 塞尔维亚女排队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 17:30&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 17:30</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="football "label="中超,中国男足,足球,中国男足U19,匈牙利U19" >
                        <h2><a href="//m.zhibo8.cc/zhibo/zuqiu/2018/0523124502.htm" title="19:00 国际青年足球锦标赛 中国男足U19 - 匈牙利U19"  ><table id='124502'><tr>
                                        <td class="s_time" >19:00</td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/zhongguo.png" src="//duihui.qiumibao.com/nba/default_h.png
                " alt=""/></div>
                                            <div><b>中国男足U19</b></div></td><td ><div class="s_name"><b>国际青年足球锦标赛</div><div class="s_keyword">QQ直播 PPTV</div></td><td><div><img class="lazy" data-original="//duihui.qiumibao.com/zuqiu/xiongyali.png" src="//duihui.qiumibao.com/nba/default_v.png
                " alt=""/></div>
                                            <div><b>匈牙利U19</b></div>
                                        </td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 国际青年足球锦标赛 中国男足U19 - 匈牙利U19 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 19:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 19:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="排球,其他,中国女排,泰国女排" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124499.htm" title="20:00 女排国家联赛 中国女排 - 泰国女排"  ><table id='124499'><tr>
                                        <td class="s_time" >20:00</td><td><div>中国女排</div></td><td ><div class="s_name">女排国家联赛</div><div class="s_keyword">CCTV5 广东体育</div></td><td><div>泰国女排</div></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 女排国家联赛 中国女排 - 泰国女排 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 20:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 20:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li><li class="lite" type="other "label="其他" >
                        <h2><a href="//m.zhibo8.cc/zhibo/other/2018/0523124535.htm" title="20:00 汤姆斯杯小组赛D组 丹麦羽毛球队--马来西亚羽毛球队"  ><table ><tr>
                                        <td class="s_time" >20:00</td><td style="width:1%;"></td><td style="width:67%;"><div class="s_name">汤姆斯杯小组赛D组</div><div class="s_keyword">CCTV5+</div></td><td style="width:1%;"></td><td><div class="remind">
                                                <a href="//qzs.qq.com/snsapp/app/bee/widget/open.htm?content=【 汤姆斯杯小组赛D组 丹麦羽毛球队--马来西亚羽毛球队 】即将开始，请到 直播吧 www.zhibo8.cc 观看赛事直播。&time=2018-05-23 20:00&advance=5" target="_blank">
                                                    <img src="//static4style.oss-cn-hangzhou.aliyuncs.com/common/img/clock1.png" id="clock1"/>
                                                </a>
                                            </div></td><td><div class="hideTime" style="display:none;">2018-05-23 20:00</div></td>
                                    </tr></table>
                            </a></h2>
                    </li></ul>
            </div><!--end list-->
        </div><!--end panel-->
    </div><!--end content-->
</div><!--end module-->



</body>