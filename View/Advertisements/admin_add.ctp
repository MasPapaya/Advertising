<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('advertising', 'Actions'); ?></li>			
			<li><?php echo $this->Html->link('<i class="icon-list"></i>' . __d('advertising', 'List Advertisements'), array('action' => 'index'), array('escape' => FALSE)); ?></li>

		</ul>
	</div>
</div>
<div class="span8">
	<?php echo $this->Form->create('Advertisement'); ?>
	<fieldset>
		<legend><?php echo __d('advertising', 'Add Advertisement'); ?></legend>
		<div class="row-fluid">
			<div class="span5">
				<?php
				echo $this->Form->input('name');
				echo $this->Form->input('url', array('type' => 'text'));
				echo $this->Form->input('target', array('empty' => __d('advertising', 'Select'), 'options' => array(
						'_blank' => '_blank',
						'_self' => '_self',
						'_parent' => '_parent',
						'_top' => '_top',
					)));
				echo $this->Form->input('width', array('label' => __d('advertising', 'Width')));
				echo $this->Form->input('height', array('label' => __d('advertising', 'Height')));
				?>
			</div>
			<div class="span7">
				<?php
				echo $this->Form->input('published', array('type' => 'hidden', 'value' => Configure::read('zero_datetime')));
				echo $this->Form->input('deleted', array('type' => 'hidden', 'value' => Configure::read('zero_datetime')));

				echo $this->Form->input('Block', array('class' => 'chosen_groups', 'label' => __d('advertising', 'Block')));
				echo '<br />';

				if ($user_enable) {
					echo $this->Form->input('user_id', array(
						'class' => 'chosen_groups',
						'label' => __d('advertising', 'User'),
						'required' => false,
						'empty' => ''
					));
				}




				echo '<br />';
				echo $this->Form->input('language_id', array(
					'class' => 'chosen_groups',
					'label' => __d('advertising', 'Language'),
				));
				?>

			</div>
		</div>

		<br />
	</fieldset>
	<?php echo $this->Form->end(array('label' => __d('advertising', 'Submit'), 'class' => 'btn btn-primary')); ?>
</div>