<div class="footer container">
  <div id="links"> 合作网站: <a href="//m.zhibo8.cc/" title="直播吧手机版" target="_blank">手机直播吧</a>&nbsp;&nbsp; <a href="http://www.188hi.com/" target="_blank">188Hi网址导航</a>&nbsp;&nbsp; <a href="http://www.hao123.com/" target="_blank">Hao123网址导航</a>&nbsp;&nbsp; <a href="//www.zhibo8.cc/link.htm" target="_blank">进入友情链接</a> <br />
    <a href="//www.zhibo8.cc/contact.htm" target="_blank"><font color="red">联系我们</font></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="//www.zhibo8.cc/mianze.htm" target="_blank">免责声明</a> <a href="//pl.zhibo8.cc/usercenter/web/userService.html" target="_blank">用户协议</a> <a href="//www.zhibo8.cc/web/privacyPolicyPc.html" target="_blank">隐私政策</a> <a href="//www.zhibo8.cc/baocuo.htm" target="_blank">报错反馈</a> <a href="//m.zhibo8.cc/feedback/" target="_blank">投诉反馈</a>&nbsp;&nbsp;<a href="http://report.12377.cn:13225/toreportinputNormal_anis.do" target="_blank" rel="external nofollow">网上有害信息举报专区</a></div>
  <div id="copyright"><a href="/">直播吧</a>所有视频均链接到各大视频网站播放，本站不提供任何视听上传服务，如有异议请与我们取得联系。<br>闽网文（2016）5589-096号  闽B2-20160123  闽ICP备15018471号-2 <br><img src="//static4style.qiumibao.com/common/img/policy_icon.jpg" /> 闽公网安备 35020302001925号</div>
</div>


<script src="/static/zhibo8/js/jquery.min.js"></script>
<script src="/static/zhibo8/js/common.js" type="text/javascript"></script>

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
