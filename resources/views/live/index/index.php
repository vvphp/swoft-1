<body>
<div>
    <header class="header">
        赛程
        <!--用户处于登录状态时，将该按钮隐藏-->
        <a href="./login.html">
            <!-- <i class="icon iconfont icon-wode my"></i> -->
            <span class="my">登录</span>
        </a>
    </header>

    <div class="content">
       <?php  foreach($data as $key => $value){ ?>
           <div class="match">
            <h2><?php if($item['gameDate'] == date('Y-m-d')){ echo '今天';} ?> <?php echo $item['gameDate'];?> <?php echo  $item['weekDay']; ?></h2>
            <?php   foreach($value as $index => $item){ ?>
            <a href="./detail.html">
                <div class="match-item">
                    <div class="match-item-info">
                        <div class="match-time">
                            <?php echo $item['dataTime']; ?>
                        </div>
                        <div><?php echo $item['competition_name']; ?></div>
                    </div>
                    <div class="match-item-teams isLive">
                     <?php if($item['homeTeamId'] > 0): ?>
                        <div>
								<span>
                                    <?php if($item['home_team']['teamLogo']): ?>
									   <img src="<?php echo $item['home_team']['teamLogo']; ?>" width="25px" height="25px" />
									<?php endif; ?>
									<?php echo $item['home_team']['teamName']; ?>
								</span>
                        </div>
                     <?php endif; ?>

                     <?php if($item['visitingTeamId'] > 0): ?>
                        <div>
							 <span>
                                 <?php if($item['visiting_team']['teamLogo']){ ?>
									<img src="<?php $item['visiting_team']['teamLogo']; ?>" width="25px" height="25px" />
								<?php }  ?>
                                    <?php echo $item['visiting_team']['teamName']; ?>
							 </span>
                        </div>
                     <?php endif; ?>

                    </div>
                    <div class="match-item-result isLive">
                        <?php foreach($item['play_links'] as $pK => $pv){ ?>
                        <li><a href="<?php echo $pv['playUrl'] ?>" target="_blank"> <?php echo $pv['playPlatform'] ?></a></li>
                        <?php } ?>
                    </div>

                </div>
            </a>
            <?php } ?>
        </div>
       <?php  } ?>
    </div>
</div>
