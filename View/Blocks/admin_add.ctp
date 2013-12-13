<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('advertising', 'Actions'); ?></li>			
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('advertising', 'List Blocks'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<?php echo $this->Form->create('Block'); ?>
	<fieldset>
		<legend><?php echo __d('advertising', 'Add Block'); ?></legend>
		<div class="row-fluid">
			<div class="span6">
				<?php
				echo $this->Form->input('name', array('label' => __d('advertising', 'Name')));
				echo $this->Form->input('alias');
				echo $this->Form->input('width', array('label' => __d('advertising', 'Width')));
				echo $this->Form->input('height', array('label' => __d('advertising', 'Height')));
				echo $this->Form->input('multiple', array('div' => array('id' => 'block_multiple')));
				echo $this->Form->input('is_user');
				echo $this->Form->input('published', array('type' => 'hidden', 'value' => '1800-01-01 00:00:00'));

				//		echo $this->Form->input('Advertisement');
				?>
			</div>
			<div class="span6">						
				<?php
				echo $this->Form->input('block_type', array(
					'empty' => __d('advertising', 'Select'),
					'label' => __d('advertising', 'Block Type'),
					'options' => array(
						'1' => __d('advertising', 'static'),
						'2' => __d('advertising', 'animated')
					)
				));

				echo $this->Form->input('orientation', array(
					'empty' => __d('advertising', 'Select'),
					'label' => __d('advertising', 'Orientation'),
					'options' => array(
						'1' => __d('advertising', 'horizontally'),
						'2' => __d('advertising', 'vertically')
					)
				));

				echo $this->Form->input('type_animation', array(
					'empty' => __d('advertising', 'Select'),
					'label' => __d('advertising', 'Type Animation'),
					'options' => array(
						'1' => 'Slider',
						'2' => 'Fader'
					)
				));

				echo $this->Form->input('transition_time', array('type' => 'number', 'label' => __d('advertising', 'Transition Time')));
				echo $this->Form->input('ad_number_visible', array('type' => 'number', 'label' => __d('advertising', 'Ad Number Visible')));
				?>
			</div>
		</div>
	</fieldset>
	<?php echo $this->Form->end(array('label' => __d('advertising', 'Submit'), 'class' => 'btn btn-primary')); ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//		
		//		var hide_select = function(){
		//			if(!$('#block_multiple').children('[type="checkbox"]').is(':checked')){
		//				$('#select_display_type').hide();
		//			}else{
		//				$('#select_display_type').show();
		//			}
		//		};
		//		
		//		hide_select();
		//		
		//		$('#block_multiple').children('[type="checkbox"]').bind('change',hide_select);
	});
</script>
