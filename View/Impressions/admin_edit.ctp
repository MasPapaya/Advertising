<div class="span3">	
	<div class="well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __d('advertising', 'Actions'); ?></li>
			<li><?php echo $this->Html->link(__d('advertising','List Impressions'), array('action' => 'index')); ?></li>
		</ul>
	</div>
</div>
<div class="span8">
	<?php echo $this->Form->create('Impression'); ?>
	<fieldset>
		<legend><?php echo __d('advertising','Edit Impression'); ?></legend>
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ip');
		echo $this->Form->input('user_agent');
		echo $this->Form->input('blocks_advertisement_id');
		?>
	</fieldset>
	<?php echo $this->Form->end(array('label' => __d('advertising','Submit'), 'class' => 'btn btn-primary')); ?>
</div>
