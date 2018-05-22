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
                        <h2><a href="/zhibo/detail/<?php echo $item['id'] ?>" title="<?php echo $item['dataTime']; ?>   <?php echo $item['competition_name'];?>   <?php echo $item['home_team']['teamName']; ?> - <?php echo $item['visiting_team']['teamName']; ?>"  >
                                <table id='<?php echo $item['id'] ?>'>
                                 <tr>
                                        <td class="s_time" ><?php echo $item['dataTime']; ?></td><td><div><?php echo $item['home_team']['teamName']; ?></div></td><td ><div class="s_name"><?php echo $item['competition_name']; ?></div><div class="s_keyword">CCTV5+</div></td><td><div><?php echo $item['visiting_team']['teamName']; ?></div></td><td><div class="remind">进行中</div></td><td><div class="hideTime" style="display:none;">  <?php echo $item['gameDate']; ?>  <?php echo $item['dataTime']; ?></div></td>
                                    </tr>
                                    </table>
                            </a></h2>
                    </li>
                    <?php } ?> 
                </ul>
            </div><!--end list-->
        </div><!--end panel-->
    </div><!--end content-->
</div><!--end module-->
<?php } ?>  
</body>