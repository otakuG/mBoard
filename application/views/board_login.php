		<div class="container">
			<form method="post" action="<?php echo site_url('board/setMsg'); ?>" id="postForm" class="text-center">
				<textarea name='msg' rows="3" placeholder="輸入你的訊息"></textarea>
				<button type="submit" class="btn">POST</button>
				<div class="clear"></div>
			</form>
			<?php foreach($msg as $msgItem): ?>
			<div class="msgBox">
				<div class="postInfo">
					<form class="deleteForm" method="post" action="<?php $uri = $this->uri->segment(3); echo site_url('admin/deleteMsg/' . $uri); ?>">
						<button class="btn btn-danger btn-mini" name="delete" value="<?php echo $msgItem['PID']; ?>">刪除</button>
					</form>
					<div class="msgTime"><?php echo $msgItem['datetime']; ?></div>
					<div class="clear"></div>
				</div>
				<div class="clear msgContent"><?php echo $msgItem['msg']; ?></div>
				<?php foreach($msgItem['reply'] as $reItem){
					if($reItem['PID'] == $msgItem['PID']){
						echo "<div class='msgTime'>" . $reItem['datetime'] . "</div>";
						echo "<div class='clear msgContent'>" . $reItem['msg'] . "</div>";
					}
				}?>	
				<form method="post" action="<?php $uri = $this->uri->segment(3); echo site_url('board/setReply/' . $uri); ?>" id="replayForm">
					<textarea name="reply" row="2" placeholder="輸入你的回覆"></textarea>
					<button type="submit" class="btn btn-mini" name="PID" value="<?php echo $msgItem['PID']; ?>">回覆</button>
					<div class="clear"></div>
				</form>
			</div>
			<?php endforeach; ?>
		</div>