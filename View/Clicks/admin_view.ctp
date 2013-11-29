<div class="clicks view">
<h2><?php  echo __d('publicity','Click'); ?></h2>
	<dl>
		<dt><?php echo __d('publicity','Id'); ?></dt>
		<dd>
			<?php echo h($click['Click']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Ip'); ?></dt>
		<dd>
			<?php echo h($click['Click']['ip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','User Agent'); ?></dt>
		<dd>
			<?php echo h($click['Click']['user_agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __d('publicity','Blocks Advertisement'); ?></dt>
		<dd>
			<?php echo $this->Html->link($click['BlocksAdvertisement']['id'], array('controller' => 'blocks_advertisements', 'action' => 'view', $click['BlocksAdvertisement']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __d('publicity','Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d('publicity','Edit Click'), array('action' => 'edit', $click['Click']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__d('publicity','Delete Click'), array('action' => 'delete', $click['Click']['id']), null, __d('publicity','Are you sure you want to delete # %s?', $click['Click']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Clicks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Click'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','List Blocks Advertisements'), array('controller' => 'blocks_advertisements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d('publicity','New Blocks Advertisement'), array('controller' => 'blocks_advertisements', 'action' => 'add')); ?> </li>
	</ul>
</div>
