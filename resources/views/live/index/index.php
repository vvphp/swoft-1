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
            <h2>今天 <?php echo $item['gameDate']; ?> 星期二</h2>
            <?php   foreach($value as $index => $item){ ?>
            <a href="./detail.html">
                <div class="match-item">
                    <div class="match-item-info">
                        <div class="match-time">
                            <?php echo $item['dataTime']; ?>
                            <img src="./imgs/match.png" width="25px" height="25px" />
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
                            <span>79</span>
                        </div>
                     <?php endif; ?>

                     <?php if($item['visitingTeamId'] > 0): ?>
                        <div>
							 <span>
                                 <?php if($item['visiting_team']['teamLogo']){ ?>
									<img src="./imgs/team2.png" width="25px" height="25px" />
								<?php }  ?>
                                    <?php echo $item['visiting_team']['teamName']; ?>
							 </span>
                         <span>80</span>
                        </div>
                     <?php endif; ?>

                    </div>
                    <div class="match-item-result isLive">
                        <div>图片直播</div>
                        <div>进行中</div>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
       <?php  } ?>
    </div>
</div>
