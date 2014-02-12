<h4><?php echo __d('advertising','Block code')?></h4>
<div class="well">
	<div style="margin: 20px;border: 1px solid	#ccc; padding: 10px; overflow: hidden;">
		<?php ob_start();?>
			<?php if($block['Block']['multiple']):?>
				<?php if($block['Block']['orientation'] == '1'): //1 = horizontal?>
					<iframe src="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'show',$block['Block']['id'],'admin'=>false), true)?>" width="<?php echo ((int) $block['Block']['width'] * (int) $block['Block']['ad_number_visible'])?>" height="<?php echo $block['Block']['height'];?>" frameborder="0" scrolling="no"></iframe>
				<?php else:?>
					<iframe src="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'show',$block['Block']['id'],'admin'=>false), true)?>" width="<?php echo $block['Block']['width'];?>" height="<?php echo ((int) $block['Block']['height'] * (int)$block['Block']['ad_number_visible'] )?>" frameborder="0" scrolling="no"></iframe>
				<?php endif;?>
			<?php else:?>
				<iframe src="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'show',$block['Block']['id'],'admin'=>false), true)?>" width="<?php echo $block['Block']['width']?>" height="<?php echo $block['Block']['height']?>" frameborder="0" scrolling="no"></iframe>
			<?php endif;?>
		<?php
			$code = ob_get_contents();
			ob_end_clean();
			echo trim(htmlspecialchars($code));
		?>
	</div>
</div>
<script type="text/javascript">
	var selectText = function(){
		$(this).select();
	};
	
	$(document).ready(function(){
		$('#code').bind('mousedown',selectText).bind('click',selectText).bind('mousemove',selectText);
	});
</script>