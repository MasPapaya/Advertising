<?php if ((bool) $block['Block']['multiple']): ?>

	<?php if ($block['Block']['orientation'] == '1'): ?>
		<div id="slider" style="overflow: hidden;padding: 0; <?php echo $this->Html->style(array('height' => $block['Block']['height'] . 'px', 'width' => ((int) $block['Block']['width'] * (int) $block['Block']['ad_number_visible'] ) . 'px')) ?>">
			<div>				
				<?php foreach ($BlocksAdvertisement as $advertisement): ?>
					<div style="text-align: center;float: left;margin: 0; padding: 0; <?php echo $this->Html->style(array('width' => $block['Block']['width'] . 'px', 'height' => $block['Block']['height'] . 'px')); ?>">
						<a href="<?php echo $this->Html->url(array('controller' => 'BlocksAdvertisements', 'action' => 'register_click', $advertisement['ViewBlocksAdvertisement']['id']), true) ?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget'] ?>">
							<?php echo $this->Html->image('/files/' . $advertisement['ViewBlocksAdvertisement']['Resource']['Entity']['folder'] . '/' . $advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'], array('border' => '0', 'style'=>'max-height:'.$block['Block']['height'].'px')); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php else: ?>
		<div id="slider" style="overflow: hidden;padding: 0; <?php echo $this->Html->style(array('height' => ((int) $block['Block']['height'] * (int) $block['Block']['ad_number_visible']) . 'px', 'width' => (int) $block['Block']['width']. 'px')) ?>">
			<div>
				<?php foreach ($BlocksAdvertisement as $advertisement): ?>
					<div style="text-align: center; <?php echo $this->Html->style(array('width' => $block['Block']['width'] . 'px', 'height' => $block['Block']['height'] . 'px')); ?>">
						<a href="<?php echo $this->Html->url(array('controller' => 'BlocksAdvertisements', 'action' => 'register_click', $advertisement['ViewBlocksAdvertisement']['id']), true) ?>" target="<?php echo $advertisement['ViewBlocksAdvertisement']['advertisement_taget'] ?>">
							<?php echo $this->Html->image('/files/' . $advertisement['ViewBlocksAdvertisement']['Resource']['Entity']['folder'] . '/' . $advertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'], array('border' => '0','style'=>'max-height:'.$block['Block']['height'].'px')); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<script type="text/javascript">
		function move(domid_content, viewFinder, animation, orientation){

			// obtenemos la posicion del scroll acorde a la orientacion
			var position = (orientation == 1) ? $(domid_content).scrollLeft() : $(domid_content).scrollTop();
			var totalSize = (orientation == 1) ? $(domid_content).children('div').width() : $(domid_content).children('div').height();

			// verificamos si hay mas espacio para correr el scroll
			if (viewFinder * 2 + position > totalSize){
				
				// retrocedemos el scroll a la posicion inicial dependiendo de la orientación y
				// aplicando un efecto 
				$(domid_content).find('a').fadeOut(250,function(){
					if(orientation == '1'){// 1 horizontal
						$(domid_content).animate({scrollLeft:0}, 10);
					}else{
						$(domid_content).animate({scrollTop:0},10);
					}
				});
				$(domid_content).find('a').fadeIn(250);
			} else {
				// verificamos la animacion
				if(animation === '1'){
					// slider
					if(orientation == '1'){// 1 horizontal
						$(domid_content).animate({scrollLeft: position + viewFinder},500);
					}else{
						$(domid_content).animate({scrollTop: position + viewFinder},500);
					}
				}else{
					// fade
					$(domid_content).find('a').fadeOut(250,function(){
						if(orientation == '1'){
							$(domid_content).scrollLeft(position + viewFinder);
						}else{
							$(domid_content).scrollTop(position + viewFinder);
						}
					});
					$(domid_content).find('a').fadeIn(250);
				}
			}
		}

		$(document).ready(function(){
			// obtenemos el tamaño segun la orientacion
			var size_block	= <?php echo ((int) ($block['Block']['orientation'] == 1) ? $block['Block']['width']:$block['Block']['height']); ?>;
			
			// obtenemos el numero de anuncios a mostrar
			var ad_nv		= <?php echo (int) $block['Block']['ad_number_visible']; ?>;
			
			// obtenemos el tamaño reservado para mostrar los anuncios
			var viewFinder	= (ad_nv * size_block);

			<?php if ($block['Block']['orientation'] == '1'): ?>
				// si la orientación es horizontal se aplica el tamaño al contenedor
				var totalWidth = ($('#slider').children('div').children('div').length * size_block);
				$('#slider').children('div').width(totalWidth);
			<?php endif; ?>

			<?php if (count($BlocksAdvertisement) > 1 && $block['Block']['block_type'] != '1'):?>
				// aplicamos movimiento si el bloque es animado
				setInterval(function(){
					move('#slider',viewFinder,'<?php echo (int) $block['Block']['type_animation'];?>','<?php echo (int) $block['Block']['orientation'];?>');
				},<?php echo (int) $block['Block']['transition_time'];?>);
			<?php endif; ?>
		});
	</script>
<?php else: ?>

	<div style="<?php echo $this->Html->style(array('height' => $block['Block']['height'] . 'px', 'width' => $block['Block']['width'].'px')) ?>">		
		<a href="<?php echo $this->Html->url(array('controller' => 'BlocksAdvertisements', 'action' => 'register_click', $BlocksAdvertisement['ViewBlocksAdvertisement']['id']), true) ?>" target="<?php echo $BlocksAdvertisement['ViewBlocksAdvertisement']['advertisement_taget'] ?>">
			<?php echo $this->Html->image('/files/' . $BlocksAdvertisement['ViewBlocksAdvertisement']['Resource']['Entity']['folder'] . '/' . $BlocksAdvertisement['ViewBlocksAdvertisement']['Resource']['ViewResourceGroup']['resource_filename'], array('border' => '0')); ?>
		</a>		
	</div>	
<?php endif; ?>