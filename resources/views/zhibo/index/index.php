<body>
<?php $this->include('layouts/zhibo/menu') ?>

<div class="container margin_top_20">
    <div id="recommend" class="left">
        <div class="r_video left">
            <ul>
                <?php foreach($videoNewsList[0] as $key => $val){ ?>
                <li <?php if($key == 0): ?> class="head ico_fb" <?php endif; ?>>
                    <?php foreach($val as $index => $item){ ?>
                       <a href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['title']; ?></a>
                       <?php if($index == 0): ?>
                          <span></span>
                      <?php endif; ?>
                   <?php } ?>
                </li>
            <?php }?>
            </ul>
        </div>

        <div class="r_news right">
            <ul>
                <?php foreach($textNewsList[0] as $key => $val){ ?>
                <li <?php if($key == 0): ?> class="head"  <?php endif; ?>>
                    <?php foreach($val as $index => $item){ ?>
                    <a   href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['title']; ?></a>
                        <?php if($index == 0): ?>
                               <span></span>
                        <?php endif; ?>
                    <?php } ?>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="line clear"></div>
        <div class="r_video left">
            <ul>
                <?php foreach($videoNewsList[1] as $key => $val){ ?>
                    <li <?php if($key == 0): ?> class="head ico_fb" <?php endif; ?>>
                        <?php foreach($val as $index => $item){ ?>
                            <a href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['title']; ?></a>
                            <?php if($index == 0): ?>
                                <span></span>
                            <?php endif; ?>
                        <?php } ?>
                    </li>
                <?php }?>
            </ul>
        </div>
        <div class="r_news right">
            <ul>
                <?php foreach($textNewsList[1] as $key => $val){ ?>
                    <li <?php if($key == 0): ?> class="head"  <?php endif; ?>>
                        <?php foreach($val as $index => $item){ ?>
                            <a   href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['title']; ?></a>
                            <?php if($index == 0): ?>
                                <span></span>
                            <?php endif; ?>
                        <?php } ?>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>


<div class="container margin_top_10 ovs">
    <div class="schedule_container left">
        <?php  foreach($data as $key => $value){ ?>
        <div class="box">
            <div class="titlebar">
                <h2 title="<?php echo $key; ?>"><?php echo date('m月d日',strtotime($key)).'&nbsp;'.$value[0]['weekDay']; ?></h2>
            </div>
            <div class="content">
                <ul>
                 <?php   foreach($value as $index => $item){ ?>
                    <li label="<?php echo $item['label']; ?>" id="saishi<?php echo $item['id']; ?>" data-time="<?php echo $item['gameDate'];echo '&nbsp;&nbsp;'.$item['dataTime']; ?>"><?php echo $item['dataTime'].'&nbsp;&nbsp;'.$item['competition_name']; ?>
                     <?php if($item['homeTeamId'] > 0): ?>
                          <?php echo $item['home_team']['teamName']; ?>  <?php if($item['home_team']['teamLogo']): ?> <img src="<?php echo $item['home_team']['teamLogo']; ?>" > <?php endif; ?> <span> - </span> <?php if($item['visiting_team']['teamLogo']):?><img src="<?php echo $item['visiting_team']['teamLogo']; ?>" ><?php endif; ?> <?php echo $item['visiting_team']['teamName']; ?>
                     <?php endif; ?>
                        <?php foreach($item['play_links'] as $pk => $pl){ ?>
                            <a href="<?php echo $pl['playUrl'] ?>" target="_blank"><?php echo $pl['playPlatform'] ?></a>
                        <?php }  ?>
                           <a href="/live/detail/wenzi/<?php echo $item['id']; ?>" target="_blank">雷子直播</a>
                    </li>
                 <?php } ?>
                </ul>
            </div>
        </div>
       <?php } ?>
    </div>
</div>

