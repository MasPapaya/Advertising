<?php

/**
 * CakePHP ToolsHelper
 * @author developer3
 */
class ToolsHelper extends AppHelper {

	public $helpers = array('Html', 'Session', 'Paginator', 'Js' => array('jQuery'), 'Form', 'Time');

	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}

	public function beforeRender($viewFile) {
		
	}

	public function afterRender($viewFile) {
		
	}

	public function beforeLayout($viewLayout) {
		
	}

	public function afterLayout($viewLayout) {
		
	}

	/**
	 * paginator modified
	 */
	public function Paginator() {
		$nums = $this->Paginator->prev('«', array('tag' => 'li'), null, array('class' => 'prev disabled ', 'tag' => 'li', 'disabledTag' => 'a'));
		$nums .= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'separator' => '', 'currentClass' => 'active'));
		$nums .= $this->Paginator->next('»', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'a'));
		return '<div class="pagination"><ul>' . $nums . '</ul></div>';
	}

	/**
	 * link button: boton para cargar enlaces a traves de ajax sin generar etiqueta de enlace( <a href=""></a> )
	 */
	public function link_button($title, array $url, $update, array $options_btn = null, $scrollto = false) {
		if (empty($url)) {
			return false;
		}
		$id = rand(0, 9999999999);
		if ($scrollto) {
			$script = '
					$("#link_button_' . $id . '").bind("click",function(){				
							$.ajax({
									url:"' . $this->Html->url($url) . '",
									dataType:"html",
									//type:"POST",
									success:function (data, textStatus) {
											$("' . $update . '").html(data);													
											$("body").scrollTo($("' . $update . '").offset().top,500,{axis:"y"});
									}
							});
					});
			';
		} else {
			$script = '
					$("#link_button_' . $id . '").bind("click",function(){				
							$.ajax({
									url:"' . $this->Html->url($url) . '",
									dataType:"html",
									//type:"POST",
									success:function (data, textStatus) {
											$("' . $update . '").html(data);
									}
							});
					});
			';
		}
		$this->Js->buffer($script, true);
		return $this->Form->button($title, array_merge(array('id' => 'link_button_' . $id), (is_null($options_btn) ? array() : $options_btn)));
	}

	public function view_advertisement($BlocksAdvertisement = array()) {

		$block = array();
		$block['Block'] = $BlocksAdvertisement['Block'];
		unset($BlocksAdvertisement['Block']);



		if ((bool) $block['Block']['multiple']):

			if ($block['Block']['orientation'] == '1'):
				echo '<div id="slider-' . $block["Block"]["id"] . '" style="overflow: hidden;padding: 0; ' . $this->Html->style(array("height" => $block["Block"]["height"] . "px", "width" => ((int) $block["Block"]["width"] * (int) $block["Block"]["ad_number_visible"] ) . "px")) . '">
			<div>';
				foreach ($BlocksAdvertisement as $advertisement):
					echo '<div style="text-align: center;float: left;margin: 0; padding: 0; ' . $this->Html->style(array("width" => $block["Block"]["width"] . "px", "height" => $block["Block"]["height"] . "px")) . '">
						<a href=" ' . $this->Html->url(array("plugin" => "advertising", "controller" => "BlocksAdvertisements", "action" => "register_click", $advertisement["ViewBlocksAdvertisement"]["id"]), true) . '" target="' . $advertisement["ViewBlocksAdvertisement"]["advertisement_taget"] . '">
							' . $this->Html->image("/files/" . $advertisement["ViewBlocksAdvertisement"]["Resource"]["Entity"]["folder"] . "/" . $advertisement["ViewBlocksAdvertisement"]["Resource"]["ViewResourceGroup"]["resource_filename"], array("border" => "0", "style" => "max-height:" . $block["Block"]["height"] . "px")) . '
						</a>
					</div>';
				endforeach;
				echo '</div></div>';
			else:
				echo '<div id="slider-' . $block["Block"]["id"] . '" style="overflow: hidden;padding: 0; ' . $this->Html->style(array("height" => ((int) $block["Block"]["height"] * (int) $block["Block"]["ad_number_visible"]) . "px", "width" => (int) $block["Block"]["width"] . "px")) . '">
			<div>';
				foreach ($BlocksAdvertisement as $advertisement):
					echo '<div style="text-align: center; ' . $this->Html->style(array("width" => $block["Block"]["width"] . "px", "height" => $block["Block"]["height"] . "px")) . '">
						<a href=" ' . $this->Html->url(array("plugin" => "advertising", "controller" => "BlocksAdvertisements", "action" => "register_click", $advertisement["ViewBlocksAdvertisement"]["id"]), true) . ' "target=" ' . $advertisement["ViewBlocksAdvertisement"]["advertisement_taget"] . '">
							' . $this->Html->image("/files/" . $advertisement["ViewBlocksAdvertisement"]["Resource"]["Entity"]["folder"] . "/" . $advertisement["ViewBlocksAdvertisement"]["Resource"]["ViewResourceGroup"]["resource_filename"], array("border" => "0", "style" => "max-height:" . '$block["Block"]["height"]' . "px")) . '
						</a>
					</div>';
				endforeach;
				echo '</div>
		</div>';
			endif;

			$script = '
		function move(domid_content, viewFinder, animation, orientation){
		
			// obtenemos la posicion del scroll acorde a la orientacion
			var position = (orientation == 1) ? $(domid_content).scrollLeft() : $(domid_content).scrollTop();
			var totalSize = (orientation == 1) ? $(domid_content).children("div").width() : $(domid_content).children("div").height();
			

			// verificamos si hay mas espacio para correr el scroll
			if (viewFinder * 2 + position > totalSize){
			
				
				
				// retrocedemos el scroll a la posicion inicial dependiendo de la orientación y
				// aplicando un efecto 
				
				$(domid_content).find("a").fadeOut(250,function(){
					if(orientation == 1){// 1 horizontal
						$(domid_content).animate({scrollLeft:0}, 10);
					}else{
						$(domid_content).animate({scrollTop:0},10);
					}
				});
				$(domid_content).find("a").fadeIn(250);
			} else {
				// verificamos la animacion
				
				if(animation === "1"){
					
					// slider					
					if(orientation == 1){// 1 horizontal
					
						$(domid_content).animate({scrollLeft: position + viewFinder},500);
					}else{
					
						$(domid_content).animate({scrollTop: position + viewFinder},500);
					}
				}else{
				
					// fade
					$(domid_content).find("a").fadeOut(250,function(){
						if(orientation == "1"){
							$(domid_content).scrollLeft(position + viewFinder);
						}else{
							$(domid_content).scrollTop(position + viewFinder);
						}
					});
					$(domid_content).find("a").fadeIn(250);
				}
			}
		}';

			$script.='
				$(document).ready(function(){				
			// obtenemos el tamaño segun la orientacion
			var size_block	= ' . ((int) ($block["Block"]["orientation"] == 1) ? $block["Block"]["width"] : $block["Block"]["height"]) . ';
			
			// obtenemos el numero de anuncios a mostrar
			var ad_nv= ' . (int) $block["Block"]["ad_number_visible"] . ';
			
			// obtenemos el tamaño reservado para mostrar los anuncios
			var viewFinder	= (ad_nv * size_block);';

			if ($block["Block"]["orientation"] == "1"):
				// si la orientación es horizontal se aplica el tamaño al contenedor
				$script.='var totalWidth = ($("#slider-' . $block["Block"]["id"] . '").children("div").children("div").length * size_block);
				$("#slider-' . $block["Block"]["id"] . '").children("div").width(totalWidth);';
			endif;

			if (count($BlocksAdvertisement) > 1 && $block['Block']['block_type'] != "1"):
				// aplicamos movimiento si el bloque es animado
				$script.='
					setInterval(function(){					
					move("#slider-' . $block["Block"]["id"] . '",viewFinder,"' . (int) $block["Block"]["type_animation"] . '"," ' . (int) $block["Block"]["orientation"] . '");
				},' . (int) $block["Block"]["transition_time"] . ');';
			endif;

			$script.= '});';
		else:
			echo '<div style="' . $this->Html->style(array("height" => $block["Block"]["height"] . "px", "width" => $block["Block"]["width"] . "px")) . '">		
		<a href="' . $this->Html->url(array("plugin" => "advertising", "controller" => "BlocksAdvertisements", "action" => "register_click", $BlocksAdvertisement["ViewBlocksAdvertisement"]["id"]), true) . '" target="' . $BlocksAdvertisement['ViewBlocksAdvertisement']["advertisement_taget"] . '">
			' . $this->Html->image("/files/" . $BlocksAdvertisement["ViewBlocksAdvertisement"]["Resource"]["Entity"]["folder"] . "/" . $BlocksAdvertisement["ViewBlocksAdvertisement"]["Resource"]["ViewResourceGroup"]["resource_filename"], array("border" => "0")) . '
		</a>		
	</div>	';
		endif;

		$this->Js->buffer($script, true);
	}

}
