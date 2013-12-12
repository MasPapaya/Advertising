<div class="impressions view">
<h2><?php  echo __d('advertising','Impression'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising','Id'); ?></dt>
		<dd>
			<?php echo h($impression['Impression']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Ip'); ?></dt>
		<dd>
			<?php echo h($impression['Impression']['ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','User Agent'); ?></dt>
		<dd>
			<?php echo h($impression['Impression']['user_agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Blocks Advertisement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($impression['BlocksAdvertisement']['id'], array('controller' => 'blocks_advertisements', 'action' => 'view', $impression['BlocksAdvertisement']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __d('advertising','Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d('advertising','Edit Impression'), array('action' => 'edit', $impression['Impression']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('advertising','Delete Impression'), array('action' => 'delete', $impression['Impression']['id']), null, __d('advertising','Are you sure you want to delete # %s?', $impression['Impression']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Impressions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Impression'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Blocks Advertisements'), array('controller' => 'blocks_advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Blocks Advertisement'), array('controller' => 'blocks_advertisements', 'action' => 'add')); ?> </li>
	</ul>
</div>
