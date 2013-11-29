<div class="blocksAdvertisements form">
<?php echo $this->Form->create('BlocksAdvertisement'); ?>
	<fieldset>
		<legend><?php echo __d('publicity',' Add Blocks Advertisement'); ?></legend>
	<?php
		echo $this->Form->input('block_id');
		echo $this->Form->input('advertisement_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__d('publicity','Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __d('publicity','Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__d('publicity','List Blocks Advertisements'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__d('publicity','List Blocks'), array('controller' => 'blocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Block'), array('controller' => 'blocks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Advertisements'), array('controller' => 'advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Advertisement'), array('controller' => 'advertisements', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Clicks'), array('controller' => 'clicks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Click'), array('controller' => 'clicks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Impressions'), array('controller' => 'impressions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Impression'), array('controller' => 'impressions', 'action' => 'add')); ?> </li>
	</ul>
</div>
