<?php if((bool) $block['Block']['multiple']):?>
	<?php if($block['Block']['orientation'] == '1'):?>
		<div id="Horizontal" style="<?php echo 'height: '.$block['Block']['height'].'px; width:'.($block['Block']['height']) ;?>margin: 0;  padding: 0;">
			<div>
				<?php foreach ($BlocksAdvertisement as $advertisement):?>
					<div style="width: 728px; height: 90px; float: left;margin: 0; padding: 0;">
						<a href="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'register_click',$advertisement['ViewBlocksAdvertisement']['id']),true)?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget']?>">
							<?php echo $this->Html->image('/files/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ResourceEntity']['folder'].'/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'],array('border'=>'0'));?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php else:?>
	<?php endif;?>
<?php else:?>
<?php endif;?>

 <!--bloque vertical--> 

<!--<div id="vertical" style="width: 728px; margin: 0;  padding: 0;">
	<div>
		<?php foreach ($BlocksAdvertisement as $advertisement):?>
			<div style="width: 728px; height: 92px; margin: 0; padding: 0;">
				<a href="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'register_click',$advertisement['ViewBlocksAdvertisement']['id']),true)?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget']?>">
					<?php echo $this->Html->image('/files/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ResourceEntity']['folder'].'/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'],array('border'=>'0'));?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>-->


<!--horizontal slider-->

<!--<div id="Horizontal" style="overflow: hidden; width: 728px; height: 90px; margin: 0;  padding: 0;">
	<div>
		<?php foreach ($BlocksAdvertisement as $advertisement):?>
			<div style="width: 728px; height: 90px; float: left;margin: 0; padding: 0;">
				<a href="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'register_click',$advertisement['ViewBlocksAdvertisement']['id']),true)?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget']?>">
					<?php echo $this->Html->image('/files/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ResourceEntity']['folder'].'/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'],array('border'=>'0'));?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>-->
<?php // debug($block);?>
<?php // debug($BlocksAdvertisement)?>

<script type="text/javascript">
	$(document).ready(function(){
//		
		function init(){
			var totalWidth= ($('#Horizontal').children('div').children('div').length * 728);
			$('#Horizontal').children('div').width(totalWidth);
		}

//		function move_horizontal(){
//			
//			var width_ad = 728;
//			var position = $('#Horizontal').scrollLeft();
//			var totalWidth= ($('#Horizontal').children('div').children('div').length * width_ad) - width_ad;//			
//			
//			if(position + width_ad > totalWidth){
//				$('#Horizontal').find('a').fadeOut(250,function(){
//					$('#Horizontal').animate({scrollLeft:0},10);
//				});
//				$('#Horizontal').find('a').fadeIn(250);
////				$('#vertical').scrollTop(0);
//			}else{
//				$('#Horizontal').animate({scrollLeft:(position + width_ad)},1000);
////				$('#vertical').scrollTop(position + height_ad);
//			}
//		}
		
		init();
//		setInterval(function(){
//			move_horizontal();
//		},4000);
			
	});
</script>




 <!--vertical slider-->

<!--<div id="vertical" style="overflow: hidden; width: 728px; height: 90px; margin: 0;  padding: 0;">
	<div>
		<?php foreach ($BlocksAdvertisement as $advertisement):?>
			<div style="width: 728px; height: 90px;">
				<a href="<?php echo $this->Html->url(array('controller'=>'BlocksAdvertisements','action'=>'register_click',$advertisement['ViewBlocksAdvertisement']['id']),true)?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget']?>">
					<?php echo $this->Html->image('/files/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ResourceEntity']['folder'].'/'.$advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'],array('border'=>'0'));?>
				</a>	
			</div>
		<?php endforeach; ?>	
	</div>
</div>-->
<?php // debug($block);?>
<?php // debug($BlocksAdvertisement)?>

<script type="text/javascript">
	$(document).ready(function(){
		
//		function move (){
//			var height_ad = 90;
//			var position = $('#vertical').scrollTop();
//			var totalHeight = ($('#vertical').children('div').children('div').length * height_ad) - height_ad;
//			
////			alert(position);
//			$('#vertical').find('a').fadeOut(250,function(){
//				if(position + height_ad > totalHeight){
//	//				$('#vertical').children('div').animate({scrollTop:0},1000);
//					$('#vertical').scrollTop(0);
//				}else{
//	//				$('#vertical').children('div').animate({scrollTop:(position + height_ad)},1000);
//					$('#vertical').scrollTop(position + height_ad);
//				}		
//			});			
//			$('#vertical').find('a').fadeIn(250);
//		}
		function move_vertical (){
			var height_ad = 90;
			var position = $('#vertical').scrollTop();
			var totalHeight = ($('#vertical').children('div').children('div').length * height_ad) - height_ad;
			
			if(position + height_ad > totalHeight){
				$('#vertical').find('a').fadeOut(250,function(){
					$('#vertical').animate({scrollTop:0},10);
				});
				$('#vertical').find('a').fadeIn(250);
//				$('#vertical').scrollTop(0);
			}else{
				$('#vertical').animate({scrollTop:(position + height_ad)},1000);
//				$('#vertical').scrollTop(position + height_ad);
			}
		}
		
//		setInterval(function(){
//			move();
////			alert('se va a mover');
//		},4000);
			
	});
</script>
