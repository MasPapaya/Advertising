<?php

/**
 * CakePHP ToolsHelper
 * @author developer3
 */
class ToolsHelper extends AppHelper {

	public $helpers = array('Html', 'Session', 'Paginator', 'Js' => array('jQuery'), 'Form','Time');

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
		$nums = $this->Paginator->prev('«', array('tag' => 'li'), null, array('class' => 'prev disabled ', 'tag' => 'li','disabledTag'=>'a'));
		$nums .= $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'separator' => '', 'currentClass' => 'active'));
		$nums .= $this->Paginator->next('»', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li','disabledTag'=>'a'));
		return '<div class="pagination"><ul>' . $nums . '</ul></div>';
	}
	
	
	/**
	 * link button: boton para cargar enlaces a traves de ajax sin generar etiqueta de enlace( <a href=""></a> )
	 */	   
	public function link_button($title, array $url, $update ,array $options_btn = null, $scrollto = false ) {
		if (empty($url)) {
			return false;
		}
		$id = rand(0, 9999999999);
		if($scrollto){
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
		}else{
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
		$this->Js->buffer($script,true);
		return $this->Form->button($title, array_merge(array('id' => 'link_button_' . $id),(is_null( $options_btn)? array(): $options_btn)));
	}
		
}
