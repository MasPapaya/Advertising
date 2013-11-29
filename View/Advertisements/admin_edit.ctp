<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('resources', 'Actions'); ?></li>
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('publicity', 'List Advertisements'), array('action' => 'index'), array('escape' => FALSE)); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<?php echo $this->Form->create('Advertisement'); ?>
	<fieldset>
		<legend><?php echo __d('publicity', 'Edit Advertisement'); ?></legend>			
		<div class="row-fluid">
			<div class="span5">
				<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('url', array('type' => 'text'));
				echo $this->Form->input('target', array('empty' => __d('publicity', 'Select'), 'options' => array(
						'_blank' => '_blank',
						'_self' => '_self',
						'_parent' => '_parent',
						'_top' => '_top',
					)));
				echo $this->Form->input('width', array('label' => __d('publicity', 'Width')));
				echo $this->Form->input('height', array('label' => __d('publicity', 'Height')));
				?>
			</div>
			<div class="span7">
				<?php
				echo $this->Form->input('Block', array('class' => 'chosen_groups', 'label' => __d('publicity', 'Block')));
				echo '<br />';
				if ($user_enable) {
					echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.group_id')));
				}

				echo '<br />';
				echo $this->Form->input('language_id', array(
					'class' => 'chosen_groups',
					'label' => __d('publicity', 'Language'),
				));
				?>
			</div>
		</div>
		<br />
	</fieldset>
	<?php echo $this->Form->end(array('label' => __d('publicity', 'Submit'), 'class' => 'btn btn-primary')); ?>
</div>