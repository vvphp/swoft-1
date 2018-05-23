<div class="footer container">
  <div id="links"> 合作网站: <a href="//m.zhibo8.cc/" title="直播吧手机版" target="_blank">手机直播吧</a>&nbsp;&nbsp; <a href="http://www.188hi.com/" target="_blank">188Hi网址导航</a>&nbsp;&nbsp; <a href="http://www.hao123.com/" target="_blank">Hao123网址导航</a>&nbsp;&nbsp; <a href="//www.zhibo8.cc/link.htm" target="_blank">进入友情链接</a> <br />
    <a href="//www.zhibo8.cc/contact.htm" target="_blank"><font color="red">联系我们</font></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="//www.zhibo8.cc/mianze.htm" target="_blank">免责声明</a> <a href="//pl.zhibo8.cc/usercenter/web/userService.html" target="_blank">用户协议</a> <a href="//www.zhibo8.cc/web/privacyPolicyPc.html" target="_blank">隐私政策</a> <a href="//www.zhibo8.cc/baocuo.htm" target="_blank">报错反馈</a> <a href="//m.zhibo8.cc/feedback/" target="_blank">投诉反馈</a>&nbsp;&nbsp;<a href="http://report.12377.cn:13225/toreportinputNormal_anis.do" target="_blank" rel="external nofollow">网上有害信息举报专区</a></div>
  <div id="copyright"><a href="/">直播吧</a>所有视频均链接到各大视频网站播放，本站不提供任何视听上传服务，如有异议请与我们取得联系。<br>闽网文（2016）5589-096号  闽B2-20160123  闽ICP备15018471号-2 <br><img src="//static4style.qiumibao.com/common/img/policy_icon.jpg" /> 闽公网安备 35020302001925号</div>
</div>



<script src="https://static4style.qiumibao.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://www.zhibo8.cc/js/v2/common.js" type="text/javascript"></script>
<script src="https://www.zhibo8.cc/js/v2/index_main.js"></script>
<script src="https://www.zhibo8.cc/js/adv-slide-toggle.js" ></script>

<script>
  $(function(){
    $(".icon16-close").click(function(){
      $("#popautoapp").hide();
      return false;
    });
    if(navigator.userAgent.indexOf('Mobile')>-1 || navigator.userAgent.indexOf('mobile')>-1 || navigator.userAgent.indexOf('Android')>-1 || navigator.userAgent.indexOf('iPad')>-1 || navigator.userAgent.indexOf('iPhone')>-1){
      $("#popautoapp").hide();
    }
  });
</script>

<style>
  .pop-autoapp {
    width: 130px;
    height: 180px;
    /*position: fixed;*/
    left: 50%;
    margin-left: 510px;
    top: 90px;
    /*top:690px;*/
    position: absolute;
  }
  .pop-autoapp a:link, .pop-autoapp a:visited {
    color: #666666;
    background-color: #efefef;
    text-decoration: none;
  }
  .pop-autoapp a:hover {
    color: #666666;
    background-color: #d0d0d0;
    text-decoration: none;
  }
  .pop-autoapp a {
    display: block;
    width: 130px;
    height: 180px;
    text-align: center;
    font-size: 12px;
  }
  .pop-autoapp a div {
    line-height: 24px;
  }

  .pop-autoapp span.icon16 {
    width: 30px;
    height: 15px;
    display: inline-block;
    padding: 0;
    overflow: hidden;
    cursor: pointer;
    border: solid 1px #ccc;
    margin-bottom: 1px;
    text-align: center;
  }
  .pop-autoapp a .pop-autoapp-close {
    line-height: 15px;
    height: 18px;
    margin-bottom: 3px;
    text-align: right;
    background-color: #ffffff;
  }
  .pop-autoapp a .pop-autoapp-close {
    text-align: right;
  }
</style>


<style>
  .ui-icon {
    width: 18px;
    height: 18px;
  }
  .ui-icon-shadow {
    -moz-box-shadow: 0 1px 0 rgba(255,255,255,.4);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.4);
    box-shadow: 0 1px 0 rgba(255,255,255,.4);
  }
  .ui-icon-delete {
    background-position: -73px -1px;
  }
  .ui-icon, .ui-icon-searchfield:after {
    background-color: #666;
    background-color: rgba(0,0,0,.4);
    background-image: url(//code.jquery.com/mobile/1.3.0/images/icons-18-white.png);
    background-repeat: no-repeat;
    -webkit-border-radius: 9px;
    border-radius: 9px;
  }
</style>
<script>
  function setDomainCookie(name,value,domain)
  {
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString()+";domain=" + domain + ";path=/";
  }
  var browser={
    versions:function(){
      var u = navigator.userAgent, app = navigator.appVersion;
      return {         //移动终端浏览器版本信息
        trident: u.indexOf('Trident') > -1, //IE内核
        presto: u.indexOf('Presto') > -1, //opera内核
        webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
        gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
        mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
        ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
        android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
        iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
        iPad: u.indexOf('iPad') > -1, //是否iPad
        webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
        JUC: u.indexOf('UCWEB') > -1 ||  u.indexOf('JUC') > -1 || u.indexOf('rv:1.2.3.4') > -1 || u.indexOf('Firefox/1.') > -1
      };
    }(),
    language:(navigator.browserLanguage || navigator.language).toLowerCase()
  }
  $(function(){
    if(browser.versions.android){
      $("body").css("margin-top",'40px');
      $("#m_adv").show();
      $("#m_close").click(function(){
        $("#m_adv").hide();
        $("body").css("margin-top",'0');
      });
      $("#m_adv").click(function(){
        window.location = '//m.zhibo8.cc/download/?dev=android';
      });
    }
  })


  function IsMobile() {
    if(screen==undefined||screen.width>1200 || browser.versions.iPad==true){
      return false;
    }
    if (browser.versions.android == true || browser.versions.iPhone == true || browser.versions.JUC == true ) {
      return true;
    }
    return false;
  }

  if (IsMobile()){
    $(".headeradvert").html('<span onclick="click_span_m()" style="display:block; width:320px; margin:0 auto; text-align:center; color:#fff; background: #4998e7;font-size:55px; line-height:70px;border-radius: 16px;">触屏版</span>');
  }

  function click_span_m() {
    if (IsMobile()){
      setDomainCookie("defaultJumpDomain", "m",".zhibo8.cc");
    }
    window.location.href = "//m.zhibo8.cc";
  }
</script>


<style>
  .bf-box {
    position:fixed;
    border:2px solid #ccc;
    background:#fff;
    font-size:12px;
    width:auto;
    z-index:1;
    display:none;
  }
  .bf-triangle {
    display:block;
    position:relative;
    left:60px;
    top:-16px;
    z-index:20;
  }
  .bf-triangle .t-border,
  .bf-triangle .t-inset {
    left:0px;
    top:0px;
    width:0;
    height:0;
    font-size:0;
    overflow:hidden;
    position:absolute;
    border-width:8px;
    border-style:dashed dashed solid dashed ;
  }
  .bf-triangle .t-border {
    border-color:transparent transparent #ccc transparent;
    top:-2px;
  }
  .bf-triangle .t-inset {
    border-color: transparent transparent #fff transparent ;
  }
  .bf-content {
    padding:3px;
    margin:3px;
    text-align:center;
    line-height:18px;
  }
  .bf-content p {
    margin:0;
    padding:0;
    height: 20px;
  }
  .bf-content .bf-period {
    width:60px;
    float:left;
  }
  .bf-content .bf-nba {
    float:left;
    padding-left:10px;
    border-left:2px #ccc solid;
    min-width: 150px;
  }
  .bf-content .bf-nba span {
    display:inline-block;
    width:30px;
  }
  .bf-content .bf-zuqiu1 {
    text-align:left;
    float:left;
    border-right:2px #ccc solid;
    min-width:150px;
    min-height:50px;
  }
  .bf-content .bf-zuqiu2 {
    text-align:right;
    float:left;
    border-left:2px #ccc solid;
    min-width:150px;
    min-height:50px;
  }
  .bf-content span {
    display: inline-block;
    vertical-align: middle;
    width: 15px;
    height: 20px;
    background: transparent url("//static4style.oss-cn-hangzhou.aliyuncs.com/txt_pc_img/event_bg2.png") no-repeat 1px 3px;
    margin:0 3px;
  }

  .bf-content span.red {
    background: transparent url("//static4style.oss-cn-hangzhou.aliyuncs.com/txt_pc_img/event_bg2.png") no-repeat 1px -93px;
  }
  .bf-content span.wulong {
    background: transparent url("//static4style.oss-cn-hangzhou.aliyuncs.com/txt_pc_img/event_bg2.png") no-repeat 1px -240px;
  }
  .bf-content span.huang2 {
    background: transparent url("//static4style.oss-cn-hangzhou.aliyuncs.com/txt_pc_img/event_bg2.png") no-repeat 1px -210px;
  }
  .bf-content .bf-clear {
    clear:both;
  }

</style>

<div class="bf-box">
  <div class="bf-triangle">
    <div class="t-border"></div>
    <div class="t-inset"></div>
  </div>

  <div class="bf-content">
    <div class="bf-zuqiu1"></div>
    <div class="bf-period"></div>
    <div class="bf-zuqiu2"></div>
    <div class="bf-clear"></div>
  </div>
</div>


<script src="/js/fbjs/bf4.js"></script>


<div style="display: none">
  <script src="//v12.cnzz.com/stat.php?id=709406&amp;web_id=709406&amp;show=pic1" language="JavaScript" charset="gb2312"></script>
</div>
<script>
  var _hmt = _hmt || [];
  (function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?3212511d67978fc36e99a8ba103a1cc8";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
  })();
</script>
