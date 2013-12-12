<div class="clicks view">
<h2><?php  echo __d('advertising','Click'); ?></h2>
	<dl>
		<dt><?php echo __d('advertising','Id'); ?></dt>
		<dd>
			<?php echo h($click['Click']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Ip'); ?></dt>
		<dd>
			<?php echo h($click['Click']['ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','User Agent'); ?></dt>
		<dd>
			<?php echo h($click['Click']['user_agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('advertising','Blocks Advertisement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($click['BlocksAdvertisement']['id'], array('controller' => 'blocks_advertisements', 'action' => 'view', $click['BlocksAdvertisement']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __d('advertising','Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d('advertising','Edit Click'), array('action' => 'edit', $click['Click']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('advertising','Delete Click'), array('action' => 'delete', $click['Click']['id']), null, __d('advertising','Are you sure you want to delete # %s?', $click['Click']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Clicks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Click'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','List Blocks Advertisements'), array('controller' => 'blocks_advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('advertising','New Blocks Advertisement'), array('controller' => 'blocks_advertisements', 'action' => 'add')); ?> </li>
	</ul>
</div>
