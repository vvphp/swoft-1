<?php $this->include('layouts/admin/head') ?>
</head>

<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add">

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">                
                <button onClick="startlive();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 开始直播</button>
                <button onClick="endtlive();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 结束直播</button> 
            </div>
        </div>
 
         <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button  class="btn btn-secondary radius" id="start-record-btn" type="button"><i class="Hui-iconfont">&#xe632;</i> 开始语音直播</button> 

                <button  class="btn btn-primary radius" id="pause-record-btn" type="button"><i class="Hui-iconfont">&#xe632;</i> 暂停语音直播</button>
            </div>
         </div>




        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>第几节：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="timeframe" class="select">
                    <option value="0">赛前</option>
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="2">3</option>
                    <option value="2">4</option>
                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>球队：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="team_id" class="select">
                    <option value="<?php echo $data['homeTeamId']; ?>"><?php echo $data['hometeamName']; ?></option>
                    <option value="<?php echo $data['visitingTeamId']; ?>"><?php echo $data['visitingteamName']; ?></option>
                </select>
				</span> </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">赛况内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" type="text/plain" style="width:100%;height:200px;"></script>
            </div>
        </div>

        <div class="row cl">            
              <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                 <p id="recording-instructions">按下 <strong>开始语音直播</strong> 按钮并按提示给予相关权限。</p>
           </div>
        </div>


        <div class="row cl">
            <input type="hidden" value="<?php echo $game_id; ?>" id="game_id" name="game_id">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="sendData();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 发送</button>
            </div>
        </div>
    </form>
</article>

<?php $this->include('layouts/admin/footer') ?>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/h-ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/static/h-ui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/static/admin/live.js"></script>

<script type="text/javascript">

    setInterval("getLiveUserCount()",5000);
    /**
     * 提交直播数据
     */
   function sendData()
   {
        $.ajax({
             type: "POST",
             url: "/admin/match/saveDetails",
             data: $("form").serialize(),
             dataType: "json",
             success: function(data){
                         console.log(data);
                       }
         });
   }

    /**
     * 获取用户总数
     */
    function getLiveUserCount()
   {
       var game_id = $("#game_id").val();
       $.ajax({
           type: "GET",
           url: "/admin/match/getLiveUserNumber?game_id="+game_id,
           dataType: "json",
           success: function(data){
               var count = data.data.count;
               var text = $(".layui-layer-title").text()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当前观看直播人数为"+count;
               $(".layui-layer-title").text(text);
               console.log(data);
           }
       });
   }


    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });


        $list = $("#fileList"),
            $btn = $("#btn-star"),
            state = "pending",
            uploader;

        var uploader = WebUploader.create({
            auto: true,
            swf: '/static/h-ui/lib/webuploader/0.1.5/Uploader.swf',

            // 文件接收服务端。
            server: 'fileupload.php',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                    '<div id="' + file.id + '" class="item">' +
                    '<div class="pic-box"><img></div>'+
                    '<div class="info">' + file.name + '</div>' +
                    '<p class="state">等待上传...</p>'+
                    '</div>'
                ),
                $img = $li.find('img');
            $list.append( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress-box .sr-only');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
            }
            $li.find(".state").text("上传中");
            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress-box').fadeOut();
        });
        uploader.on('all', function (type) {
            if (type === 'startUpload') {
                state = 'uploading';
            } else if (type === 'stopUpload') {
                state = 'paused';
            } else if (type === 'uploadFinished') {
                state = 'done';
            }

            if (state === 'uploading') {
                $btn.text('暂停上传');
            } else {
                $btn.text('开始上传');
            }
        });

        $btn.on('click', function () {
            if (state === 'uploading') {
                uploader.stop();
            } else {
                uploader.upload();
            }
        });

        var ue = UE.getEditor('editor');

    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>