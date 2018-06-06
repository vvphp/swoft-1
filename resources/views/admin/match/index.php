<?php $this->include('layouts/admin/head') ?>
</head>

<body>

<?php $this->include('layouts/admin/header') ?>

<?php $this->include('layouts/admin/menu') ?>

<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span>
        赛事管理
        <span class="c-gray en">&gt;</span>
        赛事列表
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="Hui-article">
        <article class="cl pd-20">
            <div class="text-c">
                日期范围：
                <input type="text" value="<?php echo isset($queryArr['startDate']) ? $queryArr['startDate'] : ''; ?>" name="startDate"  onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
                -
                <input type="text" value="<?php echo isset($queryArr['endDate']) ? $queryArr['endDate'] : ''; ?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
                <input type="text" name="gameName" id="gameName" value="<?php echo isset($queryArr['gameName']) ? $queryArr['gameName'] : ''; ?>" placeholder="球队名称" style="width:250px" class="input-text">
                <button name="search" id="search" class="btn btn-success" type="button"><i class="Hui-iconfont">&#xe665;</i> 搜比赛</button>
            </div>
            <div class="cl pd-5 bg-1 bk-gray mt-20">
                <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span>
            </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="checkAll" value="" id="checkAll"></th>
                        <th width="80">ID</th>
                        <th width="80">赛会名称</th>
                        <th width="120">赛事</th>
                        <th width="120">比赛时间</th>
                        <th width="80">解说员</th>
                        <th width="75">直播状态</th>
                        <th width="120">直播平台</th>
                        <th width="120">操作</th>
                    </tr>
                    </thead>
                    <tbody id="pageData">
                    <?php foreach($data as $index => $item){ ?>
                        <tr class="text-c">
                        <td><input type="checkbox" value="<?php echo $item['id']; ?>" name="id"></td>
                        <td><?php echo $item['id']; ?></td>
                        <td class="text-l"><a href="/admin/match/matchList/?competition_name=<?php echo $item['competition_name']; ?>"> <?php echo $item['competition_name']; ?></a></td>
                        <td><?php echo !empty($item['home_team']) ? $item['home_team']['teamName'].'--'.$item['visiting_team']['teamName'] : $item['competition_name']; ?></td>
                        <td><?php echo $item['gameDate'].' '.$item['dataTime'] ?></td>
                        <td><?php echo isset($item['narratorData']['name']) ? $item['narratorData']['name']:''; ?></td>
                        <td><?php echo $liveStatus[$item['liveStatus']]; ?></td>
                        <td class="f-14 td-manage">
                            <?php foreach($item['play_links'] as $plk => $plv){ ?>
                                <a style="text-decoration:none" href="<?php echo $plv['playUrl']; ?>" title="<?php echo $plv['playPlatform']; ?>"><i class="Hui-iconfont"><?php echo $plv['playPlatform']; ?></i></a>
                            <?php } ?>
                        </td>
                        <td class="f-14 td-manage"><a style="text-decoration:none"  onclick="article_add('开始直播','/admin/match/startLive/<?php echo $item['id']; ?>','10001')"  href="javascript:;" title="开始直播"><i class="Hui-iconfont">&#xe6de;</i></a>
                            <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo $item['id'] ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <div id="page" style="margin-top: 30px; text-align: center"></div>

            </div>
        </article>
    </div>
</section>


<?php $this->include('layouts/admin/footer') ?>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/h-ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/h-ui/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    $("#search").click(function(){
        var gameName = $("#gameName").val();
        var logmin   = $("#logmin").val();
        var logmax   = $("#logmax").val();
        window.location.href = "?page=1&gameName="+gameName+"&startDate="+logmin+"&endDate="+logmax;
    })
    laypage({
        cont: 'page',//分页容器的id
        pages: <?php echo $countPage; ?>, //总页数
        skip: true,
        groups: 3,
        curr: <?php echo $page; ?>, //当前页
        skin: 'yahei',  //当前页的颜色
        jump:function(e,first){
            var gameName = $("#gameName").val();
            var logmin   = $("#logmin").val();
            var logmax   = $("#logmax").val();
            if(!first){
                 window.location.href = '?page='+e.curr+"&gameName="+gameName+"&startDate="+logmin+"&endDate="+logmax;
             }
        }
    });

    /*资讯-添加*/
    function article_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*资讯-删除*/
    function article_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                data:{'id':id},
                url: '/admin/match/del',
                success: function(data){
                    data = JSON.parse(data);
                    if(data.code == '1') {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
                    }else{
                        layer.msg('删除失败!', {icon: 1, time: 1000});
                    }
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
</body>
</html>