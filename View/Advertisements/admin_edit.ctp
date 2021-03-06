<div class="cru">
	<div class="btn-options">
		<?php
		if (!empty($block_alias)) {

			echo $this->Html->link('<i class="glyphicon glyphicon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', $block_alias, 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		} else {
			echo $this->Html->link('<i class="glyphicon glyphicon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		}
		?>
	</div>
	<?php echo $this->Form->create('Advertisement'); ?>
	<fieldset>
		<legend><?php echo __d('advertising', 'Edit Advertisement'); ?></legend>			
		<div >
			<div class="col-md-6">	
				<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('url', array('type' => 'text'));
				?>
				<?php
				if ($user_enable):
					echo $this->Form->input('target', array('empty' => __d('advertising', 'Select'), 'options' => array(
							'_blank' => '_blank',
							'_self' => '_self',
							'_parent' => '_parent',
							'_top' => '_top',
						)));
					echo $this->Form->input('width', array('label' => __d('advertising', 'Width')));
					echo $this->Form->input('height', array('label' => __d('advertising', 'Height')));
				endif;
				?>
			</div>
			<div class="col-md-6">	
				<?php
				if (count($blocks) > 1) {
					echo $this->Form->input('Block', array('class' => 'chosen_groups', 'label' => __d('advertising', 'Block')));
				} else {
					echo $this->Form->input('Block.Block.0', array('type' => 'hidden', 'value' => key($blocks)));
				}
				if ($user_enable) {
					echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.group_id')));
				}

				echo $this->Form->input('language_id', array(
					'class' => 'chosen_groups',
					'label' => __d('advertising', 'Language'),
				));
				?>
			</div>
		</div>
		<br />
	</fieldset>
	<?php echo $this->Form->end(array('label' => __d('advertising', 'Save'), 'class' => 'btn btn-primary')); ?>
</div>