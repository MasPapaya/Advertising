<div class="blocksAdvertisements form">
<?php echo $this->Form->create('BlocksAdvertisement'); ?>
	<fieldset>
		<legend><?php echo __d('advertising','Edit Blocks Advertisement'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('block_id');
		echo $this->Form->input('advertisement_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__d('advertising','Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __d('advertising','Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__d('advertising','Delete'), array('action' => 'delete', $this->Form->value('BlocksAdvertisement.id')), null, __d('advertising','Are you sure you want to delete # %s?', $this->Form->value('BlocksAdvertisement.id'))); ?></li>
		<li><?php echo $this->Html->link(__d('advertising','List Blocks Advertisements'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__d('advertising','List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Advertisements'), array('controller' => 'advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Advertisement'), array('controller' => 'advertisements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Clicks'), array('controller' => 'clicks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Click'), array('controller' => 'clicks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Impressions'), array('controller' => 'impressions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Impression'), array('controller' => 'impressions', 'action' => 'add')); ?> </li>
	</ul>
</div>
