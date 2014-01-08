<div class="cru">
	<div class="btn-options">	
		<?php
		if (!empty($block_alias)) {

			echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', $block_alias, 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		} else {
			echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE));
		}
		?>

	</div>
	<?php echo $this->Form->create('Advertisement'); ?>
	<fieldset>
		<legend><?php echo __d('advertising', 'Add Advertisement'); ?></legend>
		<div class="row-fluid">
			<div class="span5">
				<?php
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
			<div class="span5">
				<?php
				echo $this->Form->input('published', array('type' => 'hidden', 'value' => Configure::read('zero_datetime')));
				echo $this->Form->input('deleted', array('type' => 'hidden', 'value' => Configure::read('zero_datetime')));
				if (empty($block_id)) {
					echo $this->Form->input('Block', array('class' => 'chosen_groups', 'label' => __d('advertising', 'Block')));
				} else {
					echo $this->Form->input('Block.Block.0', array('type' => 'hidden', 'value' => $blocks));
				}
				if ($user_enable) {
					echo $this->Form->input('user_id', array(
						'class' => 'chosen_groups',
						'label' => __d('advertising', 'User'),
						'required' => false,
						'empty' => ''
					));
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